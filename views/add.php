<?php
session_start();
require_once "mysqli.php";
if(!isset($_SESSION['account']) || $_SESSION['role'] != 1){
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


if(isset($_POST['Add'])){
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pw']) && isset($_POST['role'])){
    if(strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['phone']) < 1  || strlen($_POST['pw']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: add.php");
      return;
    }
    $pos = strpos($_POST['email'], '@');
    if($pos == 0){
      $_SESSION["error"] = "Email must have an at-sign (@)";
      header("Location: add.php");
      return;
    }
    if(!is_numeric($_POST['phone'])){
      $_SESSION["error"] ="Phone number must be a number";
      header("Location: add.php");
      return;
    }
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    try{
      $stmt = $mysqli->query("SELECT role FROM user WHERE email = '".$email."' OR phone = $phone");
      $row = $stmt->fetch_assoc();
     // $stmt = $mysqli->query("SELECT role FROM user WHERE email = :email OR phone = :phone");

     // $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row != false){
        $_SESSION["error"] = "Account already exist with this email or phone";
        header("Location: add.php");
        return;
      }
    }
    catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: add.php");
      return;
    }

    // $salt = 'XyZzy12*_';
    // $password = hash('md5', $salt.$_POST['pw']);
    $name = $_POST['name'];
    $pw = $_POST['pw'];
    $role=$_POST['role'];
    try{
//       $sql = "INSERT INTO USER (name, email, password, phone, role)
//       VALUES ('".$name."', '".$email."', '".$pw."', $phone, $role)";
// $stmt = $mysqli->query($sql);
$sql = "insert into user (name, email, phone,password, role)
VALUES ( ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ssisi", $name, $email,$phone,$pw,$role);
$stmt->execute();


      $_SESSION["success"] = "Employee Added Successfully.";
      header("Location: admin-home.php");
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: add.php");
      return;
    }
}else{
  $_SESSION['error'] = "All fields are Required.";
  header('Location:add.php');
  return;
}

}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>add</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Add New Empolyee</h1>
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

<h1>Add New Employees </h1> -->


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
  <input type="text" name="name" size="60"/></p>
  <p>Email:
  <input type="text" name="email"/></p>
  <p>Phone:
  <input type="text" name="phone" /></p>
  <p>Password:
  <input type="text" name="pw" /></p>
  <p>Role:<br>
   <input type="radio" id="publisher" name="role" value="2">
   <label for="publisher">Admin</label><br>
   <input type="radio" id="auditor" name="role" value="3">
   <label for="auditor">Advertisement Manager</label><br>
  </p>
  <input type="submit" class="button" name="Add" value="Add">
  </form>

</body>
</html>
