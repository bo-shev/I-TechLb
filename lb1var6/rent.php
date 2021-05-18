<?php
require 'config.php';
$date1 = !empty($_GET['firstdate']) ? $_GET['firstdate'] : '';

$queryDate = $pdo->prepare('SELECT * FROM `rent` WHERE :date1 BETWEEN date_start AND date_end');
// $queryDate->execute(array('date1' => $date1));//$date1
// $result = $queryDate->fetchAll(PDO::FETCH_NUM);


if ($queryDate->execute(array('date1' => $date1)))
    {
	//$result = $queryDate->fetchAll(PDO::FETCH_OBJ);
	
    echo '<table border=1>';
    echo '<tr><td>Дата початку оренди</td><td>Дата кінця</td><td>Вартість оренди</td></tr>';

    while ($row = $queryDate->fetch()) 
    { 
       
        echo '<tr><td>'.$row['Date_start'].'</td><td>'.$row['Date_end'].'</td><td>'.$row['Cost'].'</td></tr>';

      
    }echo '</table>';
}


?>

