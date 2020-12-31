<?php
$pdo = new PDO('mysql:host=localhost;port=3307;dbname=npms', 'sam', '1342');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
