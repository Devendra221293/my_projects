<?php
session_start();
if($_SESSION['email']) {
//if sesssion exist then load the page.
?>
<!DOCTYPE html>
<html>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.js"></script>

<script src="https://cdnjs.cloudflare.com/bootstrap/bootstrap.min.js"></script>

<script>
		$(document).ready(function() {
                //hide update button
   		$('#update').hide();
		//$('#cancel').hide();
		$('#update_heading').hide();
			
   //code for initcap
   		
   $('#id_name,#id_middle_name,#id_last_name,#id_address,#id_city').on('keydown', function(event) {
       if (this.selectionStart == 0 && event.keyCode >= 65 && event.keyCode <= 90 && !(event.shiftKey) && !(event.ctrlKey) && !(event.metaKey) && !(event.altKey)) {
	            	var $t = $(this);
	           	event.preventDefault();
	           	var char = String.fromCharCode(event.keyCode);
	           	$t.val(char + $t.val().slice(this.selectionEnd));
	           	this.setSelectionRange(1,1);
	        	}
	    		});
			
	 		//get customer id for edit details
			<?php
			$customer_id=$_GET['customer_id'];
			?>
      
  //here if wants to edit the user,this fill the data into the fields
			
   var customer_id  =<?php  echo json_encode($customer_id);?>;
	
			if(customer_id!=null){
				$('#register_heading').hide();
				$('#update_heading').show();
			
				$('#save').hide();
				$('#update').show();
				//$('#cancel').show();
			
				$.ajax({
					type:"POST", 
	        			url: "process_customer.php",
					data:'customer_id='+customer_id,
					success: function(result){
						
						var data=JSON.parse(result);
					
						$("#id_username").val(data[0]);
						$("#id_name").val(data[3]);
            					$("#id_last_name").val(data[4]);
						$("#id_email").val(data[5]);
            					$("#id_contact").val(data[6]);
						$("#id_city").val(data[7]);
					}
		
				});
			}
	
	
		//when submit  button is clicked  to submit customer info
        		$('#save').click(function()
			{
            				$('#id_customer').val(customer_id);
           				var username         = $('#id_user_name').val();
	          			var new_password     = $('#id_new_password').val();
		        		var confirm_password = $('#id_confirm_password').val();
					var name             = $('#id_name').val();
					var last_name        = $('#id_last_name').val();
					var email            = $('#id_email').val();
					var contact_number   = $('#id_contact').val();
					var city             = $('#id_city').val();
					
					//prevent form if fields are empty
						
					if(name!="" && last_name!="" )
			  		{
				
			//prevent form if fields are empty
		
			var detail='&username='+username+'&new_password='+new_password+'&confirm_password='+confirm_password+'&name='+name+'&last_name='+last_name+'&email='+email+'&contact_number='+contact_number+'&city='+city+;
			
					$.ajax
					({
					type:"POST",
					url:"process_register.php",
					data:detail,
					success: function(result)
					{
						$('#id_user_name').val("");
						$('#id_new_password').val("");
            					$('#id_confirm_password').val("");
            					$('#id_name').val("");
						$('#id_last_name').val("");
						$('#id_email').val("");
						$('#id_contact').val("");
            					$('#id_city').val("");
					
						//show modal
			 			$("#getCodeModal").modal('show');
			 			
			 			//focus on field
			 			 $("#getCodeModal").on('shown.bs.modal', function(){
        						$(this).find('#ok_btn').focus();
    						});
    						
    						//reload on modal close	
			 			$('#getCodeModal').on('hidden.bs.modal', function () {
  						location.reload();
						});
						
			 			
				       }//success close
					        
				});
		 	  }else{
				//do nothing
			     }
        });//click ends here
       
     
       
     	 //update customer data
        		$('#update').click(function()
					{
	
						$('#id_customer').val(customer_id);
            					var user_name      = $('#id_user_name').val();
						var name           = $('#id_name').val();
						var last_name      = $('#id_last_name').val();
						var email          = $('#id_email').val();
						var contact_number = $('#id_contact').val();
						var city           = $('#id_city').val();
					
					
				//prevent form if fields are empty
		  				if(name!="" && last_name!="" )
		  				{
			var detail='&username='+user_name+'&name='+name+'&last_name='+last_name+'&email='+email+'&contact_number='+contact_number+'&city='+city+;
			
						$.ajax
						({
							type:"POST",
							url:"process_register.php",
							data:detail,
							success: function(result)
							{
							   $("#updateModal").modal('show');
							   $("#updateModal").on('shown.bs.modal', function(){
		        				   $(this).find('#ok_btn').focus();
		    					   });
					 		   $('#updateModal').on('hidden.bs.modal', function () {
		  						location.reload();
							   });
								
							}//success close
								
						});//ajax close
								
		 	      		}else{
					//do nothing
			      		}
		  
                               });//click ends here
			
			$('#cancel').click(function()
			{
			     $('#id_user_name').val("");
			     $('#id_new_password').val("");
            		     $('#id_confirm_password').val("");
            		     $('#id_name').val("");
			     $('#id_last_name').val("");
			     $('#id_email').val("");
			     $('#id_contact').val("");
            		     $('#id_city').val("");

			});//click ends here
	
 		      });//ready close
   
     
</script>

<body>
<div class="title-block" id="register_heading">
        <h3 class="title"> Customer Registration</h3> 
</div>

<div class="title-block" id="update_heading" style="display:none;">
         <h3 class="title">Update Information</h3> 
</div>
                            
<form name="register_form" id="register_form"  data-toggle="validator" role="form">

<div class="form-group col-md-6">
           <label for="inputname" class="control-label">Username</label><span class="label"style="Color:red;">*</span>      	
                 <input type="text" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32 || event.charCode == 39 || event.charCode >= 97 && event.charCode <= 122 || event.charCode <= 8' class="form-control crc-textfield"  pattern="^[a-zA-Z ']+$" name="user_name" id="id_user_name"  placeholder="" value="" required>
	   <div class="help-block with-errors"></div>
