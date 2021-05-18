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
    


    header('Content-Type: text/xml');
    header("Cache-Control: no-cache, must-revalidate");
    echo '<?xml version="1.0" encoding="utf8" ?>';
  
    print ("<root>");

        if ($stmt->execute()) 
        {
            while ($row = $stmt->fetch()) 
            {
                print ("<row><name>$days".$row['name']."</name><price>$hours".$row['price']."</price> <quantity>$minutes".$row['quantity']."</quantity> <quality>$seconds".$row['quality']."</quality> </row>");
        
            }
        }
       
    print ("</root>");

        

}

//SELECT * FROM items WHERE items.price >= 50 and items.price <= 5000

function getItemsByPrice($dbh, $min, $max)
{
        
    $stmt = $dbh->prepare ( "SELECT * FROM items WHERE items.price >= ? and items.price <= ?"); 

    $stmt->bindParam(1,$min);
    $stmt->bindParam(2,$max);

    if ($stmt->execute()) 
    {
        $data = array();
        
        while ($row = $stmt->fetch()) 
        {         
          array_push($data, $row['name'], $row['price'], $row['quantity'],$row['quality']);
        }
        echo json_encode($data);
       
    }
}


if ($_GET['manufacturerId']!= null)
{
    getItemsByVendor($dbh, $_GET['manufacturerId']);
}

elseif ($_GET['category']!= null)
{
    getItemsByCategory($dbh, $_GET['category']);
}
elseif ($_GET['min']!= null)
{
    getItemsByPrice($dbh,$_GET['min'],$_GET['max']); 
}

// else 
// {
//     getItemsByPrice($dbh,$_POST['min'],$_POST['max']); 
// }