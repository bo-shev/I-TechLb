<?php
require 'config.php';
$cars = !empty($_POST['cars']) ? $_POST['cars'] : '';
$edit_race = !empty($_POST['edit_race']) ? $_POST['edit_race'] : '';

if (isset($_POST['edit-submit'])) {
	$sqll = "UPDATE cars SET `Race` = ? WHERE `ID_Cars` = ?";
	$querys = $pdo->prepare($sqll);
	$querys->execute([$edit_race, $cars]);

}
echo 'Данные изменены успешно!';
//echo '<a href="." style="display: block; text-align: start;">&ltНа главную страницу</a>';