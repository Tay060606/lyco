<!DOCTYPE html>
<html>
<title>LycoCart</title>
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
<body class = "w3-custom3">
<script src="style/typed.js"></script>

<div class="w3-container w3-text-white">
  <div class="w3-display-topleft">
  <img src ="imej/logo.png">
  </div>
  <center>

  <span class="element"style="font-size: 38px; font-family: Audiowide, sans-serif;"></span>
  <p>An online shopping web which can assist you in choosing goods</p>
</center>
</div>

<div class="w3-bar w3-custom2 ">
    <a href="pembeli_home.php" class="w3-bar-item w3-button">Main Menu</a>
    <a href="order.php" class="w3-bar-item w3-button">My Order</a>
    <a href="cart.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Cart</a>
    <a href="mailto:" class="w3-bar-item w3-button">Chat</a>

  <div class="w3-dropdown-hover w3-right">
    <a href="x.php" class="w3-bar-item w3-button">About This Website</a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="daftarpenjual.php" class="w3-bar-item w3-button">Seller Centre</a>
      <a href="creator.php" class="w3-bar-item w3-button">Author Details</a>
      <a href="thanks.php" class="w3-bar-item w3-button">Special Thanks</a>
      <a href="location.php" class="w3-bar-item w3-button">Location</a>
    </div>
  </div>
  <div class="w3-margin-center">
    <form action="search.php" method="post">
      <td><input type="text" name="search" placeholder="Search in LycoShop"></td>
      <button class="search" type="search"name="searchb">Search</button>
    </form>
  </div>
</div>
  <div class="w3-container ">

  
<style>
  .typed-cursor {
    font-size: 38px;
  }
</style>
  <script>
    let options = {
      strings:["Welcome to LycoShop"],
      typeSpeed:60,
      loop: false
    }
    let typed = new Typed(".element", options);
  </script>
  


<div class="product-container">
<?php
	include("connection.php");
    session_start();
	$cart = mysqli_real_escape_string($con, $_SESSION['nokp']);
	$sql = "SELECT p.*, b.idbandingan
        FROM produk p 
        JOIN bandingan b ON b.idproduk = p.idproduk
        WHERE b.nokp = '$_SESSION[nokp]'
        ORDER BY b.idbandingan ASC";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0) {
			echo "<font size=\"5\" style='color:#fff!important'>There are no items in your cart! </font></p>";

		} else {
      while ($row = mysqli_fetch_assoc($result)) {
        $sellerId = $row['idpenjual'];
    $emailQuery = "SELECT email FROM penjual WHERE nokp = '$sellerId'";
    $emailResult = mysqli_query($con, $emailQuery);
    $emailRow = mysqli_fetch_assoc($emailResult);
    $sellerEmail = $emailRow['email'];
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
        echo '      <button class="add-to-cart-btn contact-btn" style="font-family: Comfortaa, sans-serif;font-size:13px;" onclick="location.href=\''. $row["link"] .'\'">Buy Now</button>';
        echo '      <button class="add-to-cart-btn contact-btn" style="font-family: Comfortaa, sans-serif;font-size:13px;" onclick="location.href=\'mailto:'.$sellerEmail.'\'">Contact Seller</button>';
        echo '      <form method="post" action="removefromcart.php?id=' . $row["idbandingan"] . '">';
        echo '        <input type="hidden" name="id" value="' . $row["idbandingan"] . '">';
        echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="order" style="font-family: Comfortaa, sans-serif;font-size:13px;">Order Placed</button>';
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