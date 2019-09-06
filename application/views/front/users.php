<!DOCTYPE html>
<html>
<head>
	<title>403 Forbidden</title>
</head>
<body>
<form method="post" action="<?php echo base_url(); ?>welcome/index">
	<div class="row">
		<label for="username">
			Username:
			<input type="text" name="Email" id="Email">
		</label>
	</div>

	<div class="row">
		<label for="password">
			Password:
			<input type="password" name="Password" id="Password" >
		</label>
	</div>
	<div class="row">
		<button type="submit">Login</button>
	</div>
</form>
</body>
</html>
