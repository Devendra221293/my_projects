<?php
include "db_connection.php";

 if($conn->connect_error){
	 die("connection failed:" .$conn->connect_error);
 }

  $customer_id      =$_POST['customer_id'];
  
  $user_name        = $_POST['username'];
  $user_name        =addslashes($user_name);
  
  $password         = $_POST['new_password'];
 
  $confirm_password = $_POST['confirm_password'];
  
  $name             = $_POST['name'];
  $name             =addslashes($name);
  
  $last_name        =$_POST['last_name'];
  $last_name        =addslashes($last_name);

  $primary_mail     = $_POST['email'];
  
  $primary_contact  = $_POST['contact_number'];

  $city             = $_POST['city'];
  $city             =addslashes($city);
  
  if($customer_id==""){

	//code to insert data
	$sql_insert="INSERT INTO `registered_user`(`user_name`,`password`,`name`,`last_name`,`primary_email`,`primary_contact`,`city`)values('$user_name','$password','$name','$last_name','$primary_mail','$primary_contact','$city')";
 
        $conn->query($sql_insert);
  
 	}else{
	
	//query to update customer details
	
        $sql_update="UPDATE `registered_user` SET `name`='$name',`name`='$name',`last_name`='$last_name',`primary_contact`='$primary_contact',`primary_email`='$primary_mail',`city`='$city' WHERE customer_id='$customer_id'";
  
        $conn->query($sql_update);
 
        header('Location:https://github.com/Devendra221293/my_projects/register.php');
	 
 }
 ?>
