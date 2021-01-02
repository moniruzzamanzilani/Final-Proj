<?php
session_start();
session_destroy();
if(isset($_COOKIE['login']))
{
setcookie('alogin', 'false', time()-1,'/');
}
header('Location: index.php');
?>
