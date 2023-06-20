<?php 
session_start();
include("connection.php"); 
if(isset($_POST["approve"])){ 
    $id = $_POST['id'];
    $query = "SELECT * FROM verify WHERE idverify = '$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    $idproduk = $data['idverify'];
    $namaproduk = $data['namaproduk'];
    $keterangan = $data['keterangan'];
    $gambar = $data['gambar'];
    $harga = $data['harga'];
    $category = $data['category'];
    $conditions = $data['conditions'];
    $link = $data['link'];
    $idpenjual = $data['idpenjual'];
    $stmt = mysqli_prepare($con, "INSERT INTO produk (idproduk, namaproduk, keterangan, gambar, harga, category, conditions, link, idpenjual) values(?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
    mysqli_stmt_bind_param($stmt, "sssssssss", $idproduk, $namaproduk, $keterangan, $gambar, $harga, $category, $conditions, $link, $idpenjual); 
    mysqli_stmt_execute($stmt); 
    $result = mysqli_stmt_affected_rows($stmt); 
    mysqli_stmt_close($stmt); 

    $sql = "DELETE FROM verify WHERE idverify ='$id'";
    mysqli_query($con, $sql);
    echo"<script>window.location='admin.php'</script>"; 

    } elseif(isset($_POST["deny"])){ 
        $id = $_POST['id'];
        $nokp = $_SESSION['nokp'];
        $update_query = "UPDATE verify SET productstatus = '1', idadmin = '$nokp' WHERE idverify = '$id'";
        mysqli_query($con, $update_query);
        echo"<script>window.location='admin.php'</script>"; 
    }

    ?>