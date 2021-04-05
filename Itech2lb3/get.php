<?php


include_once 'conect.php';


    function getInfoCompTask($dbh, $date, $id_project) 
    {       
        echo $date.'<br>';
        $sql = "SELECT worker.id_worker, worker.fid_department, work.date,
        work.time_start,work.time_end,work.description, 
        projects.id_projects,projects.name,projects.manager
        FROM worker JOIN work ON worker.id_worker = work.fid_worker 
        JOIN projects ON work.fid_projects=projects.id_projects
        WHERE work.description = 'completed' AND work.date = '$date' 
        AND projects.name = '$id_project'";

$output = "<table border='1' >";

$output .="  <tr> <th>ProjectWorker</th>  <th>Department</th>  <th>Status</th> <th>IdProject</th>   <th>ProjectName</th> <th>ProjectsManager</th></th>";


        foreach ($dbh->query($sql) as $row) 
        {              
            $output .= "<tr><th>" 
            . $row['id_worker'] . "</tb>  <th>" 
             . $row['fid_department'] . "</th><th>" 
              . $row['description'] . "</th> <th>" 
               . $row['id_projects'] . "</th> <th>" 
                . $row['name'] . "</th>   <th>" 
                 . $row['manager'] . "</th></tr>";
                 
        }      

       

        $output .= "</table>";
        echo $output;
    }
    //$id = $_GET['select1'];
if ($_GET['select1']!= null)
{
    getInfoCompTask($dbh, $_GET['date'], $_GET['select1']);
}



function getTotalTime($dbh, $id_project)
    {
        // $timetable = $sth->fetchAll(PDO::FETCH_NUM);
       


       $sql = "SELECT work.time_end , work.time_start FROM work JOIN projects ON projects.id_projects=work.fid_projects WHERE projects.name = '$id_project'";

       
       foreach ($dbh->query($sql) as $row) 
        {$seconds = strtotime($row[time_end]) - strtotime($row[time_start]) ;}

        
        //echo "$seconds"."<br>";
	$res = array();
	
	$res['days'] = floor($seconds / 86400);
	$seconds = $seconds % 86400;
    
	
	$res['hours'] = floor($seconds / 3600);
	$seconds = $seconds % 3600;
     
 
	$res['minutes'] = floor($seconds / 60);
    $res['seconds'] = $seconds % 60;
    
    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");
    
  
    
     print ("<time>");
     print ("<days>".$res['days']." </days>");
     print ("<hours>".$res['hours']." </hours>");
     print ("<minutes>".$res['minutes']." </minutes>");
     print ("<seconds>".$res['seconds']." </seconds>");

     


        echo "<root>";
        foreach ($timetable as $row)
        { $days=$row[0];
            $hours=$row[1];
            $minutes=$row[2]; 
            $seconds=$row[3];
            print ("<row><days>$days".$res['days']."</days><hours>$hours".$res['hours']."</hours> <minutes>$minutes".$res['minutes']."</minutes> <seconds>$seconds".$res['seconds']."</seconds> </row>");
        }
        echo "</root>";

        print ("</time>");
    
    }

    

    if ($_GET['project']!= null)
    {
        getTotalTime($dbh, $_GET['project']);
    }


    function getAmountOfEmployees($dbh, $chief)
    {
        
        $stmt = $dbh->prepare ("SELECT COUNT(*) as 'amount' FROM worker JOIN department
        on department.id_department = worker.fid_department
        WHERE department.chief = :name");
        //$smth->bindParam(":name",$chief);
                
        

        if ($stmt->execute(array(':name' => $chief))) //$_GET['amount']
        {
            
            while ($row = $stmt->fetch()) 
            {
                $data = array('text'=>'amount of employees: ', 'amount' =>$row[0]);
                echo json_encode($data);
            }
        }
      
        
    }

    if ($_GET['chief']!= null)
    {
        getAmountOfEmployees($dbh, $_GET['chief']);
    }
?>