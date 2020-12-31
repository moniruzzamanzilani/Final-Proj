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
    header('Location: admin-home.php');
    return;
}

if (!isset($_GET['user_id'])) {
    $_SESSION['error'] = "Missing User Id.";
    header('Location: admin-home.php');
    return;
}


if(isset($_POST['Update']) && isset($_POST['user_id'])){

  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['role'])){
    if(strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['phone']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: edit.php?user_id=".$_POST['user_id']);
      return;
    }
    $pos = strpos($_POST['email'], '@');
    if($pos == 0){
      $_SESSION["error"] = "Email must have an at-sign (@)";
      header("Location: edit.php?user_id=".$_POST['user_id']);
      return;
    }
    if(!is_numeric($_POST['phone'])){
      $_SESSION["error"] ="Phone number must be a number";
      header("Location: edit.php?user_id=".$_POST['user_id']);
      return;
    }
    $user_id=$_POST['user_id'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];

    try {
      $stmt = $mysqli->query("SELECT * FROM USER WHERE email = '".$email."' AND user_id <> $user_id
                                                    OR phone = $phone AND user_id <> $user_id  ");
      $row = $stmt->fetch_assoc();
      if($row != false){
        $_SESSION["error"] = "Email and Phone must be unique";
        header("Location: edit.php?user_id=".$_POST['user_id']);
        return;
      }
    } catch (Exception $eX) {
      echo("Exception message: ". $ex->getMessage());
      header("Location: edit.php?user_id=".$_POST['user_id']);
      return;
    }
    $name=$_POST['name'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $role=$_POST['role'];
    $user_id=$_POST['user_id'];
    try{
      $sql = "UPDATE USER SET name = '".$name."',
              email = '".$email."', phone = $phone,role = $role
              WHERE user_id = $user_id";
      $stmt = $mysqli->query($sql);
      
      $_SESSION['success'] = 'Employee Information updated';
      header( 'Location: admin-home.php');
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: edit.php?user_id=".$_POST['user_id']);
      return;
    }

  }else{
    $_SESSION['error'] = "All fields are Required.";
    header("Location: edit.php?user_id=".$_POST['user_id']);
    return;
    }

}
$user_id=$_GET['user_id'];
try{
  $stmt = $mysqli->query("SELECT * FROM USER WHERE user_id = $user_id ");
  $row = $stmt->fetch_assoc();
  if($row === false){
    $_SESSION["error"] = "Account Not Found.";
    header("Location: admin-home.php");
    return;
  }
  $n = htmlentities($row['name']);
  $e = htmlentities($row['email']);
  $ph = htmlentities($row['phone']);
  $rol = $row['role'];
  $user_id = $row['user_id'];
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: edit.php?user_id=".$_POST['user_id']);
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

<h1>Account Settings</h1>
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

<form method="post">
  <input type="submit" name="logout" value="Logout"><br><hr>
    <input type="submit" name="home" value=" << Home ">
</form>

<h1>Update Employees </h1> -->


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
  <p>Name:
  <input type="text" name="name" size="60" value="<?= $n ?>"></p>
  <p>Email:
  <input type="text" name="email" value="<?= $e ?>"></p>
  <p>Phone:
  <input type="text" name="phone" value="<?= $ph ?>"></p>
  <p>Role:<br>
    <?php if ($rol == 2){ ?>
   <input type="radio" id="publisher" name="role" value="2" checked>
   <label for="publisher">Publisher</label><br>
   <input type="radio" id="auditor" name="role" value="3">
   <label for="auditor">Auditor</label><br>
 <?php }else if($rol == 3){ ?>

  <input type="radio" id="publisher" name="role" value="2">
  <label for="publisher">Publisher</label><br>
  <input type="radio" id="auditor" name="role" value="3" checked>
  <label for="auditor">Auditor</label><br>
    <?php } ?>
  </p>

  <input type="hidden" name="user_id" value="<?= $row['user_id'] ?>">
  <input type="submit" class="button" name="Update" value="Update">
  </form>

</body>
</html>
