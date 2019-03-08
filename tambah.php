<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

if (isset($_POST["submit"])) {

	if ( tambah($_POST) > 0) {
	echo "<script>
	alert('berhasil');
	document.location.href = 'index.php';
	</script>
	";
	}
	else {
	echo "<script>
	alert('gagal ditambah kan');
	document.location.href = 'index.php';
	</script>
	";
}








	//cekk tombol submit

}
 ?>

 <!DOCTYPE html>
<html>
<head>
	<title>tambah data</title>
	<link href="img/favicon.ico" rel="SHORTCUT ICON" />
	<link rel="stylesheet" href="stil.css">
	<style>
		
		
.blink {
  animation: blink-animation 1s steps(5, start) infinite;
  -webkit-animation: blink-animation 1s steps(5, start) infinite;
}
@keyframes blink-animation {
  to {
    visibility: hidden;
  }
}
@-webkit-keyframes blink-animation {
  to {
    visibility: hidden;
  }
}</style>
</head>
<body>
<font ><marquee direction="right"
style="background: black; color: red;"><b>THIS IS KINGARBAI 14</b></marquee></font>

	<h1 class="blink"><marquee>tambah data mahasiswa</marquee></h1>


	<form action="" method="post" enctype="multipart/form-data">

<div align="center">
		
			
				<label for="nama">nama 	:</label>
				<input type="text" name="nama" required="preg_match('/^[a-zA-Z ]*$/')" id="nama">
				
			
		
				<label for="gambar">gambar 	:</label>
				<input type="file" name="gambar" required id="gambar">
			
			
				<label for="nim">nim 	:</label>
				<input type="text" name="nim" required="preg_match('/^[0-9 ]*$/')" id="nim">
			
			
				<label for="jurusan">jurusan</label>
				<select name="jurusan">
			    <option value="">-Pilih Jurusan-</option>
			     <option value="Sistem Informasi">Sistem Informasi</option>
			     <option value="Sistem Komputer">Sistem Komputer</option>
			     <option value="Teknik Informatika">Teknik Informatika</option>
			 </select>
			
				<label for="email">email 	:</label>
				<input type="text" name="email" id="email" required="filter_var(email, FILTER_VALIDATE_EMAIL)">
			
			<br>
				<button type="submit" name="submit">tambah </button>
			
		
	</form>
</div>
</body>
</html>