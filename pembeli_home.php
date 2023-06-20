<?php
session_start();
if($_SESSION["status"]!="pembeli"){
    header("Location: menu.php");
}
include ('headerBuyer.php'); 
?>
<?PHP include ('slide_show.php'); ?>
<a href="mailto:m-7942138@moe-dl.edu.my">
    <img class='w3-image' src='imej/bottom.png' alt="Clickable Image">
</a>
<?;
