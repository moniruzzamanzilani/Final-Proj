<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 1){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}


if(isset($_POST['logout'])){
  header('Location:logout.php');
  return;
}
if ( !isset($_GET['news_id'])) {
    $_SESSION['error'] = "Missing News Id.";
    header('Location: admin-home.php');
    return;
}
$news_id=$_GET['news_id'];
try {
  $sql = "UPDATE NEWS SET status= 1 WHERE news_id = $news_id" ;
  $stmt = $mysqli->query($sql);
  // $stmt = $pdo->prepare($sql);
  // $stmt->execute(array(':news_id' => $_GET['news_id'],
  //                     ':status' => 1
  //                   ));
  $_SESSION['success'] = 'News Confirmed.';
  header('Location: admin-home.php');
  return;

} catch (Exception $ex) {
  echo("Exception message: ". $ex->getMessage());
  header('Location: admin-home.php?news_id='.$_GET['news_id']);
  return;
}

 ?>