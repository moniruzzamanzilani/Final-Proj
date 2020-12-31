<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || !isset($_SESSION['role'])){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}

if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}
if ( isset($_POST['home']) ) {
    header('Location: publisher-home.php');
    return;
}

if (!isset($_GET['news_id'])) {
    $_SESSION['error'] = "Missing news Id.";
    header('Location: publisher-home.php');
    return;
}


if(isset($_POST['Update']) && isset($_POST['news_id'])){

  if(isset($_POST['title']) && isset($_POST['description']) ){
    if(strlen($_POST['title']) < 1 || strlen($_POST['description']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: edit-news.php?news_id=".$_POST['news_id']);
      return;
    }
    $title=$_POST['title'];
    $description=$_POST['description'];
    $news_id=$_POST['news_id'];

    try{
      $sql = "UPDATE news SET title = '".$title."',
              description = '".$description."'
              WHERE news_id = $news_id";
      $stmt = $mysqli->query($sql);
     
      $_SESSION['success'] = 'Employee Information updated';
      header( 'Location: publisher-home.php');
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: edit-news.php?news_id=".$_POST['news_id']);
      return;
    }

  }else{
    $_SESSION['error'] = "All fields are Required.";
    header("Location: edit-news.php?news_id=".$_POST['news_id']);
    return;
    }

}
$news_id=$_GET['news_id'];
try{
  $stmt = $mysqli->query("SELECT * FROM news WHERE news_id = $news_id ");
  //$stmt->execute(array(":news_id" =>  $_GET['news_id']));
  //$row = $stmt->fetch(PDO::FETCH_ASSOC);
  $row = $stmt->fetch_assoc();
  if($row === false){
    $_SESSION["error"] = "news Not Found.";
    header("Location: publisher-home.php");
    return;
  }
  $t = htmlentities($row['title']);
  $d = htmlentities($row['description']);
  $news_id = $row['news_id'];
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: edit-news.php?news_id=".$_POST['news_id']);
  return;
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>edit</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Update News</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="publisher-home.php">Home</a>
<a href="login.php">Log Out</a>
</div>
</div>

<div class="footer">
<p>Footer</p>
</div>
<!-- <body style="margin:20px;">

<form method="post">
  <input type="submit" name="logout" value="Logout"><br><hr>
    <input type="submit" name="home" value=" << Home ">
</form>

<h1>Update News </h1> -->


<?php

  if ( isset($_SESSION["success"]) ) {
      echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
      unset($_SESSION["success"]);
  }
  else if ( isset($_SESSION["error"]) ) {
      echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
      unset($_SESSION["error"]);
  }
?>
  <form method="post">
  <p>Title:
  <input type="text" name="title" size="60" value="<?= $t ?>"></p>
  <p>Description:</p>

  <textarea name="description"  rows="4" cols="60"> <?= $d ?>"> </textarea><br><br>
  <input type="hidden" name="news_id" value="<?= $row['news_id'] ?>">
  <input type="submit" class="button" name="Update" value="Update">
  </form>

</body>
</html>
