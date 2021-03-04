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
<form action = "showInfo.php" method="POST">
<b>information about completed tasks for the selected project on the specified date </b><p>
<? include 'conect.php';
    echo "<select name='project' >";

      
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

<input type="date" name=specifieddate value=2021-02-01 ><br>
<input type="Submit" name=button1 value=" Sumbit "><p>
</form>
</div>

<div class="block">
<form action = "showInfo.php" method="POST">
<b>total time spent on the selected project</b><p>
<? include 'conect.php';
    echo "<select name='project' >";

      
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
<input type="Submit" name=button2 value=" Sumbit "><p>
</form>
</div>


<div class="block">
<form action = "showInfo.php" method="POST">
<b>amount of employees in the department of the selected chief. </b><p>
<? include 'conect.php';
    echo "<select name='num' >";
  
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
<input type="Submit" name=button3 value=" Sumbit "><p>

</form>
</div>


