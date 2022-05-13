<?php

define("DATABASE_FILE", "database/accounts.db");
define("IMAGE_STORAGE", "database/images/");

// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
	header("location: userinfo.php");
	exit;
}

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Check if email is empty
	if (empty(trim($_POST["email"]))) {
		$email_err = "Please enter email.";
	} else {
		$email = trim($_POST["email"]);
	}

	// Check if password is empty
	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter your password.";
	} else {
		$password = trim($_POST["password"]);
	}

	// Validate credentials
	if (empty($email_err) && empty($password_err)) {
		// Prepare a select statement
		$file = file_get_contents(DATABASE_FILE);
		$users = json_decode($file, true);
		$loggedin = false;

		foreach ($users as $user) {
			if (strtolower($user["email"]) == strtolower($email) && password_verify($password, $user["password"])) {

				$loggedin = true;

				session_destroy();

				session_start();

				$_SESSION["loggedin"] = true;
				$_SESSION["email"] = $user["email"];
				$_SESSION["first_name"] = $user["first_name"];
				$_SESSION["last_name"] = $user["last_name"];
				$_SESSION["picture"] = $user["picture"];

				header("location: userinfo.php");

			}
		}
		if (!$loggedin) {
			$login_err = "Invalid email or password.";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			font: 14px sans-serif;
		}

		.wrapper {
			width: 360px;
			padding: 20px;
		}
	</style>
</head>

<body>
	<div class="wrapper">
		<h2>Login</h2>
		<p>Please fill in your credentials to login.</p>

		<?php
		if (!empty($login_err)) {
			echo '<div class="alert alert-danger">' . $login_err . '</div>';
		}
		?>

		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="form-group">
				<label>Email</label>
				<input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
				<span class="invalid-feedback"><?php echo $email_err; ?></span>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
				<span class="invalid-feedback"><?php echo $password_err; ?></span>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Login">
			</div>
			<p>Don't have an account? <a href="signup.php">Register a new one</a>.</p>
		</form>
	</div>
</body>

</html>