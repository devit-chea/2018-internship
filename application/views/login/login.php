<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Form</title>
	<!-- icon image -->
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/images/logo.png" type="image/x-icon">
	<!-- style css -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!-- font awesome -->
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<style>

		body {
			background-image: url('<?php echo base_url(); ?>/assets/images/background.jpg');
			/*background-image: url('https://www.wallpaperflare.com/static/459/951/654/laptop-apple-mac-computer-wallpaper.jpg');*/
			/*background-position: center;*/
			background-repeat: no-repeat;
			background-size: cover;
	}
		div.container {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
		}
		form.login {
			box-shadow: 0px 10px 55px -1px rgba(0,0,0,0.7);
			width: 280px;
			height: auto;
			background: rgba(255,255,255,0.6);
			padding: 30px;
			border-radius: 14px;
		}
		/*resolve*/
		div.avatar{
			position: relative;
			margin-top: -80px;
			margin-bottom: 60px;
			width: 150px;
			height: 150px;
			border-radius: 50%;
			padding: 0;
			background: #ffffff;
			margin-left: 50%;
			transform: translate(-50%);
			box-shadow: 0px 2px 5px -1px rgba(0,0,0,1);
		}
		div.avatar img {

			width: 100%;
			height: 100%;
		}
		form.login {
			color: #fff;
			margin:0;
		}
		form.login h1 {
			margin:15px;
			text-align: center;
			color: #000;
		}
		.fa {
			color:#000;
			position: absolute;
			margin: -40px 0 0 2px;
			color: rgba(0,0,0,0.8);
		}
		form.login input[type=text], 
		form.login input[type=password] {
			width: 90%;
			height: 40px;
			padding-left: 35px;
			border-radius: 8px;
			font-size: 15px;
			margin-left: -7px;
		}
		form.login input[type=submit] {
			padding: 0;
			width: 100%;
			height: 40px;
			border-radius: 10px;
			font-weight: 900;
			color: #000;
			font-size: 18px;
			letter-spacing: 1px;
			background: #2980b9;
			border: none;
			color: #fff;
			transition: .5s;
		}

		div.container {
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
		}
		form.login {
			box-shadow: 0px 10px 55px -1px rgba(0,0,0,0.7);
			width: 280px;
			height: auto;
			background: rgba(255,255,255,0.6);
			padding: 30px;
			border-radius: 14px;
		}
		div.avatar{
			position: relative;
			margin-top: -80px;
			margin-bottom: 60px;
			width: 150px;
			height: 150px;
			border-radius: 50%;
			padding: 0;
			background: #ffffff;
			margin-left: 50%;
			transform: translate(-50%);
			box-shadow: 0px 2px 5px -1px rgba(0,0,0,1);
		}
		div.avatar img {

			width: 100%;
			height: 100%;
		}
		form.login {
			color: #fff;
			margin:0;
		}
		form.login h1 {
			margin:15px;
			text-align: center;
			color: #000;
		}
		.fa {
			color:#000;
			position: absolute;
			margin: -40px 0 0 2px;
			color: rgba(0,0,0,0.8);
		}
		form.login input[type=email], 
		form.login input[type=password] {
			width: 90%;
			height: 40px;
			padding-left: 35px;
			border-radius: 8px;
			font-size: 15px;
			margin-left: -7px;
		}
		form.login input[type=submit] {
			padding: 0;
			width: 100%;
			height: 40px;
			border-radius: 10px;
			font-weight: 900;
			color: #000;
			font-size: 18px;
			letter-spacing: 1px;
			background: #2980b9;
			border: none;
			color: #fff;
			transition: .5s;
		}
		form.login input[type=checkbox] {
			width: 16px;
			height: 16px;
			float: left;
			color: #000;
		}
		form.login .forgetpass {
			float: right;
			color: #000;
			text-decoration: none;
			transition: .3s;
		}
		form.login .forgetpass:hover {
			text-decoration: underline;
			text-decoration-color: #2980B9;
			transition: .3s;
			color: rgba(0,0,0,0.7);
		}
		div.container .create {
			color: #000;
			text-align: center;
		}
		div.container .create .register {
			text-decoration: underline;
			color: #d35400;
			transition: .3s;
		}
		div.container .create .register:hover {
			color: #2980B9;
			transition: .3s;
		}
		.form-check-label {
			color: black;
		}
		/*test git*/
		/* requied form login */
		span{
			color: red;
		}
	
    </style>
</head>
<body>
	<div class="container">	
		<form class="login" action="<?php echo base_url();?>Connection/login" method="post">
			<div class="avatar">
				<img src="<?php echo base_url();?>assets/images/logo.png" alt="Avatar"/>
			</div>
			
			<input type="text" name="login" placeholder="UserName" required>
			<i class="fa fa-user fa-2x"></i> <br/> <br/>
			<span class=" text-danger"><?php echo form_error('login'); ?></span>


			<input type="password" name="password" placeholder="Password" required>
			<i class="fa fa-lock fa-2x"></i> <br> <br>
			<span class=" text-danger"><?php echo form_error('password'); ?></span>


			<input type="submit" name="submit" value="Login" >
			<br/> <br/>
			 
		</form>	
		<hr>
	</div>
</body>
</html>
