<?php
require 'config.php';
$cars = !empty($_POST['cars']) ? $_POST['cars'] : '';
$firstdate = !empty($_POST['firstdate']) ? $_POST['firstdate'] : '';
$firsttime = !empty($_POST['firsttime']) ? $_POST['firsttime'] : '';
$seconddate = !empty($_POST['seconddate']) ? $_POST['seconddate'] : '';
$secondtime = !empty($_POST['secondtime']) ? $_POST['secondtime'] : '';
$cost = !empty($_POST['cost']) ? $_POST['cost'] : '';
if (isset($_POST['submit'])) {
	$sql = ("INSERT INTO `rent`(`FID_Car`, `Date_start`, `Time_start`,`Date_end`, `Time_end`, `Cost`) VALUES(?,?,?,?,?,?)");
	$query = $pdo->prepare($sql);
$query->execute([$cars, $firstdate, $firsttime,$seconddate,$secondtime,$cost]);}
echo 'Данные добавлены успешно!';
//echo '<a href="." style="display: block; text-align: start;">&ltНа главную страницу</a>';