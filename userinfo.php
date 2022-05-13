<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
		body {
			font: 14px sans-serif;
			padding: 20px;
		}
		table { border: black 1px solid; border-radius: 5px; margin-bottom: 50px;}
		td { border: black 1px solid ; padding: 0.5em; }
		th { background: lightgray; border: black 1px solid ; padding: 0.5em; }
    </style>
</head>
<body>
    <h1 class="my-5">My Account</h1>
    <table>
		<tr>
			<th>Title</th>
			<th>Value</th>
		</tr>
		<tr>
			<td><b>First Name</b></td>
			<td><?php echo $_SESSION["first_name"]; ?></td>
		</tr>
		<tr>
			<td><b>Last Name</b></td>
			<td><?php echo $_SESSION["last_name"]; ?></td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td><?php echo $_SESSION["email"]; ?></td>
		</tr>
		<tr>
			<td><b>Profile Picture</b></td>
			<td>
				<?php
					if (!empty($_SESSION["picture"])) {
						echo "<img src='{$_SESSION["picture"]}' alt='{$_SESSION["picture"]}' width='100' height='100'>";
					}
				?>
			</td>
		</tr>
	</table>

	<a href="logout.php" class="btn btn-primary">Logout</a>
</body>
</html>