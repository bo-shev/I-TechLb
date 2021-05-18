<?php
require 'config.php';
$date1 = !empty($_GET['firstdate']) ? $_GET['firstdate'] : '';

// $queryDate = $pdo->prepare('SELECT cost FROM `rent` WHERE :date1 BETWEEN date_start AND date_end');
// $queryDate->execute(array('date1' => '2014-09-02'));//$date1
// $result = $queryDate->fetchAll(PDO::FETCH_NUM);
// foreach ($result as $row)
//  {

//     $Cost = $row['cost'];
//     echo $Cost.'<br>';
// }

$sql = "SELECT cost FROM `rent` WHERE '$date1' BETWEEN date_start AND date_end";


header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<root>";
foreach ($pdo->query($sql) as $row) 
{
    echo "<row><cost>".$row['cost']."</cost></row>"; 
}
echo "</root>";
?>

