<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS and JS -->
      <link rel="stylesheet" text="text/css" href="../css/Bakery.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <title>Loulou's Treats</title>
  </head>
      
     <body>
      
      <div class="container p-3 my-3">
          <header>
              
          <h1 style="text-align: center"> Loulou's treats </h1>
          <!-- Navigation Bar -->

          <nav class="navbar navbar-expand" style="background-color: plum;">
          <div class="container-fluid">
              <ul class="nav nav-tabs" style="align-items:center;">
                  <li class="nav-item">
                      <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="artPage.php">Art Page</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" href="Bakery.php">Bakery</a>
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
          
          <div class="container p-3 my-3">
             
             <!-- Row that contains the search bar and sort button -->
              <div class="row ">
              
              <!-- Column that handles the search-->
                  <div class="col-9">
                
                        
                    <div class="row">
                    <!-- Form that handles the search -->
                    <form action="Bakery.php" method="get">
                        <div class="col-9">
                          <input type="text" class="form-control" placeholder="Search for the baked good of your palette's needs" name="search">
                           </div>      
                           
                        <div class="col-3">
                            <input type="image" class="image" src="../media/search.png" alt="submit" name="search">
                            </div>
                          </form>
                          
                        </div>
                  
                  </div>
                  
                  
                 <!-- Column that handles the sort function -->
                  <div class="col-3">                  
                   <div class="row">
                   <div class="col-10">
                   
                   <!-- Form that handles the sort function and dropdown -->
                   <form action="Bakery.php" method="post" class="dropdownsort">
                   <div class="dropdown">
                   <input type="hidden" class="sorttpye">
                   <button type="button" class="dropdown-toggle"  data-bs-toggle="dropdown" data-bs-auto-close="false">Sort</button>
                   <!-- Dropdown menu; alphabetically and by price -->
                   <ul class="dropdown-menu">
                   <li><label for="alpha"><input type="checkbox" value="alpha" name="alpha" id="alpha">Sort alphabetically</label></li>
                   <li><label for="sprice"><input type="checkbox" name="sprice" value="sprice" id="sprice"> Sort by price</label></li>
                   <input type="submit" value="sort">
                    </ul>
                    </div>		
                    </form>
				
                            </div>
                            
             
           
                  </div>                       
              </div>
        
        <?php 
        //set up the variables to connect to the database 
        require("../dbinfo.inc");
        
        //set up a try-catch if the database connection is successful 
        try{
        	//set up the database connection
        	$dbh= new PDO("mysql:host=$servername;dbname=$database",$username, $password);
        	}catch(PDOException $e){
        		//set the variable with the appropriate error 
        		$err="We caught an error";
        		}
        	
        	//the search variable to store the string typed in the search text bar in the search form
        $search;
        //if its set then query the string through the database
        if(isset($_GET['search'])){
        	$search=$_GET['search'];
        	//the query that will do the search
        	$query="select itemID, itemName, price, itemImage from Items where (itemName like'%".$search."%') and diet_type!=''";
       }else{
       	//if the search variable is not set then the query to load the norma; bakery page is run 
       	$query="select itemID, itemName, price, itemImage  from Items where diet_type != '' ";
        }
     
     //the result set after the query is completed    
      $result=$dbh->query($query);
      $i=1;
      //the array that stores the items in an associative array 
	   $items;
	  
	  //store the items in the array 
	  foreach($result as $row){
	  	foreach($row as $field=>$value){
	  		$items[$i][$field]= $value;
	  		}
	  	$i++;
	  	}
	  	
	  	//the sort done to do it alphabetically 
	  	if(isset($_POST['alpha'])){
	  		echo "We are sorting alphabetically";
	  		uasort($items, function($a, $b){
	  			return strcmp($a['itemName'],$b['itemName']);
	  			});
	  	}
	  	
	  	//the sort done by price 
	  	if(isset($_POST['sprice'])){
	  		echo "We are sorting price";
	  		uasort($items, function($a , $b){
	  			return $a['price'] <=> $b['price'];
	  			});
	  	}
	  	
	  	//store the total number of items in the array 
	  	$numOfItems= sizeof($items);
	  	
	  	//loop through all the items and potray them by row and by column 
	  	 for($j=0;$j<=$numOfItems;$j++){
	      		//The list of baked items
             //first row
              echo"<div class='row'>";
              
              //check if the item name is not empty then print the column in the row 
              if($items[$j]['itemName'] != ''){
              	echo"<div class='col-4'>";
              	echo"<form action='bakedgood.php' method='get'>";
              	echo "<input type='hidden' class='products' value={$items[$j]['itemID']} name='itemID'>";
              	echo"<input type='image'  class='products' src={$items[$j]['itemImage']} class='image' alt='submit'> ";
              	echo"<input type='text' id='bakedgood' class='bakedgood'  value={$items[$j]['itemName']} readonly>";
              	echo"</form>";
					echo"<p> £ {$items[$j]['price']} </p>";
					echo"</div>";
					//go to the next item as you enter the next row , column
					$j++;
					}
					
				//check if the item name is not empty then print the column in the row 	
				if($items[$j]['itemName'] != ''){
					echo"<div class='col-4'>";
					echo"<form action='bakedgood.php' method='get'>";
					echo"<input type='hidden' class='products' value={$items[$j]['itemID']} name='itemID'>";
					echo" <input type='image'  class='products' src={$items[$j]['itemImage']} class='image' alt='submit'>";
					echo"<input type='text' id='bakedgood'  class='bakedgood' value={$items[$j]['itemName']} readonly>";
					echo"</form>";
					echo"<p> £ {$items[$j]['price']} </p>";
					echo"</div>";
					//go to the next item as you enter the next row , column
					$j++;
					}
					  
				//check if the item name is not empty then print the column in the row 	  
				if($items[$j]['itemName'] != ''){
					echo"<div class='col-4'>";
					echo"<form action='bakedgood.php' method='get'>";
					echo"<input type='hidden' class= 'products' value={$items[$j]['itemID']} name='itemID'>";
					echo" <input type='image' class='products' src={$items[$j]['itemImage']} class='image' alt='submit'>";
					echo "<input type='text' id='bakedgood' class='bakedgood' method='get'  value={$items[$j]['itemName']} readonly>";
					echo"</form>";
					echo"<p>£ {$items[$j]['price']}</p";
					echo"</div>";
				}
				
				echo"</div>";
			}
					  
		 ?>
	
         <!-- The footer containing the contact information -->     
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
    
