<header>
<style>
.block
{
    border: 4px double black;
    width: 300px;
    
    padding: 15px;
    margin:5px;
    text-align:center ;
    
     float: left;
}

.infoblock{
  display: inline-block;
  border: 4px  double black;
}

</style>
</header>
<table border=0>
<tr><td>
<div class="block">
<form action = "get.php" method="POST">
<b>товары выбранного производителя </b><p>
<? include 'conect.php';
    echo "<select name='manufacturer' >";

      
    $sql = "SELECT * FROM vendors ";

    foreach ($dbh->query($sql) as $row) 
    {  
        echo "<option value=".$row['id_vendors'].">".$row['name']."</option>";
    }

echo "</select>"."<br>";
?>
<input type="Submit" name=button1 value=" Sumbit "><p>
</form>
</div>
</td></tr>

<tr><td>
<div class="block">

<form action = "get.php" method="POST">
<b>товары выбранной категории</b><p>
<? include 'conect.php';
    echo "<select name='category' >";

      
    $sql = "SELECT * FROM category ";

    foreach ($dbh->query($sql) as $row) 
    {  
        echo "<option value=".$row['id_category'].">".$row['name']."</option>";
    }

echo "</select>"."<br>";
?>
<input type="Submit" name=button2 value=" Sumbit "><p>
</form>
</div>
</td></tr>

<tr><td>
<div class="block">
<form action = "get.php" method="POST">
<b>товары в выбранном ценовом диапазоне</b></p>

<p>Включительно</p>
<span>Цена от</span><input type="number" name="min" min="0" value="50"><br>
<span>Цена до</span><input type="number" name="max" min="0" value="300">

<input type="Submit" name=button3 value=" Sumbit "><p>

</form>
</div>
</td></tr>
</table>




