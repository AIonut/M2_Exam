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
.error{
    float:left;
    border: 1px solid #FF607D;
    padding: 10px;
}
</style>
</head>
 
<body>
	<div id="header"></div>
<?php
$auth_token = $this->input->get('auth_token', TRUE);

if(isset( $postauth_token )) {
	$auth_token = $postauth_token;
}
//echo $user;
?>
	<div id="content" class="container">
		<div id="register_form">
			<h1>Reset Password</h1>
			<form action="<?=site_url('user/do_resetpassword')?>" method="post">				
				<label for="password">New Password</label>
				<input type="password" name="password"/>
				<label for="password">Confirm Password</label>
				<input type="password" name="confirm_password"/>
				<input type="hidden" name="auth_token" value="<?=$auth_token?>">										
				<input type="submit" value="Submit" name="reset_password"/>
				<a href="<?=site_url('user/login')?>">Login</a>
			</form>
		</div>
	<br/>
	<div class="error">
		<?php
		//echo $this->input->get('auth_token', TRUE);
		echo validation_errors();
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