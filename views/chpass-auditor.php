<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 3){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}

if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}
if ( isset($_POST['home']) ) {
    header('Location: auditor-home.php');
    return;
}


if(isset($_POST['Update'])){

  if(isset($_POST['old-pw'])  && isset($_POST['new-pw'])  && isset($_POST['re-pw'])){
    if(strlen($_POST['old-pw']) < 1 || strlen($_POST['new-pw']) < 1 || strlen($_POST['re-pw']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: chpass-auditor.php");
      return;
    }
    if(strlen($_POST['new-pw']) < 8 || strlen($_POST['re-pw']) < 8){
      $_SESSION["error"] = "Pass must be 8 character long.";
      header("Location: chpass-auditor.php");
      return;
    }
    if(is_numeric($_POST['new-pw']) || is_numeric($_POST['re-pw'])){
      $_SESSION["error"] ="Password must contain a letter and a number.";
      header("Location: chpass-auditor.php");
      return;
    }
    if($_POST['new-pw'] != $_POST['re-pw']){
      $_SESSION["error"] = "Password must be matched.";
      header("Location: chpass-auditor.php");
      return;
    }
    // $salt = 'XyZzy12*_';
    // $check = hash('md5', $salt.$_POST['old-pw']);   //salted-hash protected pattern used
    $email=$_SESSION['account'];
    $password=$_POST['old-pw'];
    try{
      // $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email AND password = :password");
      // $stmt->execute(array(":email" => $_SESSION['account'],
      //                       ":password" => $check)
      //                     );
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt = $mysqli->query("SELECT * FROM user WHERE email = '".$email."' AND password = '".$password."'");
      $row = $stmt->fetch_assoc();
      if($row===false){
        $_SESSION["error"] = "Incorrect Password";
        header("Location: chpass-auditor.php");
        return;
      }
    }
    catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: chpass-auditor.php");
      return;
    }

    // $password = hash('md5', $salt.$_POST['new-pw']);
    $password=$_POST['new-pw'];
    $email=$_SESSION['account'];
    try{
      // $sql = "UPDATE USER SET password = :password
      //                 WHERE email = :email";
      // $stmt = $pdo->prepare($sql);
      // $stmt->execute(array(
      //     ':password' => $password,
      //     ':email' => $_SESSION['account']
      //                   ));
      $sql = "UPDATE USER SET password = '".$password."'
      WHERE email = '".$email."'";
$stmt = $mysqli->query($sql);
      $_SESSION['success'] = 'Password Changed Successfully.';
      header( 'Location: auditor-home.php');
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: chpass-auditor.php");
      return;
    }

  }else{
    $_SESSION['error'] = "All fields are Required.";
    header("Location: chpass-auditor.php");
    return;
    }

}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>change password auditor</title>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Change Password</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="auditor-home.php">Home</a>
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

<h1>Change Password</h1> -->


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
  <p>Old Password:
  <input type="password" name="old-pw" ></p>
  <p>New Password:
  <input type="password" name="new-pw" ></p>
  <p>Confirm Password:
  <input type="password" name="re-pw" ></p>

  <input type="submit" class="button" name="Update" value="Change">
  </form>

</body>
</html>
