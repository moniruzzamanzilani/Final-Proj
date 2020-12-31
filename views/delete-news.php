<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 2){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}
// If the user requested logout go back to index.php
if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}
if ( isset($_POST['home']) ) {
    header('Location: publisher-home.php');
    return;
}
if ( !isset($_GET['news_id']) ) {
    $_SESSION['error'] = "Missing news Id.";
    header('Location: publisher-home.php');
    return;
}

if ( isset($_POST['Delete']) && isset($_POST['news_id']) ) {
  $news_id=$_POST['news_id'];
    $sql = "DELETE FROM NEWS WHERE news_id = $news_id";
    $stmt = $mysqli->query($sql);
    
    $_SESSION['success'] = 'News deleted';
    header( 'Location: publisher-home.php?news_id='.$_POST['news_id']);
    return;
}
$news_id=$_GET['news_id'];
try {
  $sql = "SELECT * FROM NEWS WHERE news_id = $news_id" ;
  $stmt = $mysqli->query($sql);
  $row = $stmt->fetch_assoc();
  if ( $row === false ) {
      $_SESSION['error'] = 'Account Not Found.';
      header( 'Location: admin-home.php');
      return;
  }
} catch (Exception $ex) {
  echo("Exception message: ". $ex->getMessage());
  header('Location: delete.php?news_id='.$_GET['news_id']);
  return;
}

 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>delete</title>
   </head>
   <body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Delete News</h1>
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
     <div class="container">


       <form method="post">
         <input type="submit" name="logout" value="Logout"><br><hr>
           <input type="submit" name="home" value=" << Home ">
       </form> -->


      <p>Confirm: Deleting <?= htmlentities($row['title']) ?><br>Are You Sure</p>
       <form method="post">
         <input type="submit" class="button" name="Delete" value="Delete">
         <input type="hidden" name="news_id" value="<?=$row['news_id'] ?>">
       </form>

     </div>

   </body>
 </html>
