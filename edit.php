<?php 
session_start();
if($_SESSION["status"]!="penjual"){
    header("Location: daftarpenjual.php");
}
$namapenjual = $_SESSION["namapenjual"];
$idpenjual = $_SESSION["nokp"];
include("connection.php"); 
    if(isset($_POST["idp"])){
        $id = $_POST['idp'];
        $_SESSION['id'] = $id;
        if(isset($_POST["remove"])){
            $sql = "DELETE FROM bandingan WHERE idproduk='$id'";
            mysqli_query($con, $sql);
            $sql = "DELETE FROM produk WHERE idproduk='$id'";
            mysqli_query($con, $sql);
            echo"<script>alert('Removed successfully')</script>";
            echo"<script>window.location='approved.php'</script>"; 
        } else if(isset($_POST["edit"])){
            $query = "SELECT * FROM produk WHERE idproduk = '$id'";
            $result = mysqli_query($con, $query);
            $data = mysqli_fetch_assoc($result);
            $namaproduk = $data["namaproduk"]; 
            $keterangan = $data["keterangan"]; 
            $gambar = $data["gambar"];
            $_SESSION['gambar'] = $data["gambar"];
            $harga = $data["harga"];
            $category = $data["category"];
            $conditions = $data["conditions"];
            $link = $data["link"];
            $idadmin = "000000000000";
            $productstatus = "0";
        } else {
            echo"<script>alert('Error')</script>";
        }
    } else if(isset($_POST["idv"])){
        $id = $_POST['idv'];
        if(isset($_POST["remove"])){
            $sql = "DELETE FROM verify WHERE idverify='$id'";
            mysqli_query($con, $sql);
            echo"<script>alert('Removed successfully')</script>";
            echo"<script>window.location='edit_product.php'</script>"; 
        }
    }

if(isset($_POST["submit"])){ 
    $id = $_SESSION['id'];
    $namaproduk = $_POST["namaproduk"]; 
    $keterangan = $_POST["keterangan"]; 
    $harga = $_POST["harga"];
    $category = $_POST["category"];
    $conditions = $_POST["conditions"];
    $link = $_POST["link"];
    $idadmin = "000000000000";
    $productstatus = "0";
    if (!empty($_FILES["gambar"]["name"])) {
    $gambar = $_FILES["gambar"]["name"];
    $check_query = "SELECT * FROM verify WHERE namaproduk = '$namaproduk'";
    $check_result = mysqli_query($con, $check_query);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows > 0) {
        echo "<script>alert('Product with the same name already e/xists.');</script>";
    } else {
        $stmt = mysqli_prepare($con, "INSERT INTO verify (idverify, namaproduk, keterangan, gambar, harga, category, conditions, link, idpenjual, idadmin, productstatus) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        mysqli_stmt_bind_param($stmt, "sssssssssss", $id, $namaproduk, $keterangan, $gambar, $harga, $category, $conditions, $link, $idpenjual, $idadmin, $productstatus); 
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_affected_rows($stmt); 
        mysqli_stmt_close($stmt); 
        if($result){ 
            $uploaddir = "imej/product/";
            $uploadfile = $uploaddir . basename($_FILES['gambar']['name']);
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadfile)) {
                echo "<script>alert('Product information successfully updated and image uploaded.');</script>";
            } else {
                echo "<script>alert('Product information updated, but failed to upload the image.');</script>";
            }
        } else {
            echo "<script>alert('Failed to update product information.');</script>"; 
        }
        echo "<script>window.location='approved.php'</script>"; 
    }

  } else {
    $check_query = "SELECT * FROM verify WHERE namaproduk = '$namaproduk'";
    $check_result = mysqli_query($con, $check_query);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows > 0) {
        echo "<script>alert('Product with the same name already e/xists.');</script>";
    } else {
        $query = "SELECT * FROM produk WHERE idproduk = '$id'";
        $result = mysqli_query($con, $query);
        $data = mysqli_fetch_assoc($result); 
        $gambar = $data["gambar"];
        $stmt = mysqli_prepare($con, "INSERT INTO verify (idverify, namaproduk, keterangan, gambar, harga, category, conditions, link, idpenjual, idadmin, productstatus) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
        mysqli_stmt_bind_param($stmt, "sssssssssss", $id, $namaproduk, $keterangan, $gambar, $harga, $category, $conditions, $link, $idpenjual, $idadmin, $productstatus); 
        mysqli_stmt_execute($stmt); 
        $result = mysqli_stmt_affected_rows($stmt); 
        mysqli_stmt_close($stmt); 
        if($result){ 
            echo "<script>alert('Product information updated');</script>";
        } else {
            echo "<script>alert('Failed to update product information.');</script>"; 
        }
        echo "<script>window.location='approved.php'</script>"; 
    }
  }
  $sql = "DELETE FROM produk WHERE idproduk='$id'";
  mysqli_query($con, $sql);
} 

?>

<!DOCTYPE html>
<html>
<title>Edit Product</title>
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
      <h2 style="font-family: Comfortaa, sans-serif;position: absolute; top: 130px;">Edit product</h2>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>Product Name</td>
            <td><input type="text" id="namaproduk" name="namaproduk" value="<?php echo $namaproduk; ?>"required></td>
        </tr>
        <tr>
            <td>Price (RM)</td>
            <td><input type="number" min="0" max="999999" step="0.01" id="harga" name="harga" value="<?php echo $harga; ?>" required></td>
        </tr> 
        <tr>  
        <td>Categories</td>
        <td>
        <select id="list-picker" name="category">
            <option value="Sports & Lifestyle" <?php if ($category == "Sports & Lifestyle") echo "selected"; ?>>Sports & Lifestyle</option>
            <option value="Electronic Accessories" <?php if ($category == "Electronic Accessories") echo "selected"; ?>>Electronic Accessories</option>
            <option value="Electronic Devices" <?php if ($category == "Electronic Devices") echo "selected"; ?>>Electronic Devices</option>
            <option value="Home Appliances" <?php if ($category == "Home Appliances") echo "selected"; ?>>Home Appliances</option>
        </select>
        </td>  
        </tr>
        <tr>
        <td>Conditions</td>
        <td>
        <select id="list-picker" name="conditions">
            <option value="New" <?php if ($conditions == "New") echo "selected"; ?>>New</option>
            <option value="Used" <?php if ($conditions == "Used") echo "selected"; ?>>Used</option>
        </select>
        </td>
        </tr>
        <tr>
            <td>Product Link</td>
            <td><input type="text" name="link" value="<?php echo $link; ?>"></td>
        </tr>
        <tr>
            <td>Description</td>
        <td>
        <textarea class="textbox" id="keterangan" name="keterangan" placeholder="Recommended: 60 words" required><?php echo $keterangan; ?></textarea></td>
        </tr>
        <tr>
        <td>New Image</td>
        <td><form>
        <input type="file" id="gambar" name="gambar" onchange="if(!this.value){this.setAttribute('data-text', 'please choose an image');}" data-text="no file chosen">
        <img id="preview" src=# alt="Preview">
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
        <button class="round" type="submit" name="submit">Update</button>
        <button class="round" type="button" onclick ="window.location='approved.php'">Cancel</button>
        </form>
    </div>
  </div>
</div>
  