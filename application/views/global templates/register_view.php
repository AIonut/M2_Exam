*// Do not delete this comment:
*// THis is the page where a non registered user can sing up: required infromations: email, username, password, confirm password
*// Here is : http://prntscr.com/6xj1sk

<section class="content">
	<div id="content" class="container">
		<div id="register_form">
			<h1>Sign Up</h1>
			<form action="<?=site_url('M0_user/do_register')?>" method="post" id="signup_form">
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
</section>
