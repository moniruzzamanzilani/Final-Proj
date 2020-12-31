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
if(!isset($_GET['sec'])){
  header("Location: reader-section.php");
  return;
}

try{

  $stmt = $mysqli->query("SELECT * FROM news where status = 1 AND section= '".$_GET['sec']. "' ORDER BY dates");
  $rowt = $stmt->fetch_all(MYSQLI_ASSOC);
 // $rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location:reader-home.php");
  return;
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>reader-home</title>
  </head>
  <body>
  <link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Reader Home Page</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="reader-section.php">Home </a>
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

    <hr> <h4>All News : </h4>
    <form method="post">
      <table border="1">
        <?php
            echo "<tr><td style='text-align:center'>";
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
        foreach ( $rowt as $row ) {
            echo "<tr><td style='text-align:center'>";
            echo htmlentities($row['title']);
            echo("</td><td style='text-align:center'>");
            echo htmlentities($row['description']);
            echo("</td><td style='text-align:center'>");
            echo htmlentities($row['likes']);
            echo("</td><td style='text-align:center'>");
            echo htmlentities($row['dislikes']);
            echo("</td><td style='text-align:center'>");
            echo $row['dates'];
            echo("</td><td style='text-align:center'>");
            echo '<a href="likes-news.php?news_id='.$row['news_id'].'">Like</a> /';
            echo '<a href="dislikes-news.php?news_id='.$row['news_id'].'">Dislike</a>';
            echo("</td></tr>\n");
        }
        ?>
      </table>
    </form>
  </body>
</html>
