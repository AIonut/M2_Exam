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
	
	<div id="content" class="container">
		<div id="register_form">
			<h1>Forgot Password</h1>
			<form action="<?=site_url('user/do_forget')?>" method="post">				
				<label for="email">Email</label>
				<input type="text" name="email" value="<?=set_value('email') ?>" />												
				<input type="submit" value="Submit" name="forgot_password"/>
				<a href="<?=site_url('user/login')?>">Login</a>
			</form>
		</div>
	<br/>
	<div class="error">
		<?php 
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