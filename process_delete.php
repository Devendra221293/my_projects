<?php
echo "in file";

include "db_connection.php";


 if($conn->connect_error){
	 die("connection failed:" .$conn->connect_error);
 }

  $customer_id=$_POST['customer_id'];

  if($customer_id==""){

	//code to insert data
	$sql="DELETE FROM `registered_user` WHERE `customer_id`=$customer_id";
 
  $conn->query($sql);
    	
  header('Locationhttps://github.com/Devendra221293/my_projects/user_list.php');
	 
 }
 ?>
