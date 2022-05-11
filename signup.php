<?php require("script.php") ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign up</title>
</head>
<body>

	<h1>Sign up page</h1>
	
	<form action="" method="post">
		<h3>Register</h3>

		<label>Enter your user name</label>
		<input type="text" name="user_id" placeholder="username">

		<label>Enter a password</label>
		<input type="password" name="password" placeholder="password">

		<label>Re-enter your password</label>
		<input type="password" name="retype_password" placeholder="re-enter password">

		<label>Enter your email</label>
		<input type="email" name="email" placeholder="abc@mail.com">

		<label>First name</label>
		<input type="text" name="first_name" placeholder="First Name">

		<label>Last name</label>
		<input type="text" name="last_name" placeholder="Last Name">

		<input type="submit" name="submit" value="Sign up">

		<p class="error"><?php echo @$error; ?></p>
		<p class="success"><?php echo @$success; ?></p>
	</form>
	
</body>
</html>