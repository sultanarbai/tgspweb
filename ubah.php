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
	<h2>
<script type='text/javascript'>
//<![CDATA[

/*
Teks berganti-ganti warna Script by Matt Hedgecoe
Featured on JavaScript Kit, visit http://www.javascriptkit.com/script/script2/rainbowtext.shtml
*/

var text="TERIMA KASIH TELAH MENGUNAKAN SITUS AMATIR INI :)  ;)" //Ganti dengan teks anda
var speed=80 //Kecepatan ganti warna

if (document.all||document.getElementById){
document.write('<span id="highlight">' + text + '</span>')
var storetext=document.getElementById? document.getElementById("highlight") : document.all.highlight
}
else
document.write(text)
var hex=new Array("00","14","28","3C","50","64","78","8C","A0","B4","C8","DC","F0")
var r=1
var g=1
var b=1
var seq=1
function changetext(){
rainbow="#"+hex[r]+hex[g]+hex[b]
storetext.style.color=rainbow
}
function change(){
if (seq==6){
b--
if (b==0)
seq=1
}
if (seq==5){
r++
if (r==12)
seq=6
}
if (seq==4){
g--
if (g==0)
seq=5
}
if (seq==3){
b++
if (b==12)
seq=4
}
if (seq==2){
r--
if (r==0)
seq=3
}
if (seq==1){
g++
if (g==12)
seq=2
}
changetext()
}
function starteffect(){
if (document.all||document.getElementById)
flash=setInterval("change()",speed)
}
starteffect()

//]]>
</script>
</h2>

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