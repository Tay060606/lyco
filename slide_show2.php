<div class="w3-content w3-section" >
  <img class="mySlides w3-image w3-animate-opacity" src="imej/1.png" style="width:100%">
  <img class="mySlides w3-image w3-animate-opacity" src="imej/2.png" style="width:100%">
  <img class="mySlides w3-image w3-animate-opacity" src="imej/3.png" style="width:100%">
  <img class="mySlides w3-image w3-animate-opacity" src="imej/4.png" style="width:100%">
</div>

<script>
var myIndex = 0;
lyco();

function lyco() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(lyco, 4500);    
}
</script>