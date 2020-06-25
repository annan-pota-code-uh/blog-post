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
	<title> Signup </title>
	<link rel="stylesheet" type="text/css" href="style1.css">
</head>
<body>
	<div class="container container-center" style="width: 400px; height: 530px;">
		<h1> Signup </h1>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<?php
				if(isset($_POST['uname']))
					echo '<input type="text" name="uname" value="'.$_POST['uname'].'" required>';
				else
					echo '<input type="text" name="uname" placeholder="Username" required>';
			?>

			<?php
				if(isset($_POST['dname']))
					echo '<input type="text" name="dname" value="'.$_POST['dname'].'" required>';
				else
					echo '<input type="text" name="dname" placeholder="Display Name" required>';
			?>

			<?php
				if(isset($_POST['phnno']))
					echo '<input type="number" name="phnno" value="'.$_POST['phnno'].'" required>';
				else
					echo '<input type="number" name="phnno" placeholder="Phone Number" required>';
			?>

			<input type="password" name="pwd" placeholder="Password" required>

			<button type="submit"> Signup </button>
			<br>

			<span> Already an user? <a href="login.php"> Login </a></span>
		</form>
	</div>

	<?php

		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$uname = $_POST['uname'];
			$dname = $_POST['dname'];
			$phnno = $_POST['phnno'];
			$pwd = $_POST['pwd'];

			$dbServerName = "localhost";
			$dbUserName = "root";
			$dbPassword = "";
			$dbName = "blogdb";
			$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

			$sql = "SELECT uname FROM users WHERE uname = '$uname';";
			$result = mysqli_query($conn, $sql);

			if(mysqli_num_rows($result) > 0) {
				echo '<script> alert("Username already taken!"); </script>';
			} else {
				$sql = "SELECT * FROM users WHERE phnno = '$phnno';";
				$result = mysqli_query($conn, $sql);

				if(mysqli_num_rows($result) > 0) {
					echo '<script> alert("Phone number is already registered!"); </script>';
				} else {
					
					$sql = "INSERT INTO users(uname, dname, phnno, pwd) VALUES('$uname', '$dname', '$phnno', '$pwd');";
					mysqli_query($conn, $sql);

					$_SESSION['uname'] = $uname;
					$_SESSION['dname'] = $dname;

					header("Location: index.php");
					exit();
				}
			}
		}

	?>

</body>
</html>