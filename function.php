<?php 
//koneksi ke data base
$conn = mysqli_connect("localhost", "root", "", "phpdasar");





function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
return $rows;
}

 
function tambah($data) {
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);

//uploada gambr
	$gambar = upload();
	if( ! $gambar ) {
		return false;
	}

//ambil tanggal
date_default_timezone_set('Asia/Jakarta');


	$tanggal=date('l, d-m-Y h:i:sa');
    echo $tanggal;

$name_valid = true;
$nim_valid = true;
$email_valid = true;

    	$nama = trim($data['nama']);
		$nim = trim($data['nim']);
		$email = trim($data['email']);

		if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
			$name_valid = false;
			$name_valid_msg = "Hanya huruf dan spasi yang diijinkan.<br>";
				}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  		$email_valid = false;
		      $emailErr = "Invalid email format"; 
		    	}
		elseif (!preg_match("/^[0-9 ]*$/",$nim)) {
			    $nim_valid = false;
			      $nimErr = "Only Numbers allowed"; 
			    }    


if (($name_valid != false) and ($nim_valid != false) and ($email_valid != false) ) {
$query = " INSERT  INTO mahasiswa
			VALUES
			('', '$nama', '$nim', '$email', '$jurusan', '$gambar', '$tanggal')
			";

			mysqli_query($conn, $query);

			return mysqli_affected_rows($conn);
}
}

function upload() {

	$namafile = $_FILES['gambar']['name'];
	$ukuranfile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpname = $_FILES['gambar']['tmp_name'];

	//cek apakah tidak ad gmbr di inputkn
	if ($error === 4 ) {
		echo "<script>
					alert('pilih gambar terlebih dahulu !');</script>";
					return false;
	}
	//cek gambar atau bukan
	$ekstensigambarvalid = ['jpg','jpeg','png'];
	$ekstensigambar = explode('.', $namafile);
	$ekstensigambar = strtolower(end($ekstensigambar));

	if (! in_array($ekstensigambar, $ekstensigambarvalid))
	{
		echo "<script>
					alert('pilih gambar ajja cuyy ');</script>";
					return false;
	}

	//cek jika ukuran terlalu besar
	if ($ukuranfile > 2000000)
	{
		echo "<script>
					alert('ukuran gambar terlalu besar  ');</script>";
					return false;
	}

//lolos siap upload
	//generete nama baru
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .= $ekstensigambar;
	move_uploaded_file($tmpname, 'img/' . $namafilebaru);

	return $namafilebaru;




}


function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}



function ubah($data) {
		global $conn;
		$id = $data["id"];
	$nama = htmlspecialchars($data["nama"]);
	$nim = htmlspecialchars($data["nim"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarlama = htmlspecialchars($data["gambarlama"]); 
	//cek ap pilih gmbr baru
if ($_FILES['gambar']['error'] === 4) {
	$gambar = $gambarlama;
}else {
	$gambar = upload();
}

date_default_timezone_set('Asia/Jakarta');


	$tanggal=date('l, d-m-Y h:i:sa');
    echo $tanggal;

    $name_valid = true;
$nim_valid = true;
$email_valid = true;

    	$nama = trim($data['nama']);
		$nim = trim($data['nim']);
		$email = trim($data['email']);

		if(!preg_match("/^[a-zA-Z ]*$/",$nama)){
			$name_valid = false;
			$name_valid_msg = "Hanya huruf dan spasi yang diijinkan.<br>";
				}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  		$email_valid = false;
		      $emailErr = "Invalid email format"; 
		    	}
		elseif (!preg_match("/^[0-9 ]*$/",$nim)) {
			    $nim_valid = false;
			      $nimErr = "Only Numbers allowed"; 
			    }
if (($name_valid != false) and ($nim_valid != false) and ($email_valid != false) ) {
$query = " UPDATE  mahasiswa SET
				nama = '$nama',
				nim = '$nim',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar',
				tanggal = '$tanggal'
				WHERE id = $id
				";
			

			mysqli_query($conn, $query);

			return mysqli_affected_rows($conn);
}
}


function cari($keyword) {
	$query = "SELECT * FROM mahasiswa WHERE 
	nama LIKE '%$keyword%' OR
	nim LIKE '%$keyword%' OR
	jurusan LIKE '%$keyword%' OR
	email LIKE '%$keyword%'
	

	";

	return query($query);
}

function registrasi($data) {
	global $conn;

	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$level = mysqli_real_escape_string($conn, $data["level"]);

	//cek username dh ad
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if (mysqli_fetch_assoc($result)) {
		echo "<script>
				alert('username sudah terdaftar !')
				</script>";

				return false;
	}

	//cek konfirmasi passwordnya
	if ($password !== $password2) {
		echo "<script>
				alert('konfirmasi password tdk sesuai')
				</script>";
				return false;
	}


//encripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);


	//insert pass
	mysqli_query($conn, "INSERT INTO user VALUES ('', '$username','$password','$level')");

	return mysqli_affected_rows($conn);

}





 ?>
