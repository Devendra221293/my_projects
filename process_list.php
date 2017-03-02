<?php

include "db_connection.php";


 if($conn->connect_error){
	 die("connection failed:" .$conn->connect_error);
 }
 
 //create array event_list	
		$customer_list=array();
	
	
   //query for name
   if($search_text!="" ){
	
	 $sql="SELECT `customer_id`,`name`,`last_name`, `address`,`primary_contact`,`primary_email` FROM `registered_user` WHERE name LIKE '%$search_text%' OR last_name LIKE '%$search_text%' OR primary_email LIKE '%$search_text%' OR primary_contact LIKE '%$search_text%'";
           
    	
    	$result = mysqli_query($conn, $sql); 
             if (mysqli_num_rows($result) > 0) {
    	
    	while($row = mysqli_fetch_array($result)){
	
	$data=array();
	$customer_id=$row['customer_id'];
	$name=$row['name'];
	$last_name=$row['last_name'];
	$address=$row['address'];
	$primary_contact=$row['primary_contact'];
	$primary_email=$row['primary_email'];
	
	//assign values to array data
		$data['customer_id']	  =     $customer_id;
		$data['name']		  =	$name;
		$data['last_name']        =	$last_name;
		$data['address']	  =	$address;
		$data['primary_contact']  =	$primary_contact;
		$data['primary_email']	  =	$primary_email;
		
	 
		array_push($customer_list,$data);
		//$event_list[] = $data;
	 
	   }//while close
		
		$customer_list1=array();
		$customer_list1=json_encode($customer_list);   
		print_r($customer_list1);
	  }//if close
   }
  
 ?>
