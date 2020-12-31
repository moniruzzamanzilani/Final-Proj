<?php
require_once "mysqli.php";
session_start();
if(isset($_POST['mainpage'])){
  header('Location:index.php');
  return;
}
if(isset($_SESSION['account'])){
    unset($_SESSION['account']);
}
if(!isset($_SESSION['code'])){
    header('Location: conf-signup.php');
    return;
}

if(isset($_POST['signup'])){
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['pw']) && isset($_POST['re-pw'])){
    if(strlen($_POST['name'])<1 || strlen($_POST['email'])<1 || strlen($_POST['phone'])<1 || strlen($_POST['pw'])<1 || strlen($_POST['re-pw'])<1){
      $_SESSION["error"] = "All fields are required.";
      header("Location: signup.php");
      return;
    }

    $pos = strpos($_POST['email'], '@');
    if($pos == 0){
      $_SESSION["error"] = "Email must have an at-sign (@)";
      header("Location: signup.php");
      return;
    }
    if(!is_numeric($_POST['phone'])){
      $_SESSION["error"] = "Phone number must be a number.";
      header("Location: signup.php");
      return;
    }
    if($_POST['pw'] != $_POST['re-pw']){
      $_SESSION["error"] = "Password must be matched.";
      header("Location: signup.php");
      return;
    }

    $email = $_POST['email'];
    $phone = $_POST['phone'];
    try{
      $stmt = $mysqli->query("SELECT role FROM user WHERE email = '".$email."' OR phone = $phone");
      $row = $stmt->fetch_assoc();
      if($row != FALSE){
        $_SESSION["error"] = "Account already exist with this email or phone. Login to continue.LOL";
        header("Location: login.php");
        return;
      }
    }
    catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
      header("Location: signup.php");
      return;
    }

    $name = $_POST['name'];
    $pw = $_POST['pw'];
    $rol=1;
    try{
      // $sql = "INSERT INTO USER (name, email, password, phone, role)
      //                     VALUES ('".$name."', '".$email."', '".$pw."', $phone, 1)";
      // $stmt = $mysqli->query($sql);
      //     $_SESSION["success"] = "Signup Successfully.";
      //     unset($_SESSION['code']);
      //     header("Location: index.php");
      //     return;
      $sql = "insert into user (name, email, phone,password, role)
                          VALUES ( ?, ?, ?, ?, ?)";
      $stmt = $mysqli->prepare($sql);
      $stmt->bind_param("ssisi", $name, $email,$phone,$pw,$rol);
      $stmt->execute();
           $_SESSION["success"] = "Signup Successfully.";
           unset($_SESSION['code']);
          header("Location: signup.php");
          return;
    }catch(Exception $ex){
      echo("Exception message: ". $ex->getMessage());
        $_SESSION["error"] = " LOL.";
      header("Location: signup.php");
      return;
    }

  }else{
    $_SESSION['error'] = "Fillup all the field correctly.";
    header('Location: signup.php');
    return;
  }


}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>signup</title>
  </head>
  <!-- <body style="margin:20px;"> -->
  <body>
  <script src="../js/myscript.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">

<div class="header">

<h1>Admin Sign Up</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="index.php">Main Page</a>
<a href="login.php">Log In</a>
<!-- //<a href="signup-reader.php">Sign up As Reader</a> -->
</div>
</div>

<div class="footer">
<p>copyright@2020 really news</p>
</div>
<br>
<br>
<br>

    <!-- <div class= "container">
      <form method="POST">

        <input type="submit" name="mainpage" value="<< Main Page"><br>

      </form>
      <h1> Sign UP</h1> -->

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


         <form name="myForm" action="" onsubmit="return validateForm()"
method="post">


      <!-- <form method="post"> -->
        <table>
          <tr>
            <td>Name</td>
            <td> <input type="text" id="name" name="name" size=60> </td>
          </tr>
          <tr>
          <td>Email</td>
            <td> <input type="text" id="email" name="email" size=60> </td>
          </tr>
          <tr>
            <td>Phone</td>
              <td> <input type="text" id="phone"  name="phone"> </td>
            </tr>
          <tr>
          <tr>
            <td>Password</td>
              <td> <input type="password"id="pw" name="pw"> </td>
            </tr>
          <tr>
          <tr>
            <td>Re-type Password</td>
              <td> <input type="password"id="re-pw" name="re-pw"> </td>
            </tr>
          <tr>
            <td> <input type="submit"  class="button" name="signup" value='Signup'> </td>
          </tr>
        </table>
      </form>

      <!-- <p><a href="login.php">Login</a> Or Goto <a href="index.php"> Main Page </a> </p> -->

    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
  <!-- </body> -->
      </body>
</html>
