<?php
include('cdb.php');

$user = $_POST['uname'];

if($user=="")
{
}   


$connection = new cdb();
$conobj=$connection->OpenCon();

$MyQuery=$connection->GetUserByUname($conobj,"user",$user );



if ($MyQuery->num_rows > 0) {
    
    echo "<table border='1'><tr><th>name</th> <th>email</th> <th>phone</th> </tr>";
    // output data of each row
    while($row = $MyQuery->fetch_assoc()) {
      echo "<tr><td style='text-align:center'>".$row["name"]."</td>   <td style='text-align:center'>".$row["email"]."</td>    <td style='text-align:center'>".$row["phone"]."</td></tr>";
    }
    echo "</table>";
  } else {
    echo "0 results";

  
}