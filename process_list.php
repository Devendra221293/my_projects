<?php

include "db_connection.php";


 if($conn->connect_error){
	 die("connection failed:" .$conn->connect_error);
 }
 
 //create array 	
 $customer_list=array();
	
	
 //query for user list
   if($search_text!="" ){
	
	$sql="SELECT `customer_id`,`user_name`,`name`,`last_name`,`primary_email`,`primary_contact`,`city` FROM `registered_user`";
	   
    	$result = mysqli_query($conn, $sql); 
             
	if (mysqli_num_rows($result) > 0) {
    	
    	while($row = mysqli_fetch_array($result)){
	
	$data=array();
	$customer_id=$row['customer_id'];
	$user_name=$row['user_name'];
	$name=$row['name'];
	$last_name=$row['last_name'];
	$primary_email=$row['primary_email'];
        $primary_contact=$row['primary_contact'];
	$city=$row['city'];
	
	//assign values to array data
		$data['customer_id']	  =     $customer_id;
		$data['$user_name']	  =	$user_name;
		$data['name']		  =	$name;
		$data['last_name']        =	$last_name;
		$data['primary_contact']  =	$primary_contact;
		$data['primary_email']	  =	$primary_email;
		$data['city']	  	  =	$city;
		
	 
		array_push($customer_list,$data);
		//$event_list[] = $data;
	 
	   }//while close
		
		$customer_list1=array();
		$customer_list1=json_encode($customer_list);   
		print_r($customer_list1);
	  }//if close
   }
  
 ?>
