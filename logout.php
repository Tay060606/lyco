<?php
session_start();
session_destroy();
echo"<script>
alert('You have been logged Out')</script>";
$_SESSION["status"]="no";
?>
<script>window.location='index.php'</script>