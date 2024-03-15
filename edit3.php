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
    $nama_pengguna = $_POST['nama_pengguna']; // Assuming you have a field named 'name' to update
	$jenis_kel = $_POST['jenis_kel'];
	$email = $_POST['email'];

    // SQL to update record
    $sql = "UPDATE pengguna SET nama_pengguna='$nama_pengguna', 
	jenis_kel='$jenis_kel', email='$email' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
		echo "<br>";
		echo "<a class='btn btn-primary' href='pengguna.php'>Kembali</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch record to be updated
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to fetch record
    $sql = "SELECT * FROM pengguna WHERE id=$id";
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
		    <h4 style="text-align: center;">Nama Pengguna:</h4>
            <input type="text" class="form-control" style="text-align: center;" name="nama_pengguna" value="<?php echo $row['nama_pengguna']; ?>">
	        </div><br>

			<div class="container">
		    <h4 style="text-align: center;">Jenis Kel:</h4>
            <input type="text" class="form-control" style="text-align: center;" name="jenis_kel" value="<?php echo $row['jenis_kel']; ?>">
	        </div><br>

			<div class="container">
		    <h4 style="text-align: center;">Email:</h4>
            <input type="email" class="form-control" style="text-align: center;" name="email" value="<?php echo $row['email']; ?>">
	        </div><br>

            <input type="submit" class="btn btn-primary" name="update" value="Update">
			<a class="btn btn-primary" href="pengguna.php">Kembali</a>
        </form>
<?php
    } else {
        echo "No record found";
    }
}

// Close connection
$conn->close();
?>
