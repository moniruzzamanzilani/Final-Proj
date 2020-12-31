<?php
require_once "mysqli.php";
session_start();
if(!isset($_SESSION['account']) || $_SESSION['role'] != 3){
  $_SESSION['error'] = "Login First.";
  header('Location: login.php');
  return;
}
if ( isset($_POST['home']) ) {
    header('Location: auditor-home.php');
    return;
}
if (isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}


if(isset($_POST['Update'])){

  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])){
    if(strlen($_POST['name']) < 1 || strlen($_POST['email']) < 1 || strlen($_POST['phone']) < 1){
      $_SESSION["error"] = "All field required";
      header("Location: settings-auditor.php");
      return;
    }
    $pos = strpos($_POST['email'], '@');
    if($pos == 0){
      $_SESSION["error"] = "Email must have an at-sign (@)";
      header("Location: settings-auditor.php");
      return;
    }
    if(!is_numeric($_POST['phone'])){
      $_SESSION["error"] ="Phone number must be a number";
      header("Location: settings-auditor.php");
      return;
    }
    $user_id=$_POST['user_id'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    try {
      // $stmt = $pdo->prepare("SELECT * FROM USER WHERE email = :email AND user_id <> :user_id
      //                                               OR phone = :phone AND user_id <> :user_id  ");
      // $stmt->execute(array(":user_id" =>  $_POST['user_id'],
      //                       ':email' => $_POST['email'],
      //                       ':phone' => $_POST['phone']));
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $stmt = $mysqli->query("SELECT * FROM USER WHERE email = '".$email."' AND user_id <> $user_id
      OR phone = $phone AND user_id <> $user_id  ");
     $row = $stmt->fetch_assoc();
      if($row != false){
        $_SESSION["error"] = "Email and Phone must be unique";
        header("Location: settings-auditor.php");
        return;
      }
    } catch (Exception $eX) {
      echo("Exception message: ". $ex->getMessage());
      header("Location: settings-auditor.php");
      return;
    }

    $name= $_POST['name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $user_id= $_POST['user_id'];
    try{
      // $sql = "UPDATE USER SET name = :name,
      //         email = :email, phone = :phone
      //         WHERE user_id = :user_id";
      // $stmt = $pdo->prepare($sql);
      // $stmt->execute(array(
      //     ':name' => $_POST['name'],
      //     ':email' => $_POST['email'],
      //     ':phone' => $_POST['phone'],
      //     ':user_id' => $_POST['user_id']));
      $sql = "UPDATE USER SET name = '".$name."',
      email = '".$email."', phone = $phone
      WHERE user_id = $user_id";
$stmt = $mysqli->query($sql);
      $_SESSION['success'] = 'Account Information updated';
      $_SESSION['account'] = $_POST['email'];
      header("Location: auditor-home.php");
      return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: settings-auditor.php");
      return;
    }

    }else{
    $_SESSION['error'] = "All fields are Required.";
    header("Location: settings-auditor.php");
    return;
    }

}


$email=$_SESSION['account'];
try{
  // $stmt = $pdo->prepare("SELECT * FROM USER WHERE email = :email");
  // $stmt->execute(array(":email" =>  $_SESSION['account']));
  // $row = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt = $mysqli->query("SELECT * FROM USER WHERE email = '".$email."'");
  $row = $stmt->fetch_assoc();
  $_SESSION['account'];
  if($row === false){
    $_SESSION["error"] = "Account Not Found.";
    header("Location: reader-home.php");
    return;
  }
  $n = htmlentities($row['name']);
  $e = htmlentities($row['email']);
  $ph = htmlentities($row['phone']);
  $user_id = $row['user_id'];
}catch(Exception $ex){
  echo("Exception message: ". $ex->getMessage());
  header("Location: settings-em.php");
  return;
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>settings auditor</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="header">

<h1>Account Settings</h1>
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

<h1>Account Settings </h1> -->


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
  <p>Name: <?=htmlentities($n)?> &rarr;
  <input type="text" name="name"></p>
  <p>Email: <?=htmlentities($e)?> &rarr;
  <input type="text" name="email"></p>
  <p>Phone: <?=htmlentities($ph)?> &rarr;
  <input type="text" name="phone"></p>


  <input type="hidden" name="user_id" value="<?= $user_id ?>">
  <input type="submit" class="button" name="Update" value="Update">
  </form>

</body>
</html>
