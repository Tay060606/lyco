<!DOCTYPE html>
<html>
<head>
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
</head>
<body class="w3-custom3">

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
  <a href="import_s.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Import Seller</a>
  <a href="import_p.php" class="w3-bar-item w3-button">Import Product</a>
  <div class="w3-dropdown-hover w3-right">
    <button id="SignOut" class="w3-bar-item w3-button2" style="font-family: Comfortaa, sans-serif;">Hi Lycoris!</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="logout.php" class="w3-bar-item w3-button">Sign Out</a>
    </div>
  </div>
</div>

<!-- Import Seller Card -->
<div class="card3-container" style="margin-top: 35px;">
  <div class="card3">
    <div class="card3-header">
      <?php
      include("connection.php");
      session_start();
      if ($_SESSION["status"] != "admin") {
        header("Location: daftarpenjual.php");
      }
      echo "
        <br><center><h2 bgcolor=black><font face='Comfortaa' color='black'>IMPORT SELLER DATA</h2></br>
        <br>
        <!-- Form to select and upload a CSV file -->
        <form name='form1' id='form1' method='POST' action='import_s.php' enctype='multipart/form-data' style='font-size:18px;'>
          Please select a CSV file for importing :<br>
          <input style='font-size:14px; width:230px;' type='file' name='file' accept='.csv' required/>
          <button style='font-size:14px;' type='submit' name='btn-upload'>Upload</button>
        </form>
      
        <!-- Information about the template for importing seller data -->
        <form style='background-color:#DEFCF9!important;
          padding: 10px 22px;
          border-radius: 20px;
          width:45%;'>
          <tr>
            <td style='font-size:18px;'>
              To import seller data, please make sure you use the provided template. Download the <a href='uploads.CSV'>file here</a>.
            </td>
          </tr>
        </form>
      </center>
      ";
      
      if (isset($_POST['btn-upload'])) {
        include('connection.php');
        $tempname = $_FILES["file"]["tmp_name"];
        $filename = $_FILES['file']['name'];
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
      
        if ($_FILES["file"]["size"] > 0 && $filetype == "csv") {
          // Instructions to read the uploaded file
          $uploadedfile = fopen($tempname, "r");
          // Read the uploaded file cell by cell.
          // Each cell is allowed a maximum of 10000 characters. If it exceeds, it will be
          // considered as the next cell.
          $counter = 1;
          while (($getData = fgetcsv($uploadedfile, 10000, ",")) !== FALSE) {
            if ($counter > 1) {
              // Insert data into the database one by one
              $result = mysqli_query($con, "INSERT INTO penjual (nokp, namapenjual, katalaluan, email, seller) VALUES ('" . $getData[0] . "','" . $getData[1] . "','" . $getData[2] . "','" . $getData[3] . "', '1')");
              // Notify the user that the data has been imported
              // and redirect back to the import page
              echo "<script>alert('Data imported!'); window.location.href = 'import_s.php';</script>";
            }
            $counter++;
          } // End of while loop
          fclose($uploadedfile);
        } // End of if file is not empty and is of CSV format
      
        // If the file is not of CSV format, return to the import page
        else
          echo "<script>alert('Only CSV files are allowed');</script>";
      } // End of if isset
      ?>
    </div>
  </div>
</div>
</body>
</html>
