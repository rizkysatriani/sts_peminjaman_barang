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

<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "peminjaman_barang");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari database
$sql = "SELECT * FROM pengguna";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>

	<style>
		body {
			background-color: yellow;
		}
	</style>
	
</head>
<body>

<h2>Tabel Pengguna</h2>
<br>

<a class="btn btn-primary" href="tambah3.php" role="button">Tambah Data</a>
<br>
<br>

<table class="table table-dark table-stripped">
  <thead>
    <tr>
	  <th scope="col">No</th>
      <th scope="col">Id Pengguna</th>
	  <th scope="col">Nama Pengguna</th>
	  <th scope="col">Jenis Kel</th>
      <th scope="col">Email</th>
	  <th scope="col">Aksi</th>
    </tr>
  </thead>
  <?php
  // Koneksi ke database
  $koneksi = new mysqli("localhost", "root", "", "peminjaman_barang");

  // Periksa koneksi
  if ($koneksi->connect_error) {
      die("Koneksi gagal: " . $koneksi->connect_error);
  }

  // Query data peminjaman barang
  $sql = "SELECT * FROM pengguna";
  $result = $koneksi->query($sql);

  if ($result->num_rows > 0) {
      $no = 1;
      while($row = $result->fetch_assoc()) {
  ?>
  <tr>
  <th scope="row"><?php echo $no++; ?></th>
    <td><?php echo $row['id']; ?></td>
	<td><?php echo $row['nama_pengguna']; ?></td>
    <td><?php echo $row['jenis_kel']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
	<a href="edit3.php?id=<?= $row['id']; ?>" class="btn btn-primary">Ubah</a> <a href="delete3.php?id=<?= $row['id']; ?>" class="btn btn-primary">Hapus</a>
    </td>
  </tr>
  <?php
      }
  } else {
      echo "";
  }

  // Tutup koneksi
  $koneksi->close();
  ?>
</table>



</body>
</html>