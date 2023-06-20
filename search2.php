<?php
// Check if the search button is pressed
if(isset($_POST['searchb'])) {
  // Retrieve the search query from the form
  $search = $_POST['search'];
  
  // Connect to the database
  include("connection.php");
  
  // Execute the SELECT query
  $query = "SELECT * FROM produk WHERE namaproduk LIKE '%$search%'";
  $result = mysqli_query($con, $query);
  
  // Check if any rows were returned
  if(mysqli_num_rows($result) > 0) {
    // Display the results in a table
    echo "<table>";
    echo "<tr><th>Nama Produk</th><th>Harga</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>".$row['namaproduk']."</td>
    <td><img width=150 src ='imej/product/".$row['gambar']."'></td>
    <td>".$row['harga']."</td></tr>";
    }
    echo "</table>";

  } 
  else {
    // No results found
    echo "No results found";
  }
  
  // Close the database connection
  mysqli_close($con);
}
?> 

<!DOCTYPE html>
<html>
<title>Hi Lycoris</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<link rel="stylesheet" href="style/aborangH.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/font.css">
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
  <a href="menu.php" class="w3-bar-item w3-button">Main Menu</a>
  <a href="index.php" class="w3-bar-item w3-button">My Order</a>
  <a href="index.php" class="w3-bar-item w3-button">Chat</a>
  <a href="index.php" class="w3-bar-item w3-button">Cart</a>

  <div class="w3-dropdown-hover w3-right">
    <a href="x.php" class="w3-bar-item w3-button">About This Website</a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="daftarpenjual.php" class="w3-bar-item w3-button">Seller Centre</a>
      <a href="z.php" class="w3-bar-item w3-button">Author Details</a>
      <a href="a.php" class="w3-bar-item w3-button">Contact Admin</a>
    </div>
  </div>
  <div class="w3-margin-center">
    <form action="search.php" method="post">
      <td><input type="text" name="search" placeholder="Search in LycoShop"></td>
      <button class="search" type="search"name="searchb">Search</button>
    </form>
  </div>
</div>
  <div class="w3-half w3-container ">

  
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
  
  