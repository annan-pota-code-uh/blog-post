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
	<title> Create New Post </title>
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

	<div class="container container-center">
		<h2> Create a Blog </h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<input type="text" name="title" placeholder="Give a suitable title" required><br><br>

			<textarea name="content" rows="13" placeholder="Write your mind" required></textarea><br><br>

			<button type="submit" style="left: 40%"> Post </button>
		</form>
	</div>

	<?php

		if($_SERVER['REQUEST_METHOD'] == "POST") {
			$dbServerName = "localhost";
			$dbUserName = "root";
			$dbPassword = "";
			$dbName = "blogdb";
			$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

			$title = $_POST['title'];
			$content = $_POST['content'];
			$uname = $_SESSION['uname'];
			$dname = $_SESSION['dname'];

			$sql = "INSERT INTO blogs(uname, dname, title, content) VALUES('$uname', '$dname', '$title', '$content');";
			mysqli_query($conn, $sql);

			header("Location: index.php");
			exit();
		}

	?>

</body>
</html>