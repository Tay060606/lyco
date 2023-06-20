<?php 
session_start();
//connect to database
include("connection.php"); 

//create product id
$query = "SELECT MAX(idbandingan) AS max_id FROM bandingan";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
$max_id = (int)$data["max_id"];
$idbandingan = str_pad($max_id + 1, 5, "0", STR_PAD_LEFT); 

    if(isset($_POST["id"])){ 
        $id = $_POST['id'];
        $nokp = $_SESSION['nokp'];
        $check_query = "SELECT * FROM bandingan WHERE idproduk = '$id'";
        $check_result = mysqli_query($con, $check_query);
        $num_rows = mysqli_num_rows($check_result);
        // check if product already exist in cart, if no then add item to cart
        if ($num_rows > 0) {
            echo "<script>alert('Product already in cart');</script>";
            echo"<script>window.location='pembeli_home.php'</script>"; 
        } else {
            $stmt = mysqli_prepare($con, "INSERT INTO bandingan values(?, ?, ?)"); 
            mysqli_stmt_bind_param($stmt, "sss", $idbandingan, $nokp, $id); 
            mysqli_stmt_execute($stmt); 
            $result = mysqli_stmt_affected_rows($stmt); 
            mysqli_stmt_close($stmt); 
 
            if($result) {
                echo"<script>alert('Add to cart sucessfully!')</script>"; 
                echo"<script>window.location='cart.php'</script>";
            }else {
                echo"<script>alert('Error, Please Contact Admin.')</script>"; 
                echo"<script>window.location='pembeli_home.php'</script>"; }
        }
    } 
    ?>