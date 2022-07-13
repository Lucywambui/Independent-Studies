<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS and JS -->
      <link rel="stylesheet" text="text/css" href="../css/cart.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="cart.js" sync></script>
      <title>Loulou's Treats</title>

  </head>
      
  <body>
    <!-- PHP code that starts off the page -->
    <?php
      //start setting up the connection to the database
      require("../dbinfo.inc");

      //List a bunch of variables to store the contact information of the customer,
      //the variables that store the errors passed and the database sonnection
      $dbh;
      $err;
      $pass;
      $firstname;
      $lastname;
      $address;
      $phoneno;
      $email;
      $result;
      $phoneno_length;


//the post method from the form that store the customer information and the cart information.
      if($_SERVER['REQUEST_METHOD'] == "POST"){
      //add the post variables to the respective variables
       $firstname=$_POST['fname'];
       $lastname=$_POST['lname'];
       $address=$_POST['address'];
       $phoneno=$_POST['pnum'];
       $email=$_POST['eaddress'];

      //the trimmed variables 
       $trimfname=trim($firstname);
       $trimlname=trim($lastname);
       $trimadd=trim($address);
       $trimemail=trim($email);
      
      //if any is emoty the error will be set to the string
       if( (empty($trimfname)) || (empty($trimlname)) || (empty($trimadd)) || (empty($trimemail))) {
          $err="Sorry this cannot be blank";
        }

      //get the length of the phone number entered to check if it's a valid
      //every phone number must have 10 digits
      //if the length of the phone number is not equla to 10 then set the err variable
       $phoneno_length=strlen((string)$phoneno);
       if($phoneno_length != 10){
          $err="Please enter a valid phone number";
       }


      //if the error is not set then enter this try-catch block 
      if(!isset($err)){
      	 try{
       	//set up the database connection 
           $dbh=new PDO("mysql:host=$servername; dbname=$database", $username, $password);
           //put the insert query in a variable
           $insert="insert into Users (first_name, last_name, address, phonenumber, email_address)values (\"$firstname\",\"$lastname\", \"$address\", \"$phoneno\",\"$email\")";
            //execute the insert then set the approriate variable  dependinf on the success
            if($dbh->exec($insert) !== false){
            	  $pass = $firstname. "Your order was created! ";
            	  	  }else{
            	  	  		  $err= "The order failed to create";
            	  	  		  	  }
            	//close the connection of the database  	  		  	  
            $dbh=null;
            //if the database connection fails throw this error 
          }catch(PDOException $e){
            	  	   echo "Connection failed to establish";
            }
        }
     }
     
     //set the variable to trachk the position of the array storing the items in the cart
     $i=0;
     //the post variable thet deals with the variables from the form that passes the items being added to cart
     if($_SERVER['REQUEST_METHOD'] == "POST"){
     	
     	//the item ID from the form gets pulled
     	$itemid=$_POST['itemID'];
     	
     	//set up a connection to the database
     	$dbh=new PDO("mysql:host=$servername; dbname=$database", $username, $password);
     
     	//the query that pulls the elements with the itemID in question is store in the variable below
     	$query="select itemName, itemImage, price  from Items where itemID=$itemid";
     	
     	//check if the variabkle that stores the items in the cart is empty
     	if(!empty($items)){
     		
     		//query the database first to pull a list with the elements related to the item ID 
     		$array=$dbh->query($query);
     		
    //for each element in the list store them in an associative array
    //then store the items in an elements array 
     		foreach($array as $row){
     			$elements=array("name"=>$row['itemName'],"image"=>$row['itemImage'],"price"=>$row['price']);
    //add the elements associative array to an array called items that
    //stores arrays of each of the items' elements added to the cart
    array_push($items,$elements);

     			}
     			//if the array containing the elemets in the cart 
     			}else{
     				//create an array to store the items in the cart
     				$items=array();
     				//run the query and grab items with the same item ID
     				$array=$dbh->query($query);
     				//for each items create an associative array and push that array to the $items array
     				foreach($array as $row){
     					$elements=array("name"=>$row['itemName'],"image"=>$row['itemImage'], "price"=>$row['price']);
    array_push($items,$elements);
   
    
     					}
     				
     					}
     	}
     	//store the number of items in the variable numOfItems
     $numOfItems=sizeof($items);

	  ?>      
	  
	
      <div class="container p-3 my-3">
      
      <!-- The header that contains the web page name and hte navigation bar at the top -->
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
                      <a class="nav-link active" id="cart" href="Cart.php"><img src="../media/cartpic.png" alt="Cart" style="width:55px;height:55px;"></a>
                  </li>
              </ul>
              </div>
          
          </nav>
          </header>
      
          <div class="container">
            <div class="row justify-container-center">
            
            <!-- The cart items side of the page --> 
              <div class="col-sm-6 cart-items">
                  
                <a href="javascript:history.back()" class="back-previous" ><img src="../media/back.png" alt="back button" style="width:35px;height:35px;">Back to previous page</a><br>
                  <!-- Insert the Image here -->
                  
                  
                  
                  <h5 style="padding-top: 10%;">Items in Cart</h5>
		 
		  <?php
		  //the variable used to iterate through the items in the items array
		  $j=0;
		  //loop theough the array depending on the size of the array and output the elements in the array
		 while($j<=$numOfItems){
		  if($items[$j]['name'] != ''){	      
		   echo" <div class='row cart' style='padding: 5%; border-right: 1px solid black;' id='cart-row'>";
		   
		   //the column with the image in that row 
		   echo"<div class='col-5'>";
		   echo"<img src={$items[$j]['image']} alt='Image Name' style='width: 100px;height: 100px;'>";
		   echo"</div>";
		   
		   //the column containing the name and the price of the item
		   echo"<div class='col-7'>";
		   echo"<strong class='title'> {$items[$j]['name']} </strong>";
		   echo"<input type='number' min='1' max='5' id='quantity' placeholder='1' style='width:20%; margin-left:10%' class='item-quantity' value=1 >";
		   echo" <p class='item-price' style='margin-top: 30px;'>£ {$items[$j]['price']} </p><input type='image'  src='../media/delete.png' class='remove-button' style='width: 30px; height: 30px; margin-left:40%;'> ";
		   echo" </div>";

		   echo" </div>";
		  }
		   //move on to the array of next item in the cart 
		   $j++;
		}
		 ?>
		
		    <!-- Total price of all the items should be displayed here -->
		    <p> Total Price</p>
		<p class="total-price" name="total-price" style="margin-top: 20px;">  </p>
	      </div>
	      
                <!-- second row for contact information -->
                <div class="col-sm-6">
             
                <!-- A form with all the contact information is created -->
                  <form action="Cart.php" method="POST">
                    <p style="padding-top: 15%;">Contact Information:</p>
                    <label for="fname" class="cinfo"> First Name: </label><input type="text" name="fname" id="fname"><br>
                    <label for="lname" class="cinfo"> Last Name: </label><input type="text" name="lname" id="lname"><br>
                    <label for="address" class="cinfo"> Address: </label><input type="text" name="address" id="address"><br>
                    <label for="pnum" class="cinfo"> Phone Number: </label><input type="number" name="pnum" maxlength="10" id="pnum"><br>
                    <label for="eaddress" class="cinfo"> Email Address: </label><input type="email" name="eaddress" id="eaddress"><br>
                    <input type="submit" id ="checkout" value=" proceed to checkout"><br>
                    </form>
                </div>
                
              </div>
          </div>

<!-- This contains the footer information at the bottom of the page -->
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
