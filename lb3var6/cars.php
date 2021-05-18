<?php
require 'config.php';
$date1 = $_GET['firstdate1'];
$date1 = htmlspecialchars($date1);


    $queryDate =  $pdo->prepare("SELECT cars.name FROM `cars` WHERE cars.ID_Cars NOT IN (SELECT rent.FID_Car FROM `rent` WHERE :date1 BETWEEN date_start AND date_end)");
    $queryDate->execute(array('date1' => $date1));
	$result = $queryDate->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($result);
