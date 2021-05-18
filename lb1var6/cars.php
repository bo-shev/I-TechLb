<?php
require 'config.php';
$date1 = $_GET['firstdate1'];
$date1 = htmlspecialchars($date1); 


    $queryDate =  $pdo->prepare("SELECT cars.name FROM `cars` WHERE cars.ID_Cars NOT IN (SELECT rent.FID_Car FROM `rent` WHERE :date1 BETWEEN date_start AND date_end)");
    //SELECT * FROM `rent` WHERE :date1 BETWEEN date_start AND date_end
    //INNER JOIN rent ON cars.ID_Cars = rent.FID_Car WHERE :date1 NOT BETWEEN date_start AND date_end
    if ($queryDate->execute(array('date1' => $date1)))
    {
	//$result = $queryDate->fetchAll(PDO::FETCH_OBJ);
	
    

    while ($row = $queryDate->fetch()) 
    {
      print_r($row[0]); echo "<br>";
    }
}