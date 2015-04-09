<!DOCTYPE html>
<html lang="en">
<head>
<title>Welcome</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
html, body {height: 100%;}
*{margin: 0px;padding: 0;}
.container{
    width: 1160px;
    margin-left: auto;
    margin-right: auto;
    clear: both;
    }
#header{
    height: 40px;
    background: #658CBF;
    }
#content{
  padding: 10px;min-height:80%;
  } 
.logo{padding: 3px 0px;font-size: 25px;color: #ffffff;}
  a{text-decoration: none; font-weight:bold;}
input{
padding:3px;
color:#333333;
border:1px solid #96A6C5;
margin-top:2px;
width:180px;
font-size:11px;
}
input[type='radio']{
    width:30px;
    }
#register_form input[type='submit']
{
    margin-left: 135px;
}
#register_form{
    width: 400px;
    float: left;
}
#register_form label{
font-weight: bold;
float: left;
width: 135px; 
}
#login_form
{   float: right;
    position: relative;
    margin-top: 8px !important;
    }
.servererror{
    float:left;
    border: 1px solid #FF607D;
    padding: 10px;
}
.error{
    float:right;
    border: 1px solid #FF607D;
    padding: 10px;
}
</style>
</head>
 
<body>
	<div id="header" >
		<div class="container">
		<!--<a class="logo" style="float: left;" href="http://www.tutsmore.com">Tutsmore</a>-->
			<div id="login_form">
			<form action="<?=site_url('user/login')?>" method="post">
				<label for="email">Email or Username</label>
				<input type="text" name="l_email" value="<?=set_value('l_email') ?>" />
				<label for="password">Password</label>
				<input type="password" name="l_pass"/>
				<input type="submit" value="Sign in" name="signin"/>
				<a href="<?=site_url('user/forgotpassword')?>">Forgot Password?</a>				
			</form>
			</div>
		</div>
	</div>
	
	<div id="content" class="container">
		<div id="register_form">
			<h1>Sign Up</h1>
			<form action="<?=site_url('user/do_register')?>" method="post" id="signup_form">
				<label for="username">User Name</label>
				<input type="text" name="username" id="username" value="<?=set_value('username') ?>"/>
				<label for="password">Password</label>
				<input type="password" name="password"/>
				<label for="password">Confirm Password</label>
				<input type="password" name="confirm_password"/>				
				<label for="email">Email</label>
				<input type="text" name="email" value="<?=set_value('email') ?>" />												
				<input type="submit" value="Sign up" name="register"/>
			</form>
			<a href="<?=site_url('synthesis')?>">Go to Synthesis Page</a>
		</div>
	<br />
	<div class="servererror">
		<?php echo validation_errors(); 
			$message = $this->session->flashdata('message');
			echo $message;
		?>
	</div>
</div>
<div id="footer" class="container">
<hr />
</div>
</body>
</html>