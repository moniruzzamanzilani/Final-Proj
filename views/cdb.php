<?php
class cdb{
function OpenCon() {
$servername = "localhost";
$username = "zilani";
$password = "1234";
$dbname= "smm";
$conn = new mysqli($servername, $username, $password, $dbname); return $conn;}
function GetUserByUname($conn,$table, $uname)
{
$result = $conn->query("SELECT * FROM  $table WHERE name='$uname'");
return $result;
}
}
