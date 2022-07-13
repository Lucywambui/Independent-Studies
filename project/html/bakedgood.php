<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS and JS -->
      <link rel="stylesheet" text="text/css" href="../css/bakedgood.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="cart.js" async></script>
      <title>Loulou's Treats</title>
  </head>
      
     <body>
      
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
                      <a class="nav-link" href="artPage.php">Art Page</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="Bakery.php">Bakery</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="aboutus.html">About us</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="cart" href="Cart.php"><img src="../media/cartpic.png" alt="Cart" style="width:55px; height:55px;"></a>
                  </li>
              </ul>
              </div>
          
          </nav>
          </header>

<?php
		//set up the database connection 
	   require("../dbinfo.inc");
	   
	   //create the variable that will hold the database connection
	    $dbh;
	    
	    //set up a try- catch to handle the success of the connection 
	    try{
			//set up the database connection 
	       $dbh= new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	       }catch (PDOException $e){
	       	//set the variable of the error with the appropriate string 
	       $err="We caught an errror";
	       }
	       
	     //get the item ID from the bakery page of the item that has been selected
	    $itemID=$_GET['itemID'];
	    //the query to pick the specific item that has the identified itemID
	    $statement="select itemName, itemImage, price, description from Items where itemID=$itemID";
	    //query and place the result in the result set 
	    $result=$dbh->query($statement);
	    
	    //loop through the result set and display them in a form that will be able 
	    //to post the information to the cart page when the add to cart page button is clicked
	    foreach($result as $row){
	    	echo"<div class='row'>";
	    	
	    	echo"<div class='col-7'>";
	    	echo"<a href='javascript:history.back()' class='back-previous'><img src='../media/back.png' alt='back button' style='width:35px;height:35px;'>Back to previous page</a><br>";
	    	
	    	//the form that handles the post to the add to cart function
	    	echo"<form action='Cart.php' method='POST'>";
	    	echo"<input type='hidden' class='bakedgood' value=$itemID name='itemID'>";
	    	echo"<input type='image' name='img' src=$row[itemImage] alt='image' class='img' style='margin-top:80px; width: 700px; height:900px;'>";
	    	echo"</div>";
	    	
	    	 echo" <div class='col-5' style='padding-top: 300px;'>";
	    	 echo"<p><input type='text' class ='name' name='name' style='text-align: center; padding-top: 180px; font-size: 30px; background:white; font-color: black;border:none;' value=$row[itemName] readonly></p>";
	    	 echo"<p>$row[description] </p><br>";
	    	 echo"<p> £ <input type='text' class='price' name='price' value=$row[price] style='border:hidden;' readonly><input type='submit'  class='addToCart' value='Add to Cart' style='width: 100px;'></p>";
	    	 echo"</form>";
	    	 echo"</div>";
	    	 
	    	 echo"</div>";
	    	 
	    	 }
?>
	
	 

	  
        <!-- Footer with the contact information for the page owner -->
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
    
