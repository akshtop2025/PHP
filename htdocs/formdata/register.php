<?php
	//error_reporting(0);
	require_once 'DBConfigs.php';
    function display($result){
	if($result === 6){
		$display1 ='<div class="alert alert-success">Registered Successfully</div>';	
		return $display1;
	}

	$display ='<div class="alert alert-danger">'.$result.'</div>';
	
	return $display;
	}


	$result = '';
	
	
	if(isset($_POST["submit"])){
		
		$res = $db->createUser($_POST["name"], $_POST["email"], $_POST["password"], $_POST["re-password"], $_POST['token']);
		//print_r($res);

	}	
		
	$token = $_SESSION['token'] = md5(uniqid(mt_rand(),true));

	?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="func.js"></script>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<!--
	<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
		<div class="field">
			<label for="name">Name:</label>
			<input type="text" name="name" value="" />		
		</div>
		<div class="field">
			<label for="email">Email:</label>
			<input type="text" name="email" value="" />		
		</div>
		<div class="field">
			<label for="password">Password:</label>
			<input type="password" name="password" value="" />		
		</div>
		<div class="field">
			<label for="repassword">Re-Password:</label>
			<input type="password" name="re-password" value="" />		
		</div>
		<input type="hidden" name="token" value="<?=$token;?>"/>
		<input type="submit" name="submit" value="submit" />
	</form>-->
<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<!--<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>-->
							<div class="col-xs-6">
								<a href="#" class="active" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12"><!--
								<form id="login-form" action="http://phpoll.com/login/process" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="http://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>
								</form>-->
								<form id="register-form" action="<?=$_SERVER['PHP_SELF'];?>" method="post" role="form" >

							    
								   
								   <?=(isset($res) ? display($res):'' )?>
								
									<div class="form-group">
										*<input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										*<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										*<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										*<input type="password" name="re-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
											<input type="hidden" name="token" value="<?=$token;?>"/>
												<input type="submit" name="submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>