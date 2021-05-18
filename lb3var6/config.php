<?php
try {
    $pdo = new PDO('mysql:dbname=iteh2lb1var7; host=localhost', 'root', 'root');
} catch (PDOException $e) {
    die($e->getMessage());
}
?>