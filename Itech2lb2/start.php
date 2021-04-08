<header>
<style>
.block
{
    width: 300px;
    height: 120px;
    padding: 15px;
    margin:5px;
    text-align:center ; border-radius: 25px; background-color: #FFE8DB; float: left;
}
</style>
</header>

<div class="block">
<form action = "mytest.php" method="POST">
<b>information about completed tasks for the selected project on the specified date </b><p>
<? 
    echo "<select name='project' >";
    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->workinfo->project; 
    //$filter=array("_fidmanager" => $idmanager);//$idmanager
    $cursor = $collection->find();
    foreach ($cursor as $document)
    {

        echo "<option value=".$document['_id'].">".$document['name']."</option>";
    }

echo "</select>"."<br>";

?>

<input type="date" name=specifieddate value=2021-03-23 ><br>
<input type="Submit" name=button1 value=" Sumbit "><p>
</form>
</div>

<div class="block">
<form action = "mytest.php" method="POST">
<b>amount of manager's projects</b><p>
<? 
    echo "<select name='project' ><br>";

    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->workinfo->managers; 
    $cursor = $collection->find();
    foreach ($cursor as $document)
    {

        echo "<option value=".$document['_id'].">".$document['name']."</option>";
    }

echo "</select>"."<br>";
//<input type="text" name=project value=7 ><br>
?>
<input type="Submit" name=button2 value=" Sumbit "><p>
</form>
</div>


<div class="block">
<form action = "mytest.php" method="POST">
<b>info about employees in the department of the selected manager. </b></p>
<? 
  
    echo "<select name='project' >";

    require_once __DIR__ . "/vendor/autoload.php";
    $collection = (new MongoDB\Client)->workinfo->managers; 
    $cursor = $collection->find();
    foreach ($cursor as $document)
    {

        echo "<option value=".$document['_id'].">".$document['name']."</option>";
    }

echo "</select>"."<br>";
    
?>
<br>
<input type="Submit" name=button3 value=" Sumbit "><p>

</form>
</div>




<script>
document.write(localStorage.getItem("savedText"));
</script>


