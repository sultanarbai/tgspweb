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
	<title>halaman admin</title>
	<link href="img/favicon.ico" rel="SHORTCUT ICON" />
	<link rel="stylesheet" href="stil.css">
	<style>
		body {
			background : url("img/bek.png");
		}
		a {
			text-decoration: none;
		}
		.log {
			position: absolute;
			top: 1100px;
			left: 600px;
			transform: translate(-375px,-600px);
			width: 400px;
			padding: 50px;
			background: rgba(48,70,72,.9);
			box-sizing: border-box;
			box-shadow: 0 20px 30px rgba(8,56,247,.9);
			border-radius: 10px;
			color: silver;
	
		}
		button {
			border-radius: 5px;
			color: #333;
		}
		img {
			border-radius: 9px;
		}


		#header {
	width: auto;
	height: 66px;
	background-color: #1a304d;
	background-image: url('img/simak_banner.jpg');
	overflow: hidden;
}

#header-image {
	width: 428px;
	height: 66px;

	background-color: red;
	background-repeat: no-repeat;
	float: left;
}

#header-filler {
	height: 62px;
	float: right;
}

		#navigation {
	width: auto;
	height: 20px;
	padding-left: 0px;
	padding-bottom: 10px;
	padding-top: 5px;
	background-color: #23840D; /*#001d47;*/
	text-align: left;
	overflow: hidden;
}

#navigation ul {
	padding-right: 0px; 
	padding-left: 0px; 
	padding-bottom: 0px; 
	margin-left: 56px; 
	margin-right: 0px;
	margin-top: 0px;
	margin-bottom: 0px;
	padding-top: 0px;
	overflow: hidden;
}

#navigation li {
	PADDING-RIGHT: 10px; DISPLAY: inline; PADDING-LEFT: 10px; PADDING-BOTTOM: 0px; MARGIN: 0px; PADDING-TOP: 0px;
		overflow: hidden;
}

#navigation a {
	padding-right: 0.5em; 
	padding-left: 0em; 
	font-size: 8pt; 
	font-family: Tahoma, Arial, sans-serif; 
	text-decoration: none;
	color: #ffffff; 
}

#navigation a:hover {
	color: #ccddff; 
	TEXT-DECORATION: underline;
}

.navigation-infobar {
	color: #fff;
	font-size: 7pt; 
	font-family: Tahoma, Arial, sans-serif; 
	font-weight: bold;
	text-transform: uppercase;
	float: right;
	margin: 7px 20px 0px 60px;
	overflow: hidden;
}

#content {
	xwidth: 778px;
	height: 100%;
	background-color: #f8f9f5;
	margin: 0px;
	background-repeat: repeat-y;
	background-position: left;
}
.caru {
		display: inline;
}
input::placeholder {
	color: red;

}
	</style>


</head>
<body>
	<!--Header-->
      <div id="header">
	  <img src="img/simak_banner.jpg" alt="" />
      </div>



<?php if($_SESSION["level"] === 'admin') : ?>
	<div id="navigation">
		          <div class="navigation-infobar">
                     </div>
<div class="breadcrumb">
         <ul>

               	<li class="home"><form action="" method="post" class="caru">
		
		<input style="color: white;" type="text" name="keyword" size="50" autofocus placeholder="masukkan data yg ingin dicari" autocomplete="off">
		<button type="submit" name="cari" >cari!</button>
	</form>
	<li class="home"><a href="logout.php"><button>logout!</button></a><br><br>
		<li class="home">

		 <!--
               <li><a href="?act=kontak"><strong>Kontak Kami</strong></a>
		 -->
         </ul>
</div> 
     </div>
      <!--End Navigation-->
      <div align="center">
      <h2>CONTOH SIMAK SIMAKAN</h2>
      <h2>KINGARBAI14</h2>
      <h1>UNIVERSITAS SRIWIJAYA</h1>
      <h3>Version beta.</h3>
      <h3>Hak Cipta &copy; 2019 <br />Tim SI Universitas Sriwijaya</h3>
	  <hr size="1px" color="#009900">
	  <h1>daftar mahasiswa</h1>
	  <?php if( $halamanaktif > 1) : ?>
	  	<button>
<a href="?halaman=<?php echo $halamanaktif - 1; ?>">&laquo;</a>
</button>
<?php endif; ?>



