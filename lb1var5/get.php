<?php

include 'conect.php';

function showItemsTable($stmt)
{
    echo '<table border=1>';
        echo "<tr><td>Наименование</td><td>Цена</td><td>Количество на складе</td><td>Качество</td></tr>";
    
        while ($row = $stmt->fetch()) 
        {
          echo '<tr><td>'.$row['name'].'</td><td>'.$row['price'].'</td><td>'.$row['quantity'].'</td><td>'.$row['quality'];
        }
        echo "</table>";
}

function getItemsByVendor($dbh,$id_vendor)
{
    $stmt = $dbh->prepare ( "SELECT * FROM items WHERE items.fid_vendor = :id_vendor"); //Підготовлений запрос

    if ($stmt->execute(array(':id_vendor' => $id_vendor))) 
    {
        showItemsTable($stmt);
    }

}


function getItemsByCategory($dbh,$id_category)
{    
    $stmt = $dbh->prepare ( "SELECT * FROM items WHERE items.fid_category = ?"); //Підготовлений запрос з біндом

    $stmt->bindParam(1,$id_category);
    if ($stmt->execute()) 
    {
        showItemsTable($stmt);
    }

}

//SELECT * FROM items WHERE items.price >= 50 and items.price <= 5000

function getItemsByPrice($dbh, $min, $max)
{
    $stmt = $dbh->prepare ( "SELECT * FROM items WHERE items.price >= ? and items.price <= ?"); 

    $stmt->bindParam(1,$min);
    $stmt->bindParam(2,$max);

    if ($stmt->execute()) 
    {
        showItemsTable($stmt);
    }
}


if(array_key_exists('button1',$_POST))
{    
    getItemsByVendor($dbh, $_POST['manufacturer']);
}
else if (array_key_exists('button2',$_POST))
{
    getItemsByCategory($dbh, $_POST['category']);
}
else if (array_key_exists('button3',$_POST))
{        
    getItemsByPrice($dbh,$_POST['min'],$_POST['max']); 
}

