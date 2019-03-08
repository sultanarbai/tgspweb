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
 <?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = $usiaErr = $nimErr = $biografiErr = $jurusanErr = "";
$username = $password = $passErr = $email = $gender = $biografi = $website = $nim = $jurusan = $usia = "";

date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $nameErr = "username is required";
  } else {
    $username = test_input($_POST["username"]);
    // check if username only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_POST["nim"])) {
    $nimErr = "NIM is required";
  } else {
    $nim = test_input($_POST["nim"]);
    if (!preg_match("/^[0-9 ]*$/",$nim)) {
      $nimErr = "Only Numbers allowed"; 
    }
  } 
  if (empty($_POST["password"])) {
    $passErr = "password is required";
  } else {
    $nim = test_input($_POST["password"]);
    if (!preg_match("/^[0-9 ]*$/",$password)) {
      $nimErr = "Only Numbers allowed"; 
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["jurusan"])) {
    $jurusanErr = "Please Select One";
  } else {
    $jurusan = test_input($_POST["jurusan"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["usia"])) {
    $usiaErr = "Age is required";
  } else {
    $usia = test_input($_POST["usia"]);
    if (!preg_match("/^[0-9 ]*$/",$usia)) {
      $usiaErr = "Only Numbers allowed"; 
    }
  }
    
  if (empty($_POST["website"])) {
    $websiteErr = "Website is required";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL"; 
    }
  }

  if (empty($_POST["biografi"])) {
    $biografiErr = "Biografi is required";
  } else {
    $biografi = test_input($_POST["biografi"]);
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
				<span class="error">* <?php echo $nameErr;?></span>
			</li>
			<li>
				<label for="password">password :</label>
				<input type="password" name="password" id="password" required>
				<span class="error">* <?php echo $passErr;?> </span>
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