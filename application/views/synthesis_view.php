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
#synthesis{
    width: 600px;
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
.user{
	float:left;
	width: 80px;
	height: 50px;
	border:1px solid #666666;
	margin: 10px;	
}
</style>
</head>
 
<body>
	<div id="header"></div>
	
	<div id="content" class="container">
		<div id="synthesis">
			<h1>Synthesis</h1>
			<div id="user_list">
			<?php if( is_array($users) ) {
					foreach( $users as $id => $username ) {?>
						<div class="user"><?=$username?></div>
			<?php 	} 
				} ?>								
			</div>
		</div>
	<br/>

</div>
<div id="footer" class="container">
<hr />
</div>
</body>
</html>