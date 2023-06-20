<?php 
session_start();
include("connection.php"); 

$query = "SELECT MAX(idorder) AS max_id FROM myorder";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);
$max_id = (int)$data["max_id"];
$idorder = str_pad($max_id + 1, 5, "0", STR_PAD_LEFT); 

if(isset($_POST["order"])){ 
    $id = $_POST['id'];
    $nokp = $_SESSION['nokp'];
    $query = "SELECT idproduk FROM bandingan WHERE idbandingan = '$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    $idproduk = $data['idproduk'];
    $query = "SELECT namaproduk,keterangan,gambar,harga,link FROM produk WHERE idproduk = '$idproduk'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    $namaproduk = $data['namaproduk'];
    $keterangan = $data['keterangan'];
    $gambar = $data['gambar'];
    $harga = $data['harga'];
    $link = $data['link'];
    $query = "SELECT email FROM penjual WHERE nokp = '$nokp'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $email = $row['email'];

    $stmt = mysqli_prepare($con, "INSERT INTO myorder (idorder, nokp, email, idproduk, namaproduk, keterangan, gambar, harga, link) values(?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
    mysqli_stmt_bind_param($stmt, "sssssssss", $idorder, $nokp, $email, $idproduk, $namaproduk, $keterangan, $gambar, $harga, $link); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_affected_rows($stmt); 
    mysqli_stmt_close($stmt); 

    $select_query = "SELECT spent FROM pembeli WHERE nokp = '$nokp'";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($result);
    $spent = $row['spent'];
    $select_query = "SELECT harga FROM produk WHERE idproduk = '$idproduk'";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($result);
    $harga = $row['harga'];
    $new_spent = $spent + $harga;
    $update_query = "UPDATE pembeli SET spent = $new_spent WHERE nokp = '$nokp'";
    mysqli_query($con, $update_query);

    $sql = "DELETE FROM bandingan WHERE idbandingan='$id'";
    mysqli_query($con, $sql);
    echo"<script>alert('Order placed successfully')</script>";
    echo"<script>window.location='order.php'</script>"; 
    } elseif(isset($_POST["remove"])){ 
        if(isset($_POST["remove"])){ 
            $id = $_POST['id'];
            $check_query = "SELECT * FROM bandingan WHERE idbandingan = '$id'";
            $check_result = mysqli_query($con, $check_query);
            $num_rows = mysqli_num_rows($check_result);
            if ($num_rows > 0) {
                $sql = "DELETE FROM bandingan WHERE idbandingan ='$id'";
                mysqli_query($con, $sql);
                echo"<script>alert('Removed successfully')</script>";
                echo"<script>window.location='cart.php'</script>"; 
            } else {
                echo"<script>alert('Error, Please Contact Admin.')</script>"; 
                echo"<script>window.location='pembeli_home.php'</script>"; 
            }
        }
    }
    ?>