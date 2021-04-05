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
<script src="script.js"></script>
</header>

<div class="block">
<form name="form1" method="get">
<b>information about completed tasks for the selected project on the specified date </b><p>
<? include 'conect.php';
    echo "<select id='select1' name='name1' >";

      
$stmt = $dbh->prepare ("SELECT name FROM projects");
$stmt->execute();

if ($stmt->execute(array($_GET['name']))) 
{
    while ($row = $stmt->fetch()) 
    {
        echo "<option value=".$row['name'].">".$row['name']."</option>";
    }
}

echo "</select>"."<br>";
//<input type="text" name=project value=5 style="width: 145px"><br>
?>

<input type="date" id="specifieddate" value=2021-02-01 ><br>
<input type="button" name="form1submit" value="Поиск" onclick="getCompTaskInfo()">
</form>
</div>

<div class="block">
<form name="form2" method="get">
<b>total time spent on the selected project</b><p>
<? include 'conect.php';
    echo "<select id='project' name='name2' >";

      
$stmt = $dbh->prepare ("SELECT name FROM projects");
$stmt->execute();

if ($stmt->execute(array($_GET['name']))) 
{
    while ($row = $stmt->fetch()) 
    {
        echo "<option value=".$row['name'].">".$row['name']."</option>";
    }
}

echo "</select>"."<br>";
//<input type="text" name=project value=7 ><br>
?>
<input type="button" name=button2 value=" Поиск " onclick="getTotalTime();"><p>
</form>
</div>


<div class="block">
<form name="form3" method="get">
<b>amount of employees in the department of the selected chief. </b><p>
<? include 'conect.php';
    echo "<select id='chief' >";
  
$stmt = $dbh->prepare ("SELECT department.chief FROM department");
        $stmt->execute();
       
        if ($stmt->execute(array($_GET['chief']))) 
        {
            while ($row = $stmt->fetch()) 
            {
                echo "<option value=".$row['chief'].">".$row['chief']."</option>";
            }
        }

echo "</select>";
    //<input type="text" name=chief value=3 >
?>
<br>
<input type="button" name=button3 value=" Sumbit " onclick="getAmountWorkers();"><p>

</form>
</div>

<div id="text" style="display: block; border:1px  double black; position: relative ; float: left ">

</div>


