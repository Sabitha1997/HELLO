<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title></title>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
 <link rel="stylesheet" href="styling.css">
 <style>
   .error 
	{
	  color: #FF0000;
	  font-size: 10px;
	}
 </style>
</head>
<body>
	<?php
		$nameErr = $emailErr = $mobileErr = $webErr = $passErr = $rpassErr = $genderErr = $termErr = "";
		$name = $email = $mobile = $web = $pass = $rpass = $gender = $term = "";
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
				//validating the name
			if(empty($_POST["name"]))
			{
				$nameErr="Name is Requiered";
			}
			else
			{
				$name=input_data($_POST["name"]);
				if(!preg_match("/^[a-zA-Z-' ]*$/",$name))
				{
					$nameErr="only alphabets are allowed";
				}
			}
			if(empty($_POST["mail"]))
			{
				$emailErr="Email is requiered";
			}
			else
			{
				$email=input_data($_POST["mail"]);
				if(!preg_match("/^[a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
				{
					$emailErr="Check the email pattern";	
				}
			}
			if (empty($_POST["mbno"]))
			{  
            	$mobileErr = "Mobile no is required";  
    		} 
    		else 
    		{  
            	$mobile= input_data($_POST["mbno"]);  
            	if (!preg_match ("/^[0-9]*$/", $mobile) )// condition for checking the pattern
            	{  
            		$mobileErr = "Only numeric value is allowed.";  
            	}  
        		if (strlen ($mobile) != 10) 
        		{  
            		$mobileErr = "Mobile no must contain 10 digits.";  
            	}  
        	}
        	 //Website validation
    	
			if (empty($_POST["website"])) 
			{  
        		$webErr = "";  
    		} 
    		else
    		{  
            	$web = input_data($_POST["website"]);  
            	//condition for checking the URL
            	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$web))
            	{  
                	$webErr = "Invalid URL";  
            	}      
    		} 
    		if(empty($_POST["pass"]))
			{
				$passErr="Password is requiered";
			}
			else
			{
				$pass=input_data($_POST["pass"]);
				if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pass))
				{
					$passErr="Enter correct password pattern";	
				}

			}
			if(empty($_POST["repass"]))
			{
				$rpassErr="Password is requiered";
			}
			else
			{
				$rpass=input_data($_POST["repass"]);
				// $epass=input_data($_POST["epass"]);
				if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $rpass))
				{
					$rpassErr="Enter correct password pattern";	
				}
			
				if($pass!=$rpass)
				{
					$rpassErr=" Password Mismatch";
				}
			
			}
			if (empty ($_POST["gender"]))
    		{  
            	$genderErr = "Gender is required";  
   			} 
   			else
   			{  
           		$gender = input_data($_POST["gender"]);  
   			} 
   			
   				//validating the aggrement(checkbox)
   			if (!isset($_POST["term"]))
   			{  
            	$termErr = "Accept terms of services before submit.";  
    		} 
    		else 
    		{  
        	    $term = input_data($_POST["term"]);  
    		}  
    	}

	function input_data($data)
	{  
		  $data = trim($data);  
		  $data = stripslashes($data);  
		  $data = htmlspecialchars($data);  
		  return $data;  
	} 
	?>
  	
		<div class="container">
		<!-- <div class="row justify-content-center">
		<div class="col-md-6 text-center mb-5">
			<h2 class="heading-section">Sign Up </h2>
		</div>
		</div>
 -->
		<div class="row justify-content-center">
		<div class="col-md-7 col-lg-5">
			<div class="login-wrap">
		    <h3 class="text-center mb-4">Create Your Account</h3>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="signup-form" method="post">
		      	<div class="form-group mb-3">
		      		<label class="label1" for="name">Full Name</label>
		      		<span class="error">*</span>
		        	<input type="text" name="name" class="form-control" placeholder="John Doe">
		        	<span class="error"><?php echo $nameErr;?></span>
		        </div>
		      		
		      	<div class="form-group mb-3">
		      		<label class="label1" for="email">Email Address</label>
		      		<span class="error">*</span>
		      		<input type="text" name="mail" class="form-control" placeholder="johndoe@gmail.com">
		      		<span class="error"><?php echo $emailErr;?></span>
		      	</div>

		      	<div class="form-group mb-3">
		      		<label class="label1" for="num">Mobile No</label>
		      		<span class="error">*</span>
	           		<input type="text" name="mbno" class="form-control"  placeholder="01234596888" ><br>
	           		<span class="error"><?php echo $mobileErr;?></span>
		        </div>

		         <div class="form-group mb-3">
		      		<label class="label1" for="web">Website</label>
		      		<input type="text" name="website" class="form-control" placeholder="www.google.com">
		      		<span class="error"><?php echo $webErr;?></span>
		      	</div>

	            <div class="form-group mb-3">
	            	<label class="label1" for="password">Password</label>
	            	<span class="error">*</span>
	                <input id="password" name="pass" type="password" class="form-control" placeholder="Password">
	                <span class="error"><?php echo $passErr;?></span>            
	            </div>

	            <div class="form-group mb-3">
	            	<label class="label1" for="password">Re-Password</label>
	            	<span class="error">*</span>
	                <input id="password-confirm" name="repass" type="password" class="form-control" placeholder="Enter Password again">
	                <span class="error"><?php echo $rpassErr;?></span>
	            </div>

	            <div class="form-group mb-3">
		      		<label class="label1" for="sex">Gender</label>
		      		<span class="error">*</span><br>
		      		<center>
		      		<input type="radio"   name="gender" id="g1" >&nbsp&nbsp<span id="m1" >Male</span>&nbsp&nbsp&nbsp&nbsp
		      		<input type="radio"  name="gender" id="g2" >&nbsp&nbsp<span id="m1" >Female</span>
		      		<span class="error"><?php echo $genderErr;?></span>
		         	</center>
		        </div>

		        <div class="form-group mb-3">
		        	<center>
		        	<input type="checkbox" name="term">
		        	<label class="label1" for="agreement">Accept Terms & Condition</label>
		        	<span class="error">*</span>
		        	<span class="error"><?php echo $termErr;?></span>
		        </center>
		    	</div>

	            <div class="form-group">
	            	<input type="submit" name="submit" class="form-control btn btn-primary submit px-3" value="SUBMIT">
	            </div>
	        </form>
	        </div>
		</div>
		</div>
		</div>

<?php  
  	if(isset($_POST["submit"]))
    {  
   		if($nameErr == "" && $emailErr == "" && $mobileErr == "" && $genderErr == "" && $webErr == ""&& $termErr=="" && $passErr=="" && $rpassErr == "") 
   			{  
     			echo '<script> alert("You have sucessfully registered.")</script>';
     			echo "Name: " .$name;  
        		echo "<br>";  
        		echo "Email: " .$email;  
        		echo "<br>";  
        		echo "Mobile No: " .$mobile;  
        		echo "<br>";  
       			echo "Website: " .$web;  
        		echo "<br>";  
        		echo "Gender: " .$gender; 
		    }
   			else
   			{  
        		echo '<script> alert("Form filled is failed! Check It!!!.")</script>';  
   			}  
    }  
?> 
<script type="text/javascript" src="jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="popper/popper.min.js"></script> -->
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>