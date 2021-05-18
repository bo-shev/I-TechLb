<?php
require 'config.php';
$maker = !empty($_GET['maker']) ? $_GET['maker'] : '';
if ($maker != 'any') {

    $queryMaker = $pdo->prepare('SELECT cars.Name FROM `cars` INNER JOIN
                                                `vendors` ON `cars`.`FID_Vendors` = `vendors`.`ID_Vendors`
                                                 WHERE `vendors`.`ID_Vendors` = :maker ');
    $queryMaker->execute(array('maker' => $maker));
    $result2 = $queryMaker->fetchAll();
}
echo "Автомобили производителя:";
foreach ($result2 as $row) {
    echo '<tr>';
    foreach ($row as $key => $value) {

        echo '<td><br>' . $value . '</br></td>';
    }
    echo '</tr>';

}

//echo '<br><a href="." style="display: block; text-align: start;">&ltНа главную страницу</a></br>';