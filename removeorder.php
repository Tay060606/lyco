<?php 
session_start();
include("connection.php"); 

if(isset($_POST["remove"])){ 
    $id = $_POST['id'];
    $nokp = $_SESSION['nokp'];

    $select_query = "SELECT spent FROM pembeli WHERE nokp = '$nokp'";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($result);
    $spent = $row['spent'];

    $query = "SELECT harga FROM myorder WHERE idorder = '$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    $harga = $data['harga'];
    $new_spent = $spent - $harga;
    $update_query = "UPDATE pembeli SET spent = $new_spent WHERE nokp = '$nokp'";
    mysqli_query($con, $update_query);
    
    $sql = "DELETE FROM myorder WHERE idorder ='$id'";
    mysqli_query($con, $sql);
    echo"<script>alert('Removed')</script>";
    echo"<script>window.location='order.php'</script>"; 
    }
    ?>