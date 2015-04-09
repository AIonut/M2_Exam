<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<div>
<a href="<?=site_url('user/logout')?>" style="float: right;">logout</a>
</div>
<div>
<?php echo "Welcome ".$this->session->userdata('username');?>
</div>
<div>
</div>
</body>
</html>