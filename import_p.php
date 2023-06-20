<!DOCTYPE html>
<html>
<title>Admin - Lycoris</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<link rel="stylesheet" href="style/aborangH.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/font.css">
<link rel="stylesheet" href="product.css">
<link rel="stylesheet" href="style/test.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-custom3">
<script src="style/typed.js"></script>

<!-- Header -->
<div class="w3-container w3-text-white">
  <div class="w3-display-topleft">
    <img src="imej/logo.png">
  </div>
  <center>
    <h1 id="message" style="font-family: Audiowide, sans-serif;">Welcome Back, LycoAdmin</h1>
    <p style="font-family: Audiowide, sans-serif;">Lycoris, Admin of Lycoshop</p>
  </center>
</div>

<!-- Navigation bar -->
<div class="w3-bar w3-custom2">
  <a href="admin.php" class="w3-bar-item w3-button">All Products</a>
  <a href="import_s.php" class="w3-bar-item w3-button">Import Seller</a>
  <a href="import_p.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Import Product</a>
  <div class="w3-dropdown-hover w3-right">
    <button id="SignOut" class="w3-bar-item w3-button2" style="font-family: Comfortaa, sans-serif;">Hi Lycoris!</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="logout.php" class="w3-bar-item w3-button">Sign Out</a>
    </div>
  </div>
</div>

<!-- Import Product Card -->
<div class="card3-container" style="margin-top: 35px;">
  <div class="card3" style="">
    <div class="card3-header">
      <?php
      include("connection.php");
      session_start();
      if ($_SESSION["status"] != "admin") {
        header("Location: daftarpenjual.php");
      }
      echo "
        <br><center><h2 bgcolor=black><font face='Comfortaa' color='black'>IMPORT PRODUCT DATA</h2></br>
        <br>
        <!-- Form to select and upload a ZIP file -->
        <form name='form1' id='form1' method='POST' action='import_p.php' enctype='multipart/form-data' style='font-size:18px;'>
          Please select a ZIP file for importing images and CSV files:<br>
          <input style='font-size:14px; width:230px;' type='file' name='zipFile' accept='.zip' required>
          <button style='font-size:14px;' type='submit' name='btn-upload'>Upload</button>
        </form>
      
        <!-- Information about the template for importing product data -->
        <form style='background-color:#DEFCF9!important;
          padding: 10px 22px;
          border-radius: 20px;
          width:43%;'>
          <tr>
            <td style='font-size:18px;'>
              To import product data, please make sure you use the provided template. Download the <a href='uploadp.CSV'>CSV file here.</a>
            </td>
          </tr>
        </form>
      </center>
      </br>";
      
      if (isset($_POST['btn-upload'])) {
        include('connection.php');
        $index = 0;
        $zipFile = $_FILES['zipFile'];
        $zipFileName = $zipFile['name'];
        $zipFileType = pathinfo($zipFileName, PATHINFO_EXTENSION);
        $allowedExtensions = array('png', 'jpg', 'jpeg');
        $allowedExtensions2 = array('csv');
      
        if ($zipFile['size'] > 0 && $zipFileType == 'zip') {
          $tempDir = 'temp/';
          $tempPath = $tempDir . $zipFileName;
          if (move_uploaded_file($zipFile['tmp_name'], $tempPath)) {
            $zip = new ZipArchive;
            if ($zip->open($tempPath) === true) {
              // Extract the zip file to a temporary directory
              $extractDir = 'extracted_images/';
              $zip->extractTo($extractDir);
              $zip->close();
      
              // Iterate through the extracted images and save them to the database
              $imageFiles = glob($extractDir . '*');
              foreach ($imageFiles as $imageFile) {
                $extension = pathinfo($imageFile, PATHINFO_EXTENSION);
                if (in_array($extension, $allowedExtensions)) {
                  $uploaddir = "imej/product/";
                  $uploadfile = $uploaddir . basename($imageFile);
                  if (copy($imageFile, $uploadfile)) {
                    // Insert the image path into the database
                    $_SESSION['gambar'][$index] = basename($imageFile);
                    $index++;
                  } else {
                    echo "<script>alert('Failed to upload image: $imageFile');</script>";
                  }
                } else if (in_array($extension, $allowedExtensions2)) {
                  $uploadedfile = fopen($imageFile, "r");
                }
              }
      
              // Remove the temporary directories
              foreach ($imageFiles as $imageFile) {
                unlink($imageFile);
              }
      
              // Delete the temporary zip file
              unlink($tempPath);
      
              echo "<script>alert('Images extracted and saved successfully.');</script>";
            } else {
              echo "<script>alert('Failed to open the zip file.');</script>";
            }
          } else {
            echo "<script>alert('Failed to upload the zip file.');</script>";
          }
        } else {
          echo "<script>alert('Only zip files are allowed.');</script>";
        }
      
        $counter = 1;
        $indexx = 0;
        while (($getData = fgetcsv($uploadedfile, 10000, ",")) !== FALSE) {
          $query = "SELECT MAX(idproduk) AS max_id FROM produk";
          $result = mysqli_query($con, $query);
          $data = mysqli_fetch_assoc($result);
          $max_id = (int)$data["max_id"];
          $query = "SELECT MAX(idverify) AS max_id FROM verify";
          $result = mysqli_query($con, $query);
          $data = mysqli_fetch_assoc($result);
          $max_id2 = (int)$data["max_id"];
          if ($max_id > $max_id2) {
            $idp = str_pad($max_id + 1, 4, "0", STR_PAD_LEFT);
          } else {
            $idp = str_pad($max_id2 + 1, 4, "0", STR_PAD_LEFT);
          }
          if ($counter > 1) {
            $gambar = $_SESSION['gambar'][$indexx];
            $indexx++;
            $result = mysqli_query($con, "INSERT into produk
            (idproduk,namaproduk,keterangan,gambar,harga,category,conditions,link,idpenjual) 
            values 
            ('$idp','" . $getData[0] . "','" . $getData[1] . "','$gambar','" . $getData[2] . "','" . $getData[3] . "','" . $getData[4] . "','" . $getData[5] . "','" . $getData[6] . "')
            ");
            echo "<script>alert('Data imported!'); window.location.href = 'import_p.php';</script>";
          }
          $counter++;
        }
        fclose($uploadedfile);
      }
      
      $folderPath = 'extracted_images/';
      if (is_dir($folderPath)) {
        array_map('unlink', glob($folderPath . '*'));
        rmdir($folderPath);
      }
      unset($_SESSION['gambar']);
      ?>

    </div>
  </div>
</div>
</div>
</html>
