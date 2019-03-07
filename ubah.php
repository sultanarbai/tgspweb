<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

//ambil data url
$id = $_GET["id"];


$mhs = query("SELECT * FROM mahasiswa WHERE id = $id")[0];


if (isset($_POST["submit"])) 
{

	//cekk tombol submit
		if ( ubah($_POST) > 0) 
		{
		echo "
	<script>
	alert('data berhasil diubah kan');
	document.location.href = 'index.php';
	</script>
	";
		}
else
	{
	echo "<script>
	alert('gagal diubah kan');
	document.location.href = 'index.php';
	</script>
	";
	}
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title>ubah data</title>
	<link rel="stylesheet" href="stil.css">
</head>
<body>

	<h1>ubah data mahasiswa</h1>

	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php  echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarlama" value="<?php  echo $mhs["gambar"]; ?>">

		<ul>
			<li>
				<label for="nama">nama 	:</label>
				<input type="text" name="nama" id="nama" required value="<?php echo $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="nim">nim 	:</label>
				<input type="text" name="nim" id="nim" required value="<?php echo $mhs["nim"]; ?>">
			</li>
			<li>
				<label for="email">email 	:</label>
				<input type="text" name="email" id="email" required value="<?php echo $mhs["email"]; ?>">
			</li>
			<li>
				<label for="jurusan">jurusan 	:</label>
				<input type="text" name="jurusan" id="jurusan" required value="<?php echo $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="gambar">gambar 	:</label>
				<br>
				<img src="img/<?= $mhs['gambar']; ?>" width="40"><br>
				<input type="file" name="gambar" id="gambar" >
			</li>
			<li>
				<button type="submit" name="submit">ubah </button>
			</li>
		</ul>
		
	</form>

</body>
</html>