<?php
$mysqli = new mysqli("localhost", "zilani", "1234", "smm","3306");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
