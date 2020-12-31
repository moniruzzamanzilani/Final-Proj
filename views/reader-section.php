<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 0){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}

if(isset($_POST['logout'])){
  header('Location:logout.php');
  return;
}

if(isset($_POST['edit-profile'])){
  header('Location:settings-reader.php');
  return;
}

if(isset($_POST['change-password'])){
    header("Location: chpass-reader.php");
    return;
}


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>reader-section</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

<div class="header">

<h1>User Home Page</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="settings-reader.php">Edit Profile</a>
<a href="chpass-reader.php">Change Password</a>
<a href="login.php">Log out</a>
</div>
</div>

<div class="footer">
<p>Footer</p>
</div>
  <!-- <body style="margin:20px;">
    <form method="post">
      <input type="submit" name="logout" value="Logout"><br><hr>
    </form>
    <h1>READER Home Page</h1> -->

    <h2>Welcome
      <?php echo htmlentities($_SESSION['account']); ?>
    </h2>

    <!-- <form method="post">
      <input type="submit" name="edit-profile" value="Edit Profile">
      <input type="submit" name="change-password" value="Change Password"><br><hr>
    </form> -->

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
<div class="section">

  <p><a  href="reader-home.php?sec=Sports">Sports</a></p>
  <p><a  href="reader-home.php?sec=Entertainment">Entertainment</a></p>
  <p><a  href="reader-home.php?sec=Jobs">Jobs</a></p>
  <p><a  href="reader-home.php?sec=International">International</a></p>
  <p><a  href="reader-home.php?sec=Politics">Politics</a></p>

    </div>


  </body>
</html>
