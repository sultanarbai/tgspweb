<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'function.php';

if ( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	//cek username
	if( mysqli_num_rows($result) === 1 ) {

		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			//set sesion
			$_SESSION["login"] = true;

			header("Location: index.php");
			exit;
		}
	}

	$error = true;

}

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>halaman login</title>
	<style>
	body{
	margin: 0;
	padding: 0;
	font-family: "Times New Roman", serif;
	background: url(img/logo.png);
	background-size: auto;
}
	h4 {
		color: silver;
	}
		label {
		display: block;
		color: blue;

		}
		.log {
			position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%,-50%);
	width: 400px;
	padding: 40px;
	background: rgba(0,0,0,.8);
	box-sizing: border-box;
	box-shadow: 0 15px 25px rgba(0,0,0,.5);
	border-radius: 10px;
		}
	</style>
</head>
<body >
<div class="log">

	<marque><h1 style="font-style: italic;color: red">wellcome to login page</h1></marque>

	<?php if( isset($error) ) : ?>
		<p style="color: red; font-style: italic;">username / password salah</p>
	<?php endif; ?>	

	<form action="" method="post" >
		<ul>
			<li>
				<label for="username">username :</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">Password :</label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<button type="submit" name="login" style="background-color: blue">login</button>
			</li>
		</ul>
	</form>
	<h4>masuk sebagai pengunjung?. klik tombol di bawah!</h4>
		<a href="home.php"><button style="background-color: yellow">enterasguest</button></a>
		<h4>atau belum daftar? . klik tombol dibawah!</h4><br>
		<a href="registrasi.php"><button style="background-color: salmon">daftar</button></a>
</div>
</body>
</html>