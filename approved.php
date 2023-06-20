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

<div class="w3-container w3-text-black">
  <div class="w3-display-topleft">
    <!-- Link to the home page for sellers -->
    <a href="penjual_home.php">
      <img src="imej/logo.png">
    </a>
  </div>
  <center>
    <h1 id="message" style="font-family: Audiowide, sans-serif;">Welcome to LycoShop Seller Centre</h1>
    <p style="font-family: Audiowide, sans-serif;">Add your product to our platform now!</p>
  </center>
</div>

<div class="w3-bar w3-custom2">
  <a href="edit_product.php" class="w3-bar-item w3-button">Pending</a>
  <!-- Highlight the "Approved" tab -->
  <a href="approved.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Approved</a>
</div>

<div class="w3-container">
  <style>
    .typed-cursor {
      font-size: 38px;
    }
  </style>
  <script>
    let options = {
      strings: ["Welcome to LycoShop"],
      typeSpeed: 60,
      loop: false
    }
    let typed = new Typed(".element", options);
  </script>

  <div class="product-container">
    <?php
    session_start();
    include("connection.php");
    $cart = mysqli_real_escape_string($con, $_SESSION['nokp']);
    $sql = "SELECT v.*
        FROM produk v 
        JOIN penjual p ON p.nokp = v.idpenjual
        WHERE p.nokp = '$_SESSION[nokp]'
        ORDER BY v.idproduk DESC";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result) == 0) {
      // Display a message when no approved products are available
      echo "<font size=\"5\" style='color:#fff!important'>There are no products approved! </font></p>";
    } else {
      while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '  <img src="imej/product/' . $row["gambar"] . '" alt="Product Image">';
        echo '  <h3>' . $row["namaproduk"] . '</h3>';
        echo '  <p>';
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
        echo '    <div class="button-container" >';
        echo '      <form method="post" action="edit.php?id=' . $row["idproduk"] . '">';
        echo '        <input type="hidden" name="idp" value="' . $row["idproduk"] . '">';
        echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="edit" style="font-family: Comfortaa, sans-serif;font-size:13px;">Edit product</button>';
        echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="remove" style="font-family: Comfortaa, sans-serif;font-size:13px;">Remove</button>';
        echo '      </form>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
        echo '<style>';
        echo '.button-container { display: flex; }';
        echo '.contact-btn { margin-right: 10px; }';
        echo '</style>';
      }
    }
    mysqli_close($con);
    ?>
  </div>
</div>
</body>
</html>
