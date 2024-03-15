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
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "peminjaman_barang";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update record
if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama_peminjam = $_POST['nama_peminjam']; // Assuming you have a field named 'name' to update
	$barang_dipinjam = $_POST['barang_dipinjam'];
	$tanggal_pinjam = $_POST['tanggal_pinjam'];
	$tanggal_kembali = $_POST['tanggal_kembali'];

    // SQL to update record
    $sql = "UPDATE peminjaman SET nama_peminjam='$nama_peminjam', 
	barang_dipinjam='$barang_dipinjam', tanggal_pinjam='$tanggal_pinjam', 
	tanggal_kembali='$tanggal_kembali' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
		echo "<br>";
		echo "<a class='btn btn-primary' href='peminjaman.php'>Kembali</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch record to be updated
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to fetch record
    $sql = "SELECT * FROM peminjaman WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <!-- HTML form to update record -->
		<style>
		body {
			background-color: yellow;
		}
	    </style>
		<h2>Update Data</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		    <div class="container">
		    <h4 style="text-align: center;">Id:</h4>
            <input type="text" class="form-control" style="text-align: center;" name="id" value="<?php echo $row['id']; ?>">
	        </div><br>

			<div class="container">
			<h4 style="text-align: center;">Nama Peminjam:</h4>
            <input type="text" class="form-control" style="text-align: center;" name="nama_peminjam" value="<?php echo $row['nama_peminjam']; ?>">
			</div><br>

			<div class="container">
			<h4 style="text-align: center;">Barang Dipinjam:</h4>
			<input type="text" class="form-control" style="text-align: center;" name="barang_dipinjam" value="<?php echo $row['barang_dipinjam']; ?>">
			</div><br>

			<div class="container">
			<h4 style="text-align: center;">Tanggal Pinjam:</h4>
			<input type="date" class="form-control" style="text-align: center;" name="tanggal_pinjam" value="<?php echo $row['tanggal_pinjam']; ?>">
			</div><br>

			<div class="container">
			<h4 style="text-align: center;">Tanggal Kembali:</h4>
			<input type="date" class="form-control" style="text-align: center;" name="tanggal_kembali" value="<?php echo $row['tanggal_kembali']; ?>">
			</div><br>

            <input type="submit" class="btn btn-primary" name="update" value="Update">
			<a class="btn btn-primary" href="peminjaman.php">Kembali</a>
        </form>
<?php
    } else {
        echo "No record found";
    }
}

// Close connection
$conn->close();
?>
