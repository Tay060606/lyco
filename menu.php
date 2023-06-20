<?php
// Start the session
session_start();

// Set the session status to "no"
$_SESSION["status"] = "no";

// Include the header file
include('header.php');
?>

<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/type.css">
    <!-- Middle -->
    <?php include('slide_show2.php'); ?>
    <a href="mailto:m-7942138@moe-dl.edu.my">
    <img class='w3-image' src='imej/bottom.png' alt="Clickable Image">
    </a>

<?php ;?>
