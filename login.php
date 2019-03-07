<?php 
session_start();
require 'function.php';


//cek cookienyo dulu
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	//ambil dari data base
	$result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
	$row = mysqli_fetch_assoc($result);

	//cek cooki dengan username
	if( $key === hash('sha256', $row['username']) ) {
		$_SESSION['login'] = true;
	}

}

if( isset($_SESSION["login"]) ) {
	if ( isset($_SESSION["level"]) ) {
		header("Location: index.php");
	exit;
	}
}


if ( isset($_POST["login"]) ) {

	$username = $_POST["username"];
	$password = $_POST["password"];
	$level = $_POST["level"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' AND level = '$level'");
	// $result2 = mysql_query($conn, "SELECT ")
	//cek username
	if( mysqli_num_rows($result) === 1 ) {
		
	
		//cek password
		$row = mysqli_fetch_assoc($result);
		if( password_verify($password, $row["password"]) ) {
			//set sesion
			$_SESSION["login"] = true;
			$_SESSION["level"] = $row["level"];
			
			//cek remember nyo
			if ( isset($_POST['remember']) ) {
				//buat cokies nyo
				setcookie('id', $row['id'], time()+120);
				setcookie('key', hash('sha256', $row['username']), time()+120);

			}


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
	background: rgba(0,0,0,.9);
	box-sizing: border-box;
	box-shadow: 0 15px 25px rgba(0,0,0,.9);
	border-radius: 10px;
		}
	input {
		border-radius: 5px;
		background-color: rgba(0,0,0,.0);
		color: green;
	}
	button {
		border-radius: 7px;
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
				<label for="level">level :</label>
				<select name="level" id="level" required>
					<option value="">pilih level</option>
					<option value="admin">admin</option>
					<option value="dosen">dosen</option>

					
				</select>
			</li>
			<li>
				<label for="remember">remember me :</label>
				<input type="checkbox" name="remember" id="remember">
				
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