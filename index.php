<?php

session_start();

if(!isset($_SESSION['uname']) || !isset($_SESSION['dname'])) {
	header("Location: login.php");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> BlogPost </title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

	<ul class="nav">
		<li style="float: left;"><a href="index.php"> BlogPost </a></li>

		<li><a href="logout.php" class="menu"> Logout </a></li>
		<li> <?php echo $_SESSION['dname'] ?> </li>
		<li><a href="create.php" class="menu"> Create+ </a></li>
		<li><a href="index.php" class="menu"> Home </a></li>
	</ul>

	<button class="container-center" style="top: 100px;" onclick="location.href='create.php';"> Create new blog </button>

	<?php

		$dbServerName = "localhost";
		$dbUserName = "root";
		$dbPassword = "";
		$dbName = "blogdb";
		$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

		$sql = "SELECT * FROM blogs ORDER BY id DESC";
		$result = mysqli_query($conn, $sql);

		while ($row = mysqli_fetch_assoc($result)) {
			echo '<div class="container container-center">';
			echo '	<h3> '.$row['dname'].' | '.$row['uname'].' </h3>';
			echo '	<h2> '.$row['title'].' </h2>';
			echo '	<p> &nbsp '.$row['content'].' </p>';
			echo '</div>';
		}

	?>

</body>
</html>