<?php 

session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'function.php';

//pagination
//konfigurasi
$jmldataperhalaman = 5;
$jumlahdata = count(query("SELECT * FROM mahasiswa"));
$jumlahhalaman = ceil($jumlahdata / $jmldataperhalaman);
$halamanaktif = (isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;

$awaldt = ($jmldataperhalaman * $halamanaktif ) - $jmldataperhalaman;


$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldt, $jmldataperhalaman  ");


// tommbol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>halaman adnmio</title>
	<style>
		body {
			background-color: #f0ad4e;
		}
	</style>
</head>
<body>
	<br>
	<a href="logout.php"><button>logout!</button></a><br><br>
	<br><br>

	<h1>daftar mahasiswa</h1>

	<a href="tambah.php">tambah data mahasiswa</a>


	<br><br>


	<form action="" method="post">
		
		<input type="text" name="keyword" size="50" autofocus placeholder="masukkan data yg ingin dicari" autocomplete="off">
		<button type="submit" name="cari" >cari!</button>
	</form>
<br>



<?php if( $halamanaktif > 1) : ?>
<a href="?halaman=<?php echo $halamanaktif - 1; ?>">&laquo;</a>
<?php endif; ?>



<?php for( $i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
	<?php if($i == $halamanaktif ) : ?>
	<a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
	<?php else : ?>
		<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
	<?php endif; ?>
<?php endfor; ?>



<?php if( $halamanaktif < $jumlahhalaman) : ?>
	<a href="?halaman=<?php echo $halamanaktif + 1; ?>">&raquo;</a>
<?php endif; ?>




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