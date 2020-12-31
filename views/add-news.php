<?php
session_start();
require_once "mysqli.php";
if(!isset($_SESSION['account']) || $_SESSION['role'] != 2){
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


if(isset($_POST['Add'])){
  if(isset($_POST['title']) && isset($_POST['description']) && isset($_POST['likes']) && isset($_POST['dislikes']) && isset($_POST['date'])){
    if(strlen($_POST['title']) < 1 || strlen($_POST['description']) < 1 || strlen($_POST['likes']) < 1  || strlen($_POST['dislikes']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: add-news.php");
      return;
    }
    if(!is_numeric($_POST['likes']) || !is_numeric($_POST['dislikes'])){
      $_SESSION["error"] ="likes and dislikes must be a number";
      header("Location: add-news.php");
      return;
    }
    $section = $_POST['section'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $likes=$_POST['likes'];
    $dislikes=$_POST['dislikes'];
    $date=$_POST['date'];
    try{
      $sql = "INSERT INTO news (section,title, description, likes, dislikes, dates, status)
                          VALUES  ('".$section."','".$title."','".$description."', $likes, $dislikes,'".$date."', 0)";
      $stmt = $mysqli->query($sql);
      
      $_SESSION["success"] = "News Requested to Published Successfully.";
      header("Location: publisher-home.php");
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: add-news.php");
      return;
    }
}else{
  $_SESSION['error'] = "All fields are Required.";
  header('Location:add-news.php');
  return;
}

}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>add-news</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Add New News</h1>
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

<h1>Add New News </h1> -->


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
  <input type="text" name="title" size="60"/></p>
  <p>Description:</p>
  <textarea name="description" rows="4" cols="60"> </textarea>
  <p>Likes:
  <input type="text" name="likes" /></p>
  <p>Dislikes:
  <input type="text" name="dislikes" /></p>
  <p>Date:<br>
  <input type="date" name="date">
  </p>
  <p>Role:<br>
   <input type="radio" id="Sports" name="section" value="Sports">
   <label for="Sports">Sports</label><br>
   <input type="radio" id="Entertainment" name="section" value="Entertainment">
   <label for="Entertainment">Entertainment</label><br>
   <input type="radio" id="Jobs" name="section" value="Jobs">
   <label for="Jobs">Jobs</label><br>
   <input type="radio" id="International" name="section" value="International">
   <label for="International">International</label><br>
   <input type="radio" id="Politics" name="section" value="Politics">
   <label for="Politics">Politics</label><br>

  </p>
  <input type="submit" class="button" name="Add" value="Request Publish">
  </form>
<br>
<br>
<br>
<br>
<br>
<br>
</body>
</html>
