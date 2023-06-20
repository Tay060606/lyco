<!DOCTYPE html>
<html>
<title>Hi Lycoris</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/aborangH.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="style/test.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style/font.css">
<body>
<script src="style/typed.js"></script>

<div class="w3-container w3-text-white">
  <div class="w3-display-topleft">
  <img src ="imej/logo.png">
  </div>
  <center>
  <span class="element"style="font-size: 38px; font-family: Audiowide, sans-serif;"></span>
  <p style="font-family: Audiowide, sans-serif;">An online shopping web which can assist you in choosing goods</p>
</center>
</div>

<div class="w3-bar w3-custom2 ">
  <a href="menu.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Main Menu</a>
  <a href="index.php" class="w3-bar-item w3-button">My Order</a>
  <a href="index.php" class="w3-bar-item w3-button">Cart</a>
  <a href="index.php" class="w3-bar-item w3-button">Chat</a>

  <a href="index.php" class="w3-bar-item w3-button w3-custom4 w3-right">Login</a>
  <div class="w3-dropdown-hover w3-right">
    <div class="w3-bar-item w3-button">About This Website</a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="header_c.php" class="w3-bar-item w3-button">Change Colour </a>
      <a href="daftarpenjual.php" class="w3-bar-item w3-button">Seller Centre</a>
      <a href="creator.php" class="w3-bar-item w3-button">Creator Details</a>
      <a href="thanks.php" class="w3-bar-item w3-button">Special Thanks</a>
      <a href="location.php" class="w3-bar-item w3-button">Location</a>
    </div>
    </div>
  </div>

  <div class="w3-margin-center">
    <form action="search.php" method="post">
      <td><input type="text" name="search" placeholder="Search in LycoShop" style="width: 500px;"></td>
      <button class="search" type="search"name="searchb">Search</button>
    </form>
  </div>
</div>

<a href="daftarmasuk.php">
<div class="card" style="position: absolute; right: 10px; bottom: 120px;">
      <img src="imej/signup.png">
    </a>
</div>

<div class="w3-row w3-margin-top w3-margin-bottom">
  <div class="w3-quarter w3-container">
    <!-- kanan -->
    <div class="w3-container" style="margin-top: 170px;display: flex; flex-direction: column;">
    <form action="category.php" method="post">
      <button class="categories" name="category" value="Sports & Lifestyle">Sports & Lifestyle</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Electronic Accessories">Electronic Accessories</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Electronic Devices">Electronic Devices</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Home Appliances">Home Appliances</button>
      </form>
    </div>
  </div>


  <div class="w3-half w3-container ">
  <style>
  .typed-cursor {
    font-size: 38px;
  }
  .element {
    font-family: Audiowide, sans-serif;
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
  
  