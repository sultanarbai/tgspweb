<?php 
require 'function.php';

if (isset($_POST["submit"])) {




	//cekk tombol submit
if ( tambah($_POST) > 0) {
echo "
	<script>
	alert('data berhasil ditambah kan');
	document.location.href = 'index.php';
	</script>
	";
}else {
	echo "<script>
	alert('gagal ditambah kan');
	document.location.href = 'index.php';
	</script>
	";
}
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>tambah data</title>
</head>
<body>

	<h1>tambah data mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">

		<ul>
			<li>
				<label for="nama">nama 	:</label>
				<input type="text" name="nama" required id="nama">
			</li>
			<li>
				<label for="gambar">gambar 	:</label>
				<input type="file" name="gambar" required id="gambar">
			</li>
			<li>
				<label for="jurusan">jurusan 	:</label>
				<input type="text" name="jurusan" required id="jurusan">
			</li>
			<li>
				<label for="nim">nim 	:</label>
				<input type="text" name="nim" required id="nim">
			</li>
			<li>
				<label for="email">email 	:</label>
				<input type="text" name="email" required id="email">
			</li>
			<li>
				<button type="submit" name="submit">tambah </button>
			</li>
		</ul>
		
	</form>

</body>
</html>