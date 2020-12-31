<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 1){
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
    header('Location: admin-home.php');
    return;
}
if ( !isset($_GET['user_id']) ) {
    $_SESSION['error'] = "Missing User Id.";
    header('Location: admin-home.php');
    return;
}

if ( isset($_POST['Delete']) && isset($_POST['user_id']) ) {
  $user_id=$_POST['user_id'];
    $sql = "DELETE FROM USER WHERE user_id = $user_id";
    $stmt = $mysqli->query($sql);
    
    $_SESSION['success'] = 'Employee deleted';
    header( 'Location: admin-home.php?user_id='.$_POST['user_id']);
    return;
}
$user_id=$_GET['user_id'];
try {
  $sql = "SELECT * FROM USER WHERE user_id = $user_id" ;
  $stmt = $mysqli->query($sql);
  $row = $stmt->fetch_assoc();
  if ( $row === false ) {
      $_SESSION['error'] = 'Account Not Found.';
      header( 'Location: admin-home.php');
      return;
  }
} catch (Exception $ex) {
  echo("Exception message: ". $ex->getMessage());
  header('Location: delete.php?user_id='.$_GET['user_id']);
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

<h1>Delete</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="admin-home.php">Home</a>
<a href="login.php">Log Out</a>
</div>
</div>

<div class="footer">
<p>copyright@2020 really news</p>
</div>
   <!-- <body style="margin:20px;">
     <div class="container">


       <form method="post">
         <input type="submit" name="logout" value="Logout"><br><hr>
           <input type="submit" name="home" value=" << Home ">
       </form> -->


      <p>Confirm: Deleting <?= htmlentities($row['email']) ?></p>
      <p>Are You Sure?</p>
       <form method="post">
         <input type="submit" class="button" name="Delete" value="Delete">
         <input type="hidden" name="user_id" value="<?=$row['user_id'] ?>">
       </form>

     </div>

   </body>
 </html>
