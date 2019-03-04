<?php 
require 'function.php';

if (isset($_POST["register"])) {
	
	if (registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasi ditambahkan')
				</script>";
				header("Location: login.php");
				exit;
				
	}
	else {
		echo mysqli_error($conn);
	}
}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>halaman registrasi</title>
	<style >

	label {
		display: block;

		}

	body{
	margin: 0;
	padding: 0;
	font-family: "Times New Roman", serif;
	background: url(img/logo.png);
	background-size: auto;
}
	h1 {
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
	</style>
	
</head>
<body>
<div class="log">
	<h1>halaman registrasi</h1>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">username :</label>
				<input type="text" name="username" id="username" autocomplete="off" required>
			</li>
			<li>
				<label for="password">password :</label>
				<input type="password" name="password" id="password" required>
			</li>
			<li>
				<label for="password2">konfirmasi password :</label>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<label for="level">level :</label>
				<select name="level" id="level" required>
					<option value="">pilih level</option>
					<option value="admin">admin</option>
					<option value="dosen">dosen</option>
					<option value="mahasiswa">mahasiswa</option>
					
				</select>
			</li>
			<li><img src="chapta.php"> </li>
			<li>: <input type="text" placeholder="masukan kode captcha" name="kode" autocomplete="off" required>
				<span class="error">*</span></li>
			<br>
			<li>
				<button type="submit" name="register" style="background-color: green"> register</button>
			</li>
			
				
 			
		</ul>

		
	</form>
</div>

</body>
</html>