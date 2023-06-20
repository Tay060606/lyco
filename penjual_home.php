<?php
session_start();
if($_SESSION["status"]!="penjual"){
  header("Location: daftarpenjual.php");
}
$namapenjual = $_SESSION["namapenjual"];
include("connection.php");
$idpenjual = $_SESSION["nokp"];
if(isset($_POST["submit"])){ 
  $query = "SELECT MAX(idproduk) AS max_id FROM produk";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);
  $max_id = (int)$data["max_id"];
  $query = "SELECT MAX(idverify) AS max_id FROM verify";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);
  $max_id2 = (int)$data["max_id"];
  if ($max_id > $max_id2){
    $idverify = str_pad($max_id + 1, 4, "0", STR_PAD_LEFT); 
  } else {
    $idverify = str_pad($max_id2 + 1, 4, "0", STR_PAD_LEFT); 
  }
    $namaproduk = $_POST["namaproduk"]; 
    $keterangan = $_POST["keterangan"]; 
    $gambar = $_FILES["gambar"]["name"];
    $harga = $_POST["harga"];
    $category = $_POST["category"];
    $conditions = $_POST["conditions"];
    $link = $_POST["link"];
    $idadmin = "000000000000";
    $productstatus = "0";
    $check_query = "SELECT * FROM verify WHERE namaproduk = '$namaproduk'";
    $check_result = mysqli_query($con, $check_query);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows > 0) {
        echo "<script>alert('Product with the same name already e/xists.');</script>";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO verify (idverify, namaproduk, keterangan, gambar, harga, category, conditions, link, idpenjual, idadmin, productstatus) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        mysqli_stmt_bind_param($stmt, "sssssssssss", $idverify, $namaproduk, $keterangan, $gambar, $harga, $category, $conditions, $link, $idpenjual, $idadmin, $productstatus); 
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_affected_rows($stmt); 
        mysqli_stmt_close($stmt); 

        if($result){ 
            $uploaddir = "imej/product/";
            $uploadfile = $uploaddir . basename($_FILES['gambar']['name']);
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Product information successfully added and image uploaded.');</script>";
            } else {
                echo "<script>alert('Product information added, but failed to upload the image.');</script>";
            }
        } else {
            echo "<script>alert('Failed to add product information.');</script>"; 
        }
        echo "<script>window.location='penjual_home.php'</script>"; 
    }
} 
?>



<!DOCTYPE html>
<html>
<title>Hi Lycoris</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/test.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/font.css">
<style>
  body {
  height: 1350px;
  }
</style>
<div class="w3-container w3-lightblue w3-text-black">
  <div class="w3-display-topleft">
  <img src ="imej/logo.png">
  </div>
  <center>
  <h1 id="message"style="font-family: Audiowide, sans-serif;">Welcome to LycoShop Seller Centre</h1>
  <p style="font-family: Audiowide, sans-serif;">Add your product to our platform now!</p>
</center>
<div class="w3-dropdown-hover w3-display-topright w3-lightblue">
  <button id="SignOut" class="w3-bar-item w3-button2 "style="font-family: Comfortaa, sans-serif;">Hi, <?php echo $namapenjual;?></button>
  <div class="w3-dropdown-content w3-bar-block w3-card-4 ">
      <a href="logout.php" class="w3-bar-item w3-button3">SignOut</a>
    </div>
    </div>
  </div>
</div>

<div class="card2-container" style="margin-top: 10px;">
<div class="card2">
    <div class="card2-header">
      <h2 style="font-family: Comfortaa, sans-serif;position: absolute; top: 130px;">Add a product</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" id="namaproduk" name="namaproduk" required></td>
        </tr>
        <tr>
            <td>Price (RM)</td>
            <td><input type="number" min="0" max="999999" step="0.01" id="harga" name="harga" required></td>
        </tr> 
        <tr>  
        <td>Categories</td>
        <td>
        <select id="list-picker" name="category">
        <option value="Sports & Lifestyle">Sports & Lifestyle</option>
        <option value="Electronic Accessories">Electronic Accessories</option>
        <option value="Electronic Devices">Electronic Devices</option>
        <option value="Home Appliances">Home Appliances</option>
        </select></td>  
        </tr>
            <td>Conditions</td>
        <td>
        <select id="list-picker" name="conditions">
        <option value="New">New</option>
        <option value="Used">Used</option>
        </tr>
        <tr>
            <td>Product Link</td>
            <td><input type="text" name="link"></td>
        </tr>
        <tr>
            <td>Description</td>
        <td>
        <textarea class="textbox" id="keterangan" name="keterangan" placeholder="Recommended: 60 words" required></textarea></td>
        </tr>
        <tr>
        <td>Image</td>
        <td><form>
        <input type="file" id="gambar" name="gambar" required>
        <img id="preview" src="#" alt="Preview">
        </form>
        <script>
        document.querySelector("#gambar").addEventListener("change", function() {
        var preview = document.querySelector("#preview");
        var file = this.files[0];
        var reader = new FileReader();
        reader.addEventListener("load", function() {
        var image = new Image();
        image.src = reader.result;
        image.onload = function() {
        var width = this.width;
        var height = this.height;
        var maxSize = 400;
        if (width > height) {
          if (width > maxSize) {
            height *= maxSize / width;
            width = maxSize;
          }
        } else {
        if (height > maxSize) {
          width *= maxSize / height;
          height = maxSize;
          }
        }
          preview.width = width;
          preview.height = height;
          preview.src = reader.result;
          preview.style.display = "block";
        };
        }, false);

        if (file) {
          reader.readAsDataURL(file);
        }
        });
        </script></td>
        </tr>
        </table>
        <button class="round" type="submit" name="submit">Add Product</button>
        <button class="round" type="button" onclick ="window.location='edit_product.php'">Edit Product</button>
        <button class="round" type="button" onclick ="window.location='penjual_home.php'">Cancel</button>
        </form>
    </div>
  </div>
</div>
  