<?php 

require 'function.php';
$mahasiswa = query("SELECT * FROM mahasiswa ");


// tommbol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>halaman adnmio</title>
</head>
<body>

	<h1>daftar mahasiswa</h1>

	<a href="tambah.php">tambah data mahasiswa</a>


	<br><br>

	<form action="" method="post">
		
		<input type="text" name="keyword" size="50" autofocus placeholder="masukkan data yg ingin dicari" autocomplete="off">
		<button type="submit" name="cari" >cari!</button>
	</form>
<br>

	<table border="1" cellspacing="0" cellpadding="10">

		<tr>
			<th>no.</th>
			<th>aksi</th>
			<th>gambar</th>
			<th>nama</th>
			<th>nim</th>
			<th>jurusan</th>
			<th>email</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row ) :  ?>
		<tr>
			<td>
				<?php echo $i; ?>
			</td>
			<td>
				<a href="ubah.php?id=<?php echo $row["id"];  ?>">ubah</a> |
				<a href="hapus.php?id=<?php echo $row["id"];  ?>" onclick="return confirm('yakin ingin menghapus');">hapus</a>
			</td>
			<td><img src="img/<?php echo $row["gambar"];  ?>" width ="50"></td>
			<td><?php echo $row["nama"] ?></td>
			<td><?php echo $row["nim"] ?></td>
			<td><?php echo $row["jurusan"] ?></td>
			<td><?php echo $row["email"] ?></td>

		</tr>
		<?php $i++; ?>
	<?php endforeach; ?>
		

	</table>

</body>
</html>