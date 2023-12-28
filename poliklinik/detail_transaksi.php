<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">

    <!-- Bootstrap offline -->

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"> 
	<link rel="stylesheet" type="text/css" href="style.css">
    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">   
    
    <title>Poliklinik</title>   <!--Judul Halaman-->
</head>
<?php
        $nama_obat = '';
        $harga_obat = '';
        $jasa = '';
        $total_biaya = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, 
            "SELECT * FROM biaya 
            WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_obat = $row['nama_obat'];
                $harga_obat = $row['harga_obat'];
                $jasa = $row['jasa'];
                $total_biaya = $row['total_biaya'];
            }
        ?>
        <?php
        }
        ?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">POLIKLINIK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="hal_pasien.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="konsultasi.php">Konsultasi</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
<div>
    <h1>SELAMAT DATANG</h1>
    <center><h2>PASIEN</h2></center>
    <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Obat</th>
            <th scope="col">Harga Obat</th>
            <th scope="col">Jasa</th>
            <th scope="col">Total Biaya</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
            $result = mysqli_query($mysqli, "SELECT * FROM biaya");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_pasien'] ?></td>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td><?php echo $data['harga_obat'] ?></td>
                    <td><?php echo $data['jasa'] ?></td>
                    <td><?php echo $data['total_biaya'] ?></td>
                </tr>
            <?php
            }
            ?>
    </tbody>
</table>
</div>
</body>
</html>