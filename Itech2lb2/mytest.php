<?php
require_once __DIR__ . "/vendor/autoload.php";

// $collection = (new MongoDB\Client)->workinfo->managers; //->mytest->name;
// $cursor = $collection->find(["_id"=> 1] ); 

function saveToLocalStor($text)
{
    $script = "<script >localStorage.setItem('savedText','$text')</script>";
    echo $script;
}

function findWorkers($idmanager)
{
    $tasksid = array();

    $collection = (new MongoDB\Client)->workinfo->tasks; 
    $filter=array("_fidmanager" => floatval($idmanager));//$idmanager
    $cursor = $collection->find($filter);
    foreach ($cursor as $document)
            {
                if (in_array( $document['_idtask'], $tasksid))
                {}
                else
                {
                    array_push($tasksid, $document['_idtask']);
                }              
            }

    $collection = (new MongoDB\Client)->workinfo->worker; 

    $iterator = 1;
    $text ="";

    foreach ($tasksid as $value)
    {
        $filter=array("_fidtask" => $value);
        $cursor = $collection->find($filter);

        foreach ($cursor as $document)
        {
            $text = $text."Працівник ".$iterator.": ".$document['name']."<br>";
            echo "Працівник ".$iterator.": ".$document['name']."<br>";
            $iterator++;
        }
    }
    saveToLocalStor($text);
}

$amount = "";

function getAmountProject($id)
{
    $collection = (new MongoDB\Client)->workinfo->project; 
    $filter=array("_id" => $id); 
    global $amount;
    echo "Кількість проектів:";
    $amount =$amount."Кількість проектів:".$collection->count($filter)."<br>";
    echo $collection->count($filter); echo "<br>";
    saveToLocalStor(  $amount);
}

function getAmountTask($idmanager)
{
    $collection = (new MongoDB\Client)->workinfo->tasks; 
    $filter=array("_fidmanager" => $idmanager); 
    $cursor = $collection->find($filter);
    global $amount;
    echo "Кількість завдань:";
    $amount =$amount."Кількість завдань:".$collection->count($filter)."<br>";
    echo $collection->count($filter); echo "<br>";

    foreach ($cursor as $document)
        {
            return $document['_fidproject'];               
        }
}

function showAmount($idmanager)
{
    getAmountProject( getAmountTask(floatval($idmanager)));
    
    
}


function getManager($id)
{
    $collection = (new MongoDB\Client)->workinfo->managers; 
    $cursor = $collection->find(["_id" => $id]);
    foreach ($cursor as $document)
        {
            return $document['name'];               
        }
}

function doneTasks($date, $idproject)
{
    
    $filter=array("date" => "$date", "_fidproject"=> floatval($idproject)); //"2021-03-23", "_fidproject"=> 0
    $collection = (new MongoDB\Client)->workinfo->tasks; 
    $cursor = $collection->find($filter); 
    
    $text ="<table border=1>";    
    $text = $text."<tr><td>Name</td><td>Description</td><td>Date</td><td>Time start</td><td>Time end</td><td>Manager</td></tr>";
    foreach ($cursor as $document)
    {
        $text = $text."<tr>  <td>".$document['name']."</td><td>".$document['description']."</td><td>".$document['date']."</td><td>".$document['timestart']."</td><td>".$document['timeend']."</td><td>".getManager($document['_fidmanager'])."</td></tr>";
      
       
    }
    $text = $text."</table>";
    echo  $text;

    saveToLocalStor($text);
}

if(array_key_exists('button1',$_POST))
{    
    doneTasks( $_POST['specifieddate'], $_POST['project']); 
}
else if (array_key_exists('button2',$_POST))
{
    showAmount( $_POST['project']); 
}
else if (array_key_exists('button3',$_POST))
{
    
    findWorkers( $_POST['project']); 
}

//findWorkers(2);
//doneTasks("2021-03-21", 1);
