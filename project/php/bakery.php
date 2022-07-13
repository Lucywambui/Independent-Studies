<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS and JS -->
      <link rel="stylesheet" text="text/css" href="../css/bakedgood.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <title>Loulou's Treats</title>
  </head>
      
     <body>
     <?php 
     	require("dbinfo.inc");

     	
     try{
     	$dbh = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
		echo "Connect successfully\n";
		
     }     
     ?>
      
      <div class="container p-3 my-3">
          <header>
              
          <h1 style="text-align: center"> Loulou's treats </h1>
          <!-- Navigation Bar -->

          <nav class="navbar navbar-expand" style="background-color: plum;">
          <div class="container-fluid">
              <ul class="nav nav-tabs" style="align-items: center;">
                  <li class="nav-item">
                      <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="artPage.html">Art Page</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="Bakery.html">Bakery</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="aboutus.html">About us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="cart" href="Cart.html"><img src="../media/cartpic.png" alt="Cart" style="width:55px; height:55px;"></a>
                  </li>
              </ul>
              </div>
          
          </nav>
          </header>
      
    
            <div class="row">
              <div class="col-7">
                <a href="#" class="back-previous"><img src="../media/back.png" alt="back button" style="width:35px;height:35px;">Back to previous page</a><br>
                  <!-- Insert the Image here -->
                  <img src="../media/bakery.png" alt="Image name" style="margin-top:80px; width: 700px; height:900px;">
                </div>
                
                
                <div class="col-5" style="padding-top: 300px;">
                    <form action="#"><label>Enter delivery date: <input type="date" name="date-to-deliver"></label></form>            
                    <h4 class ="name" style="text-align: center; padding-top: 180px;"> Baked Good Name</h4>
                    <p> A bunch of text enters here!</p><br>
                    <!-- Add to Cart -->
                    <p class="price">££ price<button class="btn" disabled onclick="#">Add to Cart</button></p>
                </div>
              </div>
        
      <footer class="bottom-footer" >
    <div class="container p-3" style="background-color: plum;">
      <h3 class="footer-heading">Contact Information: </h3>
      <ul>
        <li><a href="instagram" >Instagram</a></li>
		<li><a href="" >Facebook</a></li>
		<li><a href="" >TikTok</a></li>
		<li><a href="" >Email Address</a></li>
          </ul>
          </div> 
      </footer>
      </div>
</body>
</html>
    