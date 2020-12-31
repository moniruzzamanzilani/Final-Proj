<?php
require_once "mysqli.php";
session_start();
if(isset($_SESSION['account'])){
    unset($_SESSION['account']);
}
if(isset($_SESSION['code'])){
    unset($_SESSION['code']);
}
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="loopslider.min.css">
    <title>index</title>
    <style>
      body { padding: 0;  margin:0; }
      .container { margin: 150px auto;  }
      h1 { margin-bottom: 30px; text-align: center; }
    </style>
  </head>

<body>
  <div class="header">
    <!-- <img src="download.jpg" id="img" width="100" height="120"> -->
    <h1>Social Media Management</h1>
  </div>

  <div class="sticky">
    <div class="topnav">
      <a href="login.php">Login</a>
      <!-- <a href="conf-signup.php">Sign up As Admin</a>
      <a href="signup-reader.php">Sign up As User</a> -->
    </div>
  </div>

  <script type="text/javascript">
    // var _gaq = _gaq || [];
    // _gaq.push(['_setAccount', 'UA-36251023-1']);
    // _gaq.push(['_setDomainName', 'jqueryscript.net']);
    // _gaq.push(['_trackPageview']);

    // (function() {
    //   var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    //   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    //   var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    // })();
  </script>

  <script src="../js/myscript.js"></script>

      <?php

        if ( isset($_SESSION["success"]) ) {
            echo('<p id="para2">'.$_SESSION["success"]."</p>\n");
            unset($_SESSION["success"]);
        }
        else if ( isset($_SESSION["error"]) ) {
            echo('<p id="para1">'.$_SESSION["error"]."</p>\n");
            unset($_SESSION["error"]);
        }
      ?>

      <!-- <br><h4><p id="para1"> Rules for Signup </p></h4> -->
      <p id="demo1" style="padding-right:12px;">

      <script>
        var d = new Date();
        document.getElementById("demo1").innerHTML = d;
        document.getElementById("demo1").style.color = "purple";
        document.getElementById("demo1").style.textAlign = "Right";
      </script>
    </p>

      <h4><p style="padding-left:12px;" id="demo"  onclick="myFunction()"> &gt;&gt;Rules for Signup</p></h4>

      <!-- <ul>
        <li>
          <p>You must know the  Reference number to Signup as Admin. Contact Admin if you don't. </p>
        </li>
        <li>
            <p>Signup option is only for Admin and General readers. Don't Signup if you are not any. </p>
        </li>
        <li>
            <p>Publishers and auditors are only created by Admin. </p>
        </li>
        <li>
            <p>Admin has the full authority to delete any user or post. </p>
        </li>
      </ul> -->

    <br>

    <div class="footer">
      <p>copyright@2020 Zilani</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
    <script src="../js/loopslider.min.js"></script>
  </body>
</html>
