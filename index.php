<?php

include('include/database_connection.php');
session_start();

$message = '';
$Success_message = '';

if(isset($_SESSION['username']))
{
	header('location:Success.php');
}

if(isset($_POST['register']))
{
	$username = trim($_POST["username"]);
	$firstname=	trim($_POST['firstname']);
	$lastname =	trim($_POST['lastname']);
	$gender   =	trim($_POST['gender']);
	$email	  =	trim($_POST['email']);
	$city     =	trim($_POST['city']);
	$state    =	trim($_POST['state']);
	$password = trim($_POST["password"]);

	$check_query = "
	SELECT * FROM tbl_employee_data 
	WHERE username = :username
	";
	$statement = $connect->prepare($check_query);
	$check_data = array(
		':username'		=>	$username
	);
	if($statement->execute($check_data))
	{
		if($statement->rowCount() > 0)
		{
			$message .= 'Username Already Taken';
		}
		else
		{
			if(empty($username))
			{
				$message .= 'Username is required';
			}
			elseif(empty($firstname))
			{
				$message .= ' Firstname is required';
			}
			elseif(empty($lastname))
			{
				$message .= ' Lastname is required';
			}
			elseif(empty($gender))
			{
				$message .= ' Gender is required';
			}
			elseif(empty($email))
			{
				$message .= ' Email is required';
			}
			elseif(empty($city))
			{
				$message .= ' City is required';
			}
			elseif(empty($state))
			{
				$message .= ' State is required';
			}
			elseif(empty($password))
			{
				$message .= ' Password is required';
			}
			else
			{
				if($password != $_POST["confirm_password"])
				{
					$message .= ' Password not match';
				}
			}
			if($message == '')
			{
				$data = array(
					':username'		=>	$username,
					':firstname'	=>	$firstname,
					':lastname'		=>	$lastname,
					':gender'		=>	$gender,
					':email'		=>	$email,
					':city'			=>	$city,
					':state'		=>	$state,
					':password'		=>	$password
				);
	

				$query = "
				INSERT INTO tbl_employee_data
				(username,firstname,lastname,gender,email,city,state,password) 
				VALUES (:username,:firstname,:lastname,:gender,:email,:city,:state,:password)
				";

				$statement = $connect->prepare($query);

				if($statement->execute($data))
				{
					$Success_message .= 'Registration Completed';
				}
			}
		}
	}
}

?>
<html>  
    <head>  
        <title>Employee Login/Registration System With Source Code</title>  
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>  
    <body>  
        <div class="container">
			<br />
			
			<h3 align="center">Employee Login/Registration System With Source Code</a></h3><br />
			<br />
			<div class="panel panel-default">
  				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form method="post">
					<?php
					if($message!=''){?>
					<script>
						swal({
								title: "Oops!",
								text: "<?php echo $message; ?>",
								icon: "warning",
								button: "Ok!",
							});
					</script>
					<?php
					}elseif($Success_message!=''){
					?>
						<script>
						swal({
								title: "Congrulations!",
								text: "<?php echo $Success_message; ?>",
								icon: "success",
								button: "Ok!",
							});
						</script>
					<?php
					}else{
					?>
						<script>
						swal({
								title: "Please Fill Up The Form!",
								text: "Fill Out The Form",
								icon: "info",
								button: "Continue !",
							});
						</script>
					<?php	
					}
					?>
						<div class="form-group">
							<label>Enter Username</label>
							<input type="text" name="username" class="form-control" />
						</div>
						<div class="form-group">
							<label>Enter Firstname</label>
							<input type="text" name="firstname" class="form-control" />
						</div>
						<div class="form-group">
							<label>Enter Lastname</label>
							<input type="text" name="lastname" class="form-control" />
						</div>
						<div class="form-group">
							<label>Select Gender</label><br>
							<input type="radio" id="male" name="gender" value="male" checked>
							<label for="male">Male</label>
							<input type="radio" id="female" name="gender" value="female">
							<label for="female">Female</label>
							<input type="radio" id="other" name="gender" value="other">
							<label for="other">Other</label>
						</div>
						<div class="form-group">
							<label>Enter Email</label>
							<input type="email" name="email" class="form-control" />
						</div>
						<div class="form-group">
							<label>Select City</label>
							<select name='city' class="form-control">
									<option>Select City</option>
									<option value="Rajkot">Rajkot</option>
									<option value="Ahmedabad">Ahmedabad</option>
									<option value="surat">Surat</option>
							</select>
						</div>
						<div class="form-group">
							<label>Select State</label>
							<select name='state' class="form-control">
									<option>Select State</option>
									<option value="Gujarat">Gujarat</option>
									<option value="AndhraPradesh">Andhra Pradesh</option>
									<option value="Bihar">Bihar</option>
							</select>
						</div>
						<div class="form-group">
							<label>Enter Password</label>
							<input type="password" name="password" id="password" class="form-control" />
						</div>
						<div class="form-group">
							<label>Re-enter Password</label>
							<input type="password" name="confirm_password" id="confirm_password" class="form-control" />
						</div>
						<div class="form-group">
							<button type="submit" name="register" class="btn btn-info">Register <i class="fa fa-sign-in"></i></button>
						</div>
						<div align="center">
							<a href="login.php"><button type="button" name='login' class='btn btn-success'>Login <i class="fa fa-paper-plane"></i></button></a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </body>  
</html>
