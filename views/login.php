
<?php
require_once "mysqli.php";
session_start();
if(isset($_POST['mainpage'])){
  header("Location: index.php");
  return;
}
if(isset($_POST['signuppage'])){
  header("Location: signup-reader.php");
  return;
}
if(isset($_SESSION['account'])){
    unset($_SESSION['account']);
}
if(isset($_SESSION['code'])){
    unset($_SESSION['code']);
}
if(isset($_POST['login'])){
  if (isset($_POST['email']) && isset($_POST['pass'])){
    unset($_SESSION['account']);
        if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
              $_SESSION["error"] = "Email and password are required";
              header("Location: login.php");
              return;
        } else {

            $pos = strpos($_POST['email'], '@');
            if($pos == 0){
                $_SESSION["error"] = "Email must have an at-sign (@)";
                header("Location: login.php");
                return;
            }
            $email = $_POST['email'];
            $pass = $_POST['pass'];
            //$salt = 'XyZzy12*_';
            //$check = hash('md5', $_POST['pass']);   //salted-hash protected pattern used
            try{
              $stmt = $mysqli->query("SELECT role, user_id FROM user WHERE email ='".$email ."' AND password = '".$pass."'");
              $row = $stmt->fetch_assoc();
              if($row == FALSE){
                $_SESSION["error"] = "Incorrect Email or Password";
                header("Location: login.php");
                return;
              }
            }
            catch(Exception $ex){
              echo("Exception message: ". $ex->getMessage());
              header("Location: login.php");
              return;
            }
            if($row['role'] == 1){
              $_SESSION["account"] = $_POST["email"];
              $_SESSION["role"] = $row["role"];
              $_SESSION["success"] = "Logged in.";
              header("Location: admin-home.php");
               setcookie('alogin','true', time()+60,'/');
              error_log("Login success ".$_POST['email']);
              return;
            }

        }
  }
}


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 <title>Login</title>
 </head>
 <body>
 <link rel="stylesheet" type="text/css" href="style.css">
 <div class="header">

<h1>Login</h1>
</div>
<div class="sticky">
<div class="topnav">
<a href="index.php">Main Page</a>
<!-- <a href="conf-signup.php">Sign up As Admin</a> -->

</div>
</div>
<div class="footer">
<p>copyright@2020 Zilani</p>
</div>
 <!-- <body style="margin:20px;">
 <div class="container">
   <form method="POST">
     <input type="submit" name="mainpage" value=" << Main Page "> <span style="margin-right:20px;"></span>
     <input type="submit" name="signuppage" value=" Signup Page >> "><br>
   </form> -->
   <h1><p id="para1">Please Log In</p></h1>
 <?php
     if ( isset($_SESSION["error"]) ) {
         echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
         unset($_SESSION["error"]);
     }
     if ( isset($_SESSION["success"]) ) {
         echo('<p style="color:green">'.$_SESSION["success"]."</p>\n");
         unset($_SESSION["success"]);
     }
 ?>
 <form method="POST">
  <fieldset>
 <label for="nam">Email</label>
 <input type="text" name="email" id="nam"><br/>
 <label for="id_1723">Password</label>
 <input type="password" name="pass" id="id_1723"><br/>
 <input type="submit" class=button name= "login" value="Log In">
  </fieldset>
 <a href="recovery.php">Forgot Password?</a>
 </form>
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
<br>
<br><br>
<br>
<br>
<br>
<br>
<br>
<br>
 </body>
 </body>
 </html>
