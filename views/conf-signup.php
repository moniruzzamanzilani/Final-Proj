<?php
session_start();

if(isset($_POST['mainpage'])){
  header('Location:index.php');
  return;
}
if(isset($_SESSION['code'])){
    unset($_SESSION['code']);
}

$refer = 'ref00000';
if(isset($_POST['confirm'])){
  if(!isset($_POST['referenceno']) || strlen($_POST['referenceno'])<1){
    $_SESSION['error'] = "Type your reference number to goto signup page.";
    header('Location:conf-signup.php');
    return;
  }
  if( $refer !=  $_POST['referenceno'] ){
    $_SESSION['error'] = "Reference number must be matched";
    header('Location:conf-signup.php');
    return;
  }
  $_SESSION['success'] = "Admin Confirmed.";
  $_SESSION["code"] =  $_POST['referenceno'];
  header('Location:signup.php');
  return;

}




 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>confirm signup</title>
   </head>
   <body style="margin:20px;">
     <body>
     
   <link rel="stylesheet" type="text/css" href="style.css">
     
     <div class="header">
     <h1> Admin Confirmation </h1>
</div>
     <div class="sticky">
<div class="topnav">
       <!-- <input type="submit" name="mainpage" value="<< Main Page"><br> -->
       <a href="index.php">Main Page</a>
       </div>
</div>
<div class="footer">
<p>copyright@2020 really news</p>
</div>
     </form>

 
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
<br>
<br>
<br>
     <form method="post">

       <label for="id_1723">Reference Number</label>
       <input type="text" name="referenceno" id="id_1723"><br/>
       <input type="submit" class="button" name="confirm" value="Confirm">

<ul>     </form>
<li>
     <p>You must know the  Reference number to Signup. Contact HR Admin if you don't. </p>
      </li>
      <li>  <p>Signup option is only for Admin and General Reader. Don't Signup if you are not any. </p></li>
      </ul>
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
