<header>
<script src="script.js"></script>
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
<form action = "get.php" method="get">
<b>товары выбранного производителя </b><p>
<? include 'conect.php';
    echo "<select id='manufacturer' >";

      
    $sql = "SELECT * FROM vendors ";

    foreach ($dbh->query($sql) as $row) 
    {  
        echo "<option value=".$row['id_vendors'].">".$row['name']."</option>";
    }

echo "</select>"."<br>";
?>
<input type="button" name="form1" value="Поиск" onclick="getItemsByVendor()"><p>
</form>
</div>
</td></tr>

<tr><td>
<div class="block">

<form action = "get.php" method="get">
<b>товары выбранной категории</b><p>
<? include 'conect.php';
    echo "<select id='category' >";

      
    $sql = "SELECT * FROM category ";

    foreach ($dbh->query($sql) as $row) 
    {  
        echo "<option value=".$row['id_category'].">".$row['name']."</option>";
    }

echo "</select>"."<br>";
?>
<input type="button" name="form2" value="Поиск" onclick="getItemsByCategory()"><p>
</form>
</div>
</td></tr>

<tr><td>
<div class="block">
<form action = "get.php" method="POST">
<b>товары в выбранном ценовом диапазоне</b></p>

<p>Включительно</p>
<span>Цена от</span><input type="number" id="min" name="min" min="0" value="50"><br>
<span>Цена до</span><input type="number" id="max" name="max" min="0" value="300">

<input type="button" name="form2" value="Поиск" onclick="getItemsByPrice()"><p>

</form>
</div>
</td></tr>
</table>

<div id="text" style=" float: left ">

</div>




