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
  <a href="pembeli_home.php" class="w3-bar-item w3-button">Main Menu</a>

  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (isset($_SESSION["status"]) && ($_SESSION["status"] == "pembeli")) {
    $nama = $_SESSION['nama'];
    echo ' 
    <div class="w3-dropdown-hover w3-right">
    <div class="w3-bar-item w3-button w3-custom4">Hi, ' . $nama . '</a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4 ">
      <a href="logout.php" class="w3-bar-item w3-button">SignOut</a>
    </div>
    </div>
    </div>';
  } else {
    echo'<a href="index.php" class="w3-bar-item w3-button w3-custom4 w3-right">Login</a>';
  }
  ?>
  <div class="w3-dropdown-hover w3-right">
    <div class="w3-bar-item w3-button" >About This Website</a>
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

<div class="w3-half w3-container ">

<center>
<div class="container-fluid">
    <div class="map-responsive">
        <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1994.2585746158081!2d103.73764233851875!3d1.4633225996307415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31da1358ca6d3a93%3A0x1c037bd9b19fc162!2sLycoShop!5e0!3m2!1sen!2smy!4v1686395169387!5m2!1sen!2smy" width="1500" height="570" frameborder="0" style="border:0; margin-top:10px;" allowfullscreen=""></iframe>
    </div>
</div>
</center>

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
  