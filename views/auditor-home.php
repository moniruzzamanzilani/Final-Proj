<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 3){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}

if(isset($_POST['logout'])){
  header('Location:logout.php');
  return;
}
if(isset($_POST['add'])){
  header('Location:add.php');
  return;
}
if(isset($_POST['profile'])){
  header('Location:settings-auditor.php');
  return;
}
if(isset($_POST['change-password'])){
    header("Location: chpass-auditor.php");
    return;
}


// if(isset($_POST['clear-transactions'])){
//   try{
//     $stmt = $pdo->query("DELETE FROM PAYMENT");
//     $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     $_SESSION["success"] = "All Payment status has been cleared.";
//     header("Location: admin-home.php");
//     return;
//   }catch(Exception $ex){
//     echo("Exception message: ". $ex->getMessage());
//     header("Location: admin-home.php");
//     return;
//   }
//
// }

try{
  $stmt = $mysqli->query("SELECT * FROM news where status = 0  ORDER BY dates");
  $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  //$stmt = $pdo->query("SELECT * FROM news where status = 0 order by dates");
  //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: auditor-home.php");
  return;
}

try{
  $stmt = $mysqli->query("SELECT * FROM news where status = 3 ORDER BY dates");
  $rowsd =  $stmt->fetch_all(MYSQLI_ASSOC);
 // $stmt = $pdo->query("SELECT * FROM news where status = 2 order by dates");
  //$rowsd = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: auditor-home.php");
  return;
}
// try{
//
//   $stmt = $pdo->query("SELECT * FROM USER WHERE role = 0
//                                   ORDER BY email");
//   $reader = $stmt->fetchAll(PDO::FETCH_ASSOC);
// }catch(Exception $ex){
//   echo("Exception message: ". $ex->getMessage());
//   header("Location: auditor-home.php");
//   return;
// }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Publisher-home</title>
  </head>
  <body>
  <link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Auditor Home Page</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="settings-auditor.php">Edit Profile</a>
<a href="chpass-auditor.php">Change Password</a>
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
    <h1>Auditor Home Page</h1> -->

    <h2>Welcome
      <?php echo htmlentities($_SESSION['account']); ?>
    </h2>

    <!-- <form method="post">
      <input type="submit" name="profile" value="Edit Profile">
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

  <hr> <h4>Request for Publishing News : </h4>
  <form method="POST">
    <table border="1">
      <?php
          echo "<tr><td style='text-align:center'>";
          echo "News Id";
          echo("</td><td style='text-align:center'>");
          echo "Title";
          echo("</td><td style='text-align:center'>");
          echo "Description";
          echo("</td><td style='text-align:center'>");
          echo "Likes";
          echo("</td><td style='text-align:center'>");
          echo "Dislikes";
          echo("</td><td style='text-align:center'>");
          echo "Date";
          echo("</td><td style='text-align:center'>");
          echo "Operations";
        foreach ( $rows as $row ) {
          echo "<tr><td style='text-align:center'>";
          echo $row['news_id'];
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['title']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['description']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['likes']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['dislikes']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['dates']);
          echo("</td><td style='text-align:center'>");
          echo '<a href="confirm.php?news_id='.$row['news_id'].'">Confirm</a> /';
          echo '<a href="deny.php?news_id='.$row['news_id'].'">Reject</a>';
          echo("</td></tr>\n");
      }
      ?>
    </table><br><br><hr>
  </form>

  <hr> <h4>Request for Deleting News : </h4>
  <form method="POST">
    <table border="1">
      <?php
          echo "<tr><td style='text-align:center'>";
          echo "News Id";
          echo("</td><td style='text-align:center'>");
          echo "Title";
          echo("</td><td style='text-align:center'>");
          echo "Description";
          echo("</td><td style='text-align:center'>");
          echo "Likes";
          echo("</td><td style='text-align:center'>");
          echo "Dislikes";
          echo("</td><td style='text-align:center'>");
          echo "Date";
          echo("</td><td style='text-align:center'>");
          echo "Operations";
        foreach ( $rowsd as $row ) {
          echo "<tr><td style='text-align:center'>";
          echo $row['news_id'];
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['title']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['description']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['likes']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['dislikes']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['dates']);
          echo("</td><td style='text-align:center'>");
          echo '<a href="edit-news.php?news_id='.$row['news_id'].'">Edit</a> /';
          echo '<a href="delete-news.php?news_id='.$row['news_id'].'">Delete</a>';
          echo("</td></tr>\n");
      }
      ?>
    </table><br><br><hr>
  </form>

  </body>
</html>