</div>

<div class="form-group">
          <label for="inputStreet" class="control-label"> Password</label><span class="label"style="Color:red;">*</span>
                 <input type="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,10}" class="form-control" name="new_password" id="id_new_password" placeholder="Minimum 8 characters" value="" data-error="Password must contain 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number and 1 Special Character " required/>
          <div class="help-block with-errors"></div>
</div>   

<div class="form-group">
          <label for="inputStreet" class="control-label">Confirm Password</label><span class="label"style="Color:red;">*</span>
                 <input type="password" class="form-control" name="confirm_password" id="id_confirm_password" placeholder="" value="" required/>
	  <div class="help-block with-errors"></div>
</div>

<div class="form-group col-md-6">
           <label for="inputname" class="control-label">First Name</label><span class="label"style="Color:red;">*</span>      	
                 <input type="text" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32 || event.charCode == 39 || event.charCode >= 97 && event.charCode <= 122 || event.charCode <= 8' class="form-control crc-textfield"  pattern="^[a-zA-Z ']+$" name="n_name" id="id_name"  placeholder="" value="" required>
	   <div class="help-block with-errors"></div>
</div>


<div class="form-group col-md-6">
           <label for="inputsurname" class="control-label">Last Name</label><span class="label"style="Color:red;">*</span>
                   <input type="text" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32 || event.charCode == 39 || event.charCode >= 97 && event.charCode <= 122 || event.charCode <= 8' pattern="^[a-zA-Z ']+$" class="form-control crc-textfield" name="n_last_name" id="id_last_name" placeholder="" value="" required>
	   <div class="help-block with-errors"></div>
</div>

<div class="form-group col-md-6">
           <label for="inputEmail" class="control-label"> Email</label>
                   <input type="email" class="form-control crc-textfield" name="n_email" id="id_email"   placeholder="" value="">
    	   <div class="help-block with-errors"></div>
</div>
                        
                        
<div class="form-group col-md-6">
          <label for="inputphone" class="control-label">Contact Number</label>
                  <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 46 || event.charCode <= 8' pattern="[0-9]*{10}" minlength="10" maxlength="10" class="form-control" name="n_contact" id="id_contact" placeholder="" value="" data-error="Contact Number must be 10 digit. "/>
	  <div class="help-block with-errors"></div>
</div>
                        

<div class="form-group col-md-6">
          <label for="inputCity" class="control-label">Location</label>
                 <input type="text" pattern="^[a-zA-Z ']+$" onkeypress='return event.charCode >= 65 && event.charCode <= 90 || event.charCode == 32 || event.charCode == 39 || event.charCode >= 97 && event.charCode <= 122 || event.charCode <= 8' class="form-control" name="n_city" id="id_city"  placeholder="" value=""><div class="help-block with-errors"></div>
          <div class="help-block with-errors"></div>
</div>


<div class="form-group">
          <input id="save" type="button" value="Save" class="btn btn-primary" style="width:30%; margin-left:2%;"/>
                     			
           <input id="update" type="button" value="Update" class="btn btn-primary"  style="width:30%;  margin-left:2%;"/>
                     			
           <input id="cancel" type="button" value="Reset" class="btn btn-primary"  style="width:30%"/>		
</div>


</form>

<!-- Modal -->
 			<div class="modal" id="getCodeModal" style="margin-top:3%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   			     <div class="modal-dialog modal-md">
      				   <div class="modal-content">
       					 <div class="modal-header">
        				       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         					    <h4 class="modal-title" id="myModalLabel"> Message </h4>
       					  </div>
       					  
       					  <div class="modal-body" id="getCode" style="overflow-x: scroll;">
          						<p>Customer has been register successfully.</p>
      					  </div>
      					  
      					  <div class="modal-footer">
         					<button type="button" id="ok_btn" class="btn btn-primary" data-dismiss="modal">OK</button>
        				  </div>
   					</div>
   			 	     </div>
				  </div>
				     
				     
				 <!-- Modal 2 -->
 			     <div class="modal fade" id="updateModal" style="margin-top:3%;" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   				<div class="modal-dialog modal-md">
      					<div class="modal-content">
       						<div class="modal-header">
        					 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         					 <h4 class="modal-title" id="myModalLabel"> Message </h4>
       						</div>
       						<div class="modal-body" id="getCode" style="overflow-x: scroll;">
          						<p>Customer data has been updated successfully.</p>
      					        </div>
      					        <div class="modal-footer">
         					<button type="button" id="ok_btn" class="btn btn-primary" data-dismiss="modal">OK</button>
        					</div>
   					    </div>
   			 		 </div>
				     </div>
              </body>

</html>
