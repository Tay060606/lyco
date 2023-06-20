<!DOCTYPE html>
<html>
<title>Edit Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<link rel="stylesheet" href="style/aborangH.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/font.css">
<link rel="stylesheet" href="style/product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-custom3">

<script src="style/typed.js"></script>

<!-- Header -->
<div class="w3-container w3-text-black">
  <div class="w3-display-topleft">
    <a href="penjual_home.php">
      <img src="imej/logo.png">
    </a>
  </div>
  <center>
    <h1 id="message" style="font-family: Audiowide, sans-serif;">Welcome to LycoShop Seller Centre</h1>
    <p style="font-family: Audiowide, sans-serif;">Add your product to our platform now!</p>
  </center>
</div>
<!-- End Header -->

<!-- Navigation bar -->
<div class="w3-bar w3-custom2">
  <a href="edit_product.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Pending</a>
  <a href="approved.php" class="w3-bar-item w3-button">Approved</a>
</div>
<!-- End Navigation bar -->

<div class="w3-container">

<style>
  .typed-cursor {
    font-size: 38px;
  }
</style>

<script>
  // Typed.js initialization
  let options = {
    strings: ["Welcome to LycoShop"],
    typeSpeed: 60,
    loop: false
  }
  let typed = new Typed(".element", options);
</script>

<div class="product-container">
  <?php
  // PHP code starts here
  session_start();
  include("connection.php");

  // Retrieving cart information
  $cart = mysqli_real_escape_string($con, $_SESSION['nokp']);

  // SQL query to fetch product information
  $sql = "SELECT *
        FROM verify 
        WHERE idpenjual = '$_SESSION[nokp]'
        ORDER BY idverify DESC";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) == 0) {
    echo "<font size=\"5\" style='color:#fff!important'>There are no products uploaded! </font></p>";
  } else {
    // Loop through each product and display information
    while ($row = mysqli_fetch_assoc($result)) {
      echo '<div class="product-card">';
      echo '  <img src="imej/product/' . $row["gambar"] . '" alt="Product Image">';
      echo '  <h3>' . $row["namaproduk"] . '</h3>';
      echo '  <p>';
      
      // Truncate description if it exceeds 60 words
      $description = $row["keterangan"];
      if (str_word_count($description) > 60) {
          $words = explode(" ", $description);
          $truncatedDescription = implode(" ", array_slice($words, 0, 60));
          echo $truncatedDescription . '...';
      } else {
          echo $description;
      }
      
      echo '</p>';
      echo '  <div class="price-add-to-cart">';
      echo '    <span class="price">RM' . $row["harga"] . '</span>';
      echo '    <div class="button-container">';
      
      // Display contact button for products with status = 1
      if ($row['productstatus'] == 1) {
        $adminId = $row['idadmin'];
        $emailQuery = "SELECT email FROM lycoadmin WHERE idadmin = '$adminId'";
        $emailResult = mysqli_query($con, $emailQuery);
        $emailRow = mysqli_fetch_assoc($emailResult);
        $adminEmail = $emailRow['email'];
        echo '      <button class="add-to-cart-btn contact-btn" style="font-family: Comfortaa, sans-serif;font-size:13px;" onclick="location.href=\'mailto:' . $adminEmail . '\'">Contact admin</button>';
      }

      // Form for editing and removing products
      echo '      <form method="post" action="editing.php?id=' . $row["idverify"] . '">';
      echo '        <input type="hidden" name="idv" value="' . $row["idverify"] . '">';
      echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="edit" style="font-family: Comfortaa, sans-serif;font-size:13px;width:85px;">Edit</button>';
      echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="remove" style="font-family: Comfortaa, sans-serif;font-size:13px;width:85px;">Remove</button>';
      echo '      </form>';

      echo '    </div>';
      echo '      <p>Status:';

      // Display product status
      if ($row['productstatus'] == 0) {
          echo ' Pending ';
      } else {
          echo ' Denied, Please contact admin for help ';
      }
      echo '      </p>';
      echo '  </div>';
      echo '</div>';

      // Additional CSS styles for button container
      echo '<style>';
      echo '.button-container { display: flex; }';
      echo '.contact-btn { margin-right: 10px; }';
      echo '</style>';
    }
  }
  
  mysqli_close($con);
  ?>
</div>
