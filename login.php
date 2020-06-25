<?php

session_start();

if(isset($_SESSION['uname']) && isset($_SESSION['dname'])) {
	header("Location: index.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Login </title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div class="container container-center" style="width: 350px; height: 400px;">
		<h1> Login </h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<?php
				if(isset($_POST['phnno']))
					echo '<input type="number" name="phnno" value="'.$_POST['phnno'].'" required>';
				else
					echo '<input type="number" name="phnno" placeholder="Phone Number" required>';
			?>

			<input type="password" name="pwd" placeholder="Password" required>

			<button type="submit"> Login </button>
			<br>

			<span> New user? <a href="signup.php"> Signup </a></span>
		</form>
	</div>

	<?php

		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$phnno = $_POST['phnno'];
			$pwd = $_POST['pwd'];

			$dbServerName = "localhost";
			$dbUserName = "root";
			$dbPassword = "";
			$dbName = "blogdb";
			$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

			$sql = "SELECT * FROM users WHERE phnno = '$phnno';";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) != 1) {
				echo '<script> alert("Phone number not found!"); </script>';
			} else {
				$row = mysqli_fetch_assoc($result);

				if($pwd != $row['pwd']) {
					echo '<script> alert("Phone number or password is wrong!"); </script>';
				} else {

					$_SESSION['uname'] = $row['uname'];
					$_SESSION['dname'] = $row['dname'];

					header("Location: index.php");
					exit();
				}
			}
		}

	?>

</body>
</html>