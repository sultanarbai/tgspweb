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
	<style>
		body {
			background : url("img/bek.png");
		}
		a {
			text-decoration: none;
		}
		.log {
			position: absolute;
			top: 1050px;
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
	background-image: url('../images/replay_header_bg.gif');
	overflow: hidden;
}

#header-image {
	width: 428px;
	height: 66px;

	background-image: url('../images/SIKEU_01.gif');
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
	xxbackground-image: url('../images/sia-background.gif');
	background-repeat: repeat-y;
	background-position: left;
}
.caru {
		display: inline;
}
	</style>

</head>
<body>


<?php if($_SESSION["level"] === 'admin') : ?>
	<div id="navigation">
		          <div class="navigation-infobar">
                     </div>
<div class="breadcrumb">
         <ul>
               <li class="home"><a href="?act=main"><strong>Halaman Depan</strong></a>
		
               <li class="home"><a href="?act=daftar_mahasiswa"><strong>Mahasiswa</strong></a>
		
               <li><a href="user_manual.pdf" target="_blank"><strong>Panduan</strong></a>
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

<?php elseif($_SESSION["level"] === 'dosen') : ?>
		<div id="navigation">
		          <div class="navigation-infobar">
                     </div>
<div class="breadcrumb">
         <ul>
               <li class="home"><a href="?act=main"><strong>Halaman Depan</strong></a>
		
               <li class="home"><a href="?act=daftar_mahasiswa"><strong>Mahasiswa</strong></a>
		
               <li><a href="user_manual.pdf" target="_blank"><strong>Panduan</strong></a>
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



	<?php elseif ($_SESSION["level"] === 'mahasiswa') : ?>

			<!--Header-->
      <div id="header">
	  <img src="https://akademik.unsri.ac.id/portal02/images/simak_banner.jpg" alt="" />
      </div>
      <!--Navigation-->
      <div id="navigation">
		          <div class="navigation-infobar">
            Program Studi : SISTEM INFORMASI         </div>
<div class="breadcrumb">
         <ul>
               <li class="home"><a href="https://akademik.unsri.ac.id/portal02/utama.php"><strong>Halaman Depan</strong></a>
               <li><a href="http://222.124.194.99/user_manual.pdf" target="_blank"><strong>Panduan</strong></a>
               <li><a href="https://akademik.unsri.ac.id/portal02/index.php?logout=1"><strong>Logout</strong></a>
         </ul>
</div>      </div>
      <!--End Navigation-->

      <!--Contents-->
      <table id=content class="layout">
         <tr>
            <td align=left valign=top width=185 class="layout" style="height:600px;width:185px;overflow:visible">
               <div id="content">
                  
        <div id="sidebar"> 
          <div class="sidebarContents"> <br />            <table width="180" border="0">
              <tr> 
			                  <td width="33" height="34" valign="top">
								<img src="https://akademik.unsri.ac.id/images/foto_mhs/2018/09031181823009.jpg" alt='' width="75px">
						  </td>
                <td width="147" align="left" valign="top"><font size="2pt" face="Tahoma, Arial, sans-serif" color="#003300">
				  <strong>SULTAN ARBA'I</strong></font><br />
                  <font size="-3" face="Tahoma, Arial, sans-serif" color="#003300">
				  <i>Operation Date:<br /> 
				  06 Maret 2019                  </i>
				  </font>
				  </td>
              </tr>
            </table>
<div class="pageBar"></div>
			            <h3><b>Menu Utama<b></h3>
            <ul>
              <li> <a href="https://akademik.unsri.ac.id/portal02/">&raquo; Halaman Depan</a></li>
              <li> <a href="https://akademik.unsri.ac.id/portal02/module/data_pribadi/edit.php">&raquo; Data Pribadi</a></li>
              <li> <a href="https://akademik.unsri.ac.id/portal02/module/data_akademik/utama.php">&raquo; Data Akademik</a>
			  	  
			  </li>

		
              <li> <a href="https://akademik.unsri.ac.id/portal02/module/suliet/">&raquo; SULIET</a> </li>
              <li> <a href="https://akademik.unsri.ac.id/portal02/module/kkn/">&raquo; Pendaftaran KKN</a> </li>
              <li> <a href="https://akademik.unsri.ac.id/portal02/module/password/update.php">&raquo; Setting Password</a> </li>


            </ul>



            <ul class="level-2">
              <font size="1"><small>Universitas Sriwijaya<br />
              Academic Information System v.2.5 <br /><br />Copyright &copy; 2008 <br > By Fasilkom Unsri</small></font> 
            </ul>
          </div>
          <!-- end of sidebar -->
        </div>
               </div>
            </td>
            <td align=left valign=top class="layout">
               <div id="subcontent"> 
        <div class="subcontent-element"> 
                     
          <div class="subcontent-navigation">Home</div>






	<div align="center">
      <br />

      <h1>SISTEM INFORMASI AKADEMIK</h1>
      <h2>FAKULTAS ILMU KOMPUTER - UNIVERSITAS SRIWIJAYA</h2>
   </div>


   <p> Selamat datang, </p>
   <p>Sistem ini adalah Sistem Informasi Akademik untuk mahasiswa Universitas Sriwijaya yang digunakan untuk mengelola data administrasi akademiknya di Fakultas Fasilkom - Universitas Sriwijaya</p>
		  <div class="listview_common">
		     <a href="module/data_pribadi/edit.php"><img src="https://akademik.unsri.ac.id/portal02/images/icons/pribadi.gif" alt="" />Data Pribadi</a>
		     <a href="module/data_akademik/utama.php"><img src="https://akademik.unsri.ac.id/portal02/images/icons/akademik.jpg" alt="" />Data Akademik</a>
		     <a href="module/password/update.php"><img src="https://akademik.unsri.ac.id/portal02/images/icons/password.jpg" alt="" />Setting Password</a>			
	      </div>




<?php endif; ?>

</body>
</html>