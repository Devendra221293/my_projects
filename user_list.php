<?php
session_start();
if($_SESSION['email']) {
?>
<!DOCTYPE html>
<html>
<title> User List </title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.js"></script>

	<script>
	$(document).ready(function() {
	//get all data of user on load of page
		$.ajax
			({
			  type:"POST",
			  url:"process_search.php",
			  success: function(result)
			  {	  
               		  var data = $.parseJSON(result);
                                          
               		  console.log(data);
                          console.log(data[0].name);
                                      
               		 // alert(data[0].name);
               
               		//code to clean table onload
               		$('#mytable').html("");
						
		        var rows = "";
		        var head ="";
			     
                        //create table head and rows dynamicaly
			head +="<tr><th style='width:25%;'>Customer Name</th><th style='width:30%;'>Address</th><th style='width:25%;'>Email</th><th style='width:15%;'>Contact No</th><th style='width:8%;'>Action</th></tr>";
			     
			$.each(data,function(index){
					  
			     rows +="<tr><td>" + data[index].name +" "+  data[index].last_name + "</td><td>" + data[index].address+ "</td><td>" + data[index].primary_email+ "</td><td>" + data[index].primary_contact+ "</td><td><a href='http://www.corecotechnologies.com/roonak-crm/dashboard.php?customer_id="+ data[index].customer_id +"'><button type='button' id='editbtn' name='Edit' class='editbtn btn btn-primary glyphicon glyphicon-pencil' title='Edit'><span style='display:none;'>Edit</button></a></td></tr>";
						
			});
				
                        //table head append
		       $(head).appendTo("#mytable");
			//data row append
		       $(rows).appendTo("#mytable");
					 
		     } 
                 });
	    });	
</script>
       <table align="center" id="mytable" border="1px" class="table table-bordered table-hover table-responsive">
       
       </table>
    </body>
</html>
