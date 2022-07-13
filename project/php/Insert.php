<?php
	require("dbinfo.inc");

	$address;

	if ($_SERVER['REQUEST_METHOD']=="POST"){
			$fname =test_input($_POST['fname']);
			$lname=test_input($_POST['lname']);	
			$address=test_input($_POST['address']);
			$pnum=$_POST['pnum']	;	
			$eaddress=$_POST['eaddress'];

		}
		
		function test_input($info) {
			$info=trim($info);
			$info=stripslashes($info);
			return $info;
		}
	

	
	if(isset($pcode)) {
		try{
			$dbh = new PDO("mysql:host=$servername;dbname=$database", $user, $password);
			echo "Connect successfully\n";
			$myInsert=$dbh->prepare("INSERT INTO Users (first_name, last_name, address, phonenumber, email_address) VALUES (:firstname, :lastname , :delivery_address, :phoneno , :email)");
			$myInsert->bindParam(':firstname', $fname);
			$myInsert->bindParam(':lastname', $lname);
			$myInsert->bindParam(':delivery_address', $address);
			$myInsert->bindParam(':phoneno', $pnum);
			$myInsert->bindParam(':email', $eaddress);
			//$myInsert->bindParam(':price', $price);
			$myInsert->execute();
		}catch(PDOException $e){
			echo "Connection failed: " . $e->getMessage();
		}
	}

			
?>	