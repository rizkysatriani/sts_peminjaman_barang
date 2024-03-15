<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
	    <a class="nav-link" href="login.php" style="color: white;">Logout</a>
        <a class="nav-link active" aria-current="page" href="index.php" style="color: white;">Home</a>
        <a class="nav-link" href="peminjaman.php" style="color: white;">Peminjaman</a>
        <a class="nav-link" href="barang.php" style="color: white;">Barang</a>
		<a class="nav-link" href="pengguna.php" style="color: white;">Pengguna</a>
      </div>
    </div>
  </div>
</nav>
<br>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Formulir Peminjaman Barang</title>
</head>
<body>
    <h2>Tambah Data</h2>
	<style>
		body {
			background-color: yellow;
		}
	</style>
    <form action="tambah3.php" method="post">

		<div class="container" style="text-align: center;">
        <label for="id_pengguna" class="form-label">Id:</label><br>
        <input type="text" class="form-control" style="text-align: center;" id="id" name="id" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="nama_pengguna" class="form-label">Nama Pengguna:</label><br>
        <input type="text" id="nama_barang" class="form-control" style="text-align: center;" name="nama_pengguna" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="jenis_kel" class="form-label">Jenis Kel:</label><br>
        <input type="text" id="keadaan_barang" class="form-control" style="text-align: center;" name="jenis_kel" required><br><br>
		</div>

		<div class="container" style="text-align: center;">
		<label for="email" class="form-label">Email:</label><br>
        <input type="text" id="tanggal_kembali" class="form-control" style="text-align: center;" name="email" required><br><br>
		</div>

        <input type="submit" value="Tambah Data" class="btn btn-primary" style="margin-left: 75vh; width: 60vh;">
		<br>
		<br>
		<a class="btn btn-primary" href="pengguna.php" style="margin-left: 75vh; width: 60vh;">Kembali</a>
    </form>

	<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "peminjaman_barang");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Tangani permintaan POST dari formulir peminjaman
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $id = $_POST['id'];
	$nama_pengguna = $_POST['nama_pengguna'];
	$jenis_kel = $_POST['jenis_kel'];
    $email = $_POST['email'];

    // Lakukan sanitasi input untuk mencegah serangan SQL Injection
    $id = mysqli_real_escape_string($koneksi, $id);
	$nama_pengguna = mysqli_real_escape_string($koneksi, $nama_pengguna);
	$jenis_kel = mysqli_real_escape_string($koneksi, $jenis_kel);
    $email = mysqli_real_escape_string($koneksi, $email);

    // Buat query untuk menyimpan data peminjaman ke dalam database
    $query = "INSERT INTO pengguna (id, nama_pengguna, jenis_kel, email) 
              VALUES ('$id', '$nama_pengguna', '$jenis_kel', '$email')";

    // Eksekusi query
    if(mysqli_query($koneksi, $query)) {
        echo "Peminjaman barang berhasil.";
    } else {
        echo "ERROR: Tidak bisa mengeksekusi query: $query. " . mysqli_error($koneksi);
    }
}

// Tutup koneksi
mysqli_close($koneksi);
?>

</body>
</html>