<?php for( $i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
	<?php if($i == $halamanaktif ) : ?>
		<button>
	<a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
		</button>
	<?php else : ?>
		<button>
			<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
		</button>
	<?php endif; ?>
<?php endfor; ?>



<?php if( $halamanaktif < $jumlahhalaman) : ?>
	<button>
		<a href="?halaman=<?php echo $halamanaktif + 1; ?>">&raquo;</a>
	</button>
	
<?php endif; ?>
<hr size="1px" color="lightblue">
   </div>


	

	<a href="tambah.php"><button>add student</button></a>








<br>

	<table border="1" cellspacing="0" cellpadding="10" class="log">

		<tr>
			<th>no.</th>
			<th>aksi</th>
			<th>gambar</th>
			<th>nama</th>
			<th>nim</th>
			<th>jurusan</th>
			<th>email</th>
			<th><i>last update!</i></th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach ($mahasiswa as $row ) :  ?>
		<tr>
			<td>
				<?php echo $i; ?>
			</td>
			<td>
				<button>
					<a href="ubah.php?id=<?php echo $row["id"];  ?>">ubah</a>
				</button>
				 |
				 <button>
				 	<a href="hapus.php?id=<?php echo $row["id"];  ?>" onclick="return confirm('yakin ingin menghapus');">hapus</a>
				 </button>
				
			</td>
			<td><img src="img/<?php echo $row["gambar"];  ?>" width ="50"></td>
			<td><?php echo $row["nama"] ?></td>
			<td><?php echo $row["nim"] ?></td>
			<td><?php echo $row["jurusan"] ?></td>
			<td><?php echo $row["email"] ?></td>
			<td><?php echo $row["tanggal"] ?></td>

		</tr>
		<?php $i++; ?>
	<?php endforeach; ?>
		

	</table>

<?php elseif($_SESSION["level"] === 'dosen') : ?>
		<div id="navigation">
		          <div class="navigation-infobar">
                     </div>
<div class="breadcrumb">
         <ul>

               	<li class="home"><form action="" method="post" class="caru">
		
		<input type="text" name="keyword" size="50" autofocus placeholder="masukkan data yg ingin dicari" autocomplete="off">
		<button type="submit" name="cari" >cari!</button>
	</form>
	<li class="home"><a href="logout.php"><button>logout!</button></a><br><br>
		<li class="home">

		 <!--
               <li><a href="?act=kontak"><strong>Kontak Kami</strong></a>
		 -->
         </ul>
</div> 
     </div>
      <!--End Navigation-->
      <div align="center">
      <h2>CONTOH SIMAK SIMAKAN</h2>
      <h2>KINGARBAI14</h2>
      <h1>UNIVERSITAS SRIWIJAYA</h1>
      <h3>Version beta.</h3>
      <h3>Hak Cipta &copy; 2019 <br />Tim SI Universitas Sriwijaya</h3>
	  <hr size="1px" color="#009900">
	  <h1>daftar mahasiswa</h1>
	  <?php if( $halamanaktif > 1) : ?>
<a href="?halaman=<?php echo $halamanaktif - 1; ?>">&laquo;</a>
<?php endif; ?>



<?php for( $i = 1; $i <= $jumlahhalaman; $i++ ) : ?>
	<?php if($i == $halamanaktif ) : ?>
		<button>
	<a href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: red;"><?php echo $i; ?></a>
		</button>
	<?php else : ?>
		<button>
			<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
		</button>
	<?php endif; ?>
<?php endfor; ?>



<?php if( $halamanaktif < $jumlahhalaman) : ?>
	<button>
		<a href="?halaman=<?php echo $halamanaktif + 1; ?>">&raquo;</a>
	</button>
	
<?php endif; ?>
<hr size="1px" color="lightblue">
   </div>


	

	<a href="tambah.php"><button>add student</button></a>








<br>

	<table border="1" cellspacing="0" cellpadding="10" class="log">

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
				<button>
					<a href="ubah.php?id=<?php echo $row["id"];  ?>">ubah</a>
				</button>
				 |
				 <button>
				 	<a href="hapus.php?id=<?php echo $row["id"];  ?>" onclick="return confirm('yakin ingin menghapus');">hapus</a>
				 </button>
				
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



	


<?php endif; ?>

</body>
</html>