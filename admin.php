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
<link rel="stylesheet" href="style/product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class = "w3-custom3">
<script src="style/typed.js"></script>

<!-- Header Section -->
<div class="w3-container w3-text-white">
  <div class="w3-display-topleft">
    <img src ="imej/logo.png">
  </div>
  <center>
    <h1 id="message"style="font-family: Audiowide, sans-serif;">Welcome Back, LycoAdmin</h1>
    <p style="font-family: Audiowide, sans-serif;">Lycoris, Admin of Lycoshop</p>
  </center>
</div>

<!-- Navigation Bar -->
<div class="w3-bar w3-custom2 ">
  <a href="admin.php" class="w3-bar-item w3-button"style="background-color:#DEFCF9!important;">All Products</a>
  <a href="import_s.php" class="w3-bar-item w3-button">Import Seller</a>
  <a href="import_p.php" class="w3-bar-item w3-button">Import Product</a>
  <div class="w3-dropdown-hover w3-right">
    <button id="SignOut" class="w3-bar-item w3-button2 "style="font-family: Comfortaa, sans-serif;">Hi Lycoris!</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="logout.php" class="w3-bar-item w3-button">Sign Out</a>
    </div>
  </div>
</div>

<!-- Product Display Section -->
<div class="w3-container ">
<div class="product-container">
<?php
	include("connection.php");
    session_start();
    if($_SESSION["status"]!="admin"){
    header("Location: daftarpenjual.php");
    }
	$sql = "SELECT * FROM verify WHERE productstatus = '0' ORDER BY idverify ASC";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) == 0) {
			echo "<font size=\"5\" style='color:#fff!important'>There are no items pending approve! </font></p>";

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
        echo '<button class="add-to-cart-btn contact-btn" style="font-family: Comfortaa, sans-serif; font-size: 13px;" onclick="window.open(\'' . $row["link"] . '\', \'_blank\')">Product Link</button>';
        echo '      <button class="add-to-cart-btn contact-btn" style="font-family: Comfortaa, sans-serif;font-size:13px;width:85px;" onclick="location.href=\'mailto:'.$sellerEmail.'\'">Contact</button>';
        echo '      <form method="post" action="verify_product.php?id=' . $row["idverify"] . '">';
        echo '        <input type="hidden" name="id" value="' . $row["idverify"] . '">';
        echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="approve" style="font-family: Comfortaa, sans-serif;font-size:13px;width:85px;">Approve</button>';
        echo '        <button class="add-to-cart-btn remove-btn" type="submit" name="deny" style="font-family: Comfortaa, sans-serif;font-size:13px;width:85px;">Deny</button>';
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