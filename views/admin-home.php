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
if(isset($_POST['add'])){
  header('Location:add.php');
  return;
}
if(isset($_POST['profile'])){
  header('Location:settings-admin.php');
  return;
}
if(isset($_POST['change-password'])){
    header("Location: chpass-admin.php");
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

  $stmt = $mysqli->query("SELECT * FROM USER WHERE role between 2 and 3
                                  ORDER BY email");
             $rows = $stmt->fetch_all(MYSQLI_ASSOC);
  //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: admin-home.php");
  return;
}

try{

  $stmt = $mysqli->query("SELECT * FROM USER WHERE role = 0
                                  ORDER BY email");
        $reader = $stmt->fetch_all(MYSQLI_ASSOC);
 // $reader = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: admin-home.php");
  return;
}
try{
  $stmt = $mysqli->query("SELECT * FROM news where status = 0  ORDER BY dates");
  $rowsl = $stmt->fetch_all(MYSQLI_ASSOC);
  //$stmt = $pdo->query("SELECT * FROM news where status = 0 order by dates");
  //$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: admin-home.php");
  return;
}
try{

  $stmt = $mysqli->query("SELECT * FROM news where status = 1 ORDER BY dates");
  $rowt = $stmt->fetch_all(MYSQLI_ASSOC);
 // $rowt = $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location:admin-home.php");
  return;
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>admin-home</title>
  </head>
  <body>
  <link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>ADMIN Home Page</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="settings-admin.php">Edit Profile</a>
<a href="chpass-admin.php">Change Password</a>
<a href="add.php">Add New Employee</a>
<a href="login.php">Log out</a>
</div>
</div>

<div class="footer">
<p>copyright@2020 really news</p>
</div>
<script>

function showmyuser() {

  var uname=  document.getElementById("uname").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("mytext").innerHTML = this.responseText;
    }
	else
	{
		 document.getElementById("mytext").innerHTML = this.status;
	}
  };
  xhttp.open("POST", "/samtest/getuser.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("uname="+uname);


}
</script>




<!-- <label>find detail of user</label>

  <input type="text" id="uname" onkeyup="showmyuser()" >


<p id="mytext"></p> -->
  <!-- <body style="margin:20px;">
    <form method="post">
      <input type="submit" name="logout" value="Logout"><br><hr>
    </form>
    <h1>ADMIN Home Page</h1> -->

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

<label><p style="color:purple">Find User Details</p></label>

<input type="text" id="uname" onkeyup="showmyuser()" >


<p id="mytext"></p>

  <hr> <h4><p style="color:purple"> Manage Employees :</p> </h4>
  <form method="POST">
    <!-- <input type="submit" name="add" value="Add New Employee"><br><br> -->
    <table border="1">
      <?php
          echo "<tr><td style='text-align:center'>";
           echo "User Id";
           echo("</td><td style='text-align:center'>");
          echo "Name";
          echo("</td><td style='text-align:center'>");
          echo "Email";
          echo("</td><td style='text-align:center'>");
          echo "Phone";
          echo("</td><td style='text-align:center'>");
          echo "Operations";
        foreach ( $rows as $row ) {
          echo "<tr><td style='text-align:center'>";
           echo $row['user_id'];
           echo("</td><td style='text-align:center'>");
          echo htmlentities($row['name']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['email']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['phone']);
          echo("</td><td style='text-align:center'>");
          echo '<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> /';
          echo '<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>';
          echo("</td></tr>\n");
      }
      ?>

    </table><br><br><hr>
  </form>

  <hr> <h4> <p style="color:purple">Manage User : </p></h4>
  <form method="POST">
    <table border="1">
      <?php
          echo "<tr><td style='text-align:center'>";
           echo "User Id";
           echo("</td><td style='text-align:center'>");
          echo "Name";
          echo("</td><td style='text-align:center'>");
          echo "Email";
          echo("</td><td style='text-align:center'>");
          echo "Phone";
          echo("</td><td style='text-align:center'>");
          echo "Operations";
        foreach ( $reader as $row ) {
          echo "<tr><td style='text-align:center'>";
           echo $row['user_id'];
           echo("</td><td style='text-align:center'>");
          echo htmlentities($row['name']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['email']);
          echo("</td><td style='text-align:center'>");
          echo htmlentities($row['phone']);
          echo("</td><td style='text-align:center'>");
          echo '<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>';
          echo("</td></tr>\n");
      }
      ?>

    </table><br><br><hr>
  </form>
  <hr> <h4><p style="color:purple">Request for Publishing Ads : </p></h4>
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
        foreach ( $rowsl as $row ) {
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
          echo '<a href="confirm1.php?news_id='.$row['news_id'].'">Confirm</a> /';
          echo '<a href="deny.php?news_id='.$row['news_id'].'">Reject</a>';
          echo("</td></tr>\n");
      }
      ?>
    </table><br><br><hr>
  </form>
  <hr> <h4><p style="color:purple">All Ads : </p></h4>
    <form method="post">
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

        foreach ( $rowt as $row ) {
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
            echo $row['dates'];
            echo("</td></tr>\n");
        }
        ?>
      </table>
    </form>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  </body>
</html>
