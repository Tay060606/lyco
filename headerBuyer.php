<!DOCTYPE html>
<html>
<title>Hi Lycoris</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style/aborangH.css">
<link rel="stylesheet" href="style/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style/font.css">
<body>
<script src="style/typed.js"></script>

<style>
    .categories{
    transition: 200ms;
    margin-left:-55px!important; 
    border-radius: 20px;
    width: 220px;
    height: 45px;
    border: none;
    background-color: bisque;
  }

  .categories:hover{
    margin-left:-45px !important;
    transition: 200ms;
    background-color: rgb(254, 222, 183);
  }
  .cat {
    transition: margin-right 800ms ease;
    margin-right: -250px;
    height: 400px;
  }

  .cat:hover {
    margin-right: -20px;
  }

    
</style>
<div class="w3-container">
  <div class="w3-display-topleft">
  <img src ="imej/logo.png">
  </div>
  <center>
  <span class="element w3-text-white"style="font-size: 38px; font-family: Audiowide, sans-serif;"id ="message"></span>
  <p class="w3-text-white" style="font-family: Audiowide, sans-serif;">An online shopping web which can assist you in choosing goods</p>
</center>
</div>

<div class="w3-bar w3-custom2 ">
  <a href="pembeli_home.php" class="w3-bar-item w3-button" style="background-color:#DEFCF9!important;">Main Menu</a>
  <a href="order.php" class="w3-bar-item w3-button">My Order</a>
  <a href="cart.php" class="w3-bar-item w3-button">Cart</a>
  <a href="mailto:" class="w3-bar-item w3-button">Chat</a>
  
<?php 
  $nama = $_SESSION["nama"];
?>

  <div class="w3-dropdown-hover w3-right">
    <div class="w3-bar-item w3-button w3-custom4">Hi, <?php echo $nama;?></a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4 ">
      <a href="logout.php" class="w3-bar-item w3-button">SignOut</a>
    </div>
    </div>
  </div>
  
  <div class="w3-dropdown-hover w3-right">
    <div class="w3-bar-item w3-button">About This Website</a>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="daftarpenjual.php" class="w3-bar-item w3-button">Seller Centre</a>
      <a href="creator.php" class="w3-bar-item w3-button">Creator Details</a>
      <a href="thanks.php" class="w3-bar-item w3-button">Special Thanks</a>
      <a href="location.php" class="w3-bar-item w3-button">Location</a>
    </div>
    </div>
  </div>
  <div class="w3-margin-center">
    <form action="search.php" method="post">
      <td><input type="text" name="search" placeholder="Search in LycoShop"></td>
      <button class="search" type="search"name="search">Search</button>
    </form>
  </div>
</div>

<div class="w3-row">
  <div class="w3-quarter w3-container ">
    <div class="w3-container w3-display-right">
    <img class="cat" src="imej/cat.png" alt="Cat Image">
    <audio id="meow-audio" src="style/meow.mp3"></audio>
    <script>
      //meowww
    var catImage = document.querySelector('.cat');
    var meowAudio = document.getElementById('meow-audio');
    catImage.addEventListener('click', function() {
    meowAudio.play();
    });
    </script>
  </div>
  <div class="w3-container w3-display-left">
  
    </div>
    <div class="w3-container" style="margin-top: 170px;display: flex; flex-direction: column;">
    <form action="category.php" method="post">
      <button class="categories" name="category" value="Sports & Lifestyle">Sports & Lifestyle</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Electronic Accessories">Electronic Accessories</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Electronic Devices">Electronic Devices</button>
      <button class="categories" style="margin-top: 10px;" name="category" value="Home Appliances">Home Appliances</button>
      </form>
    </div>
  </div>
  <div class="w3-half w3-container w3-animate-opacity">
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
  
