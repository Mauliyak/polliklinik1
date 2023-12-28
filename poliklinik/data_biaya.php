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
            <a class="nav-link active" aria-current="page" href="periksa.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="data_biaya.php">Biaya</a>
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
</div>
<div>
<form style="Margin: 20px;" class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $nama_pasien= '';
        $nama_obat = '';
        $harga_obat = '';
        $jasa = '';
        $total_biaya = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, 
            "SELECT *
            FROM biaya 
            WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_pasien = $row['nama_pasien'];
                $nama_obat = $row['nama_obat'];
                $harga_obat = $row['harga_obat'];
                $jasa = $row['jasa'];
                $total_biaya = $row['total_biaya'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo
            $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="col mb-2">
            <label for="namaPaisen" class="form-label fw-bold">
                Nama Pasien
            </label><br>
            <select style="margin: 5px;" name="nama" id="id">
                <option  disabled selected> Pilih </option>
                <?php 
                $ambil = mysqli_query($mysqli, 
                "SELECT * FROM pasien");
                while ($data = mysqli_fetch_array($ambil)) {
                ?>
                <option class="form-control" value="<?=$data['nama']?>"><?=$data['nama']?></option> 
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col mb-2">
            <label for="inputNama" class="form-label fw-bold">
                Nama Obat
            </label>
            <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
        </div>
        <div class="col mb-2">
            <label for="inputHarga" class="form-label fw-bold">
                Harga Obat
            </label>
            <input type="int" class="form-control" name="harga_obat" id="inputHargaObat" placeholder="Harga Obat" value="<?php echo $harga_obat ?>">
        </div>
        <div class="col mb-2">
            <label for="inputJasa" class="form-label fw-bold">
                Jasa
            </label>
            <input type="int" class="form-control" name="jasa" id="inputJasa" placeholder="Jasa" value="<?php echo $jasa ?>">
        </div>
        <div style="margin: 30px;" class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

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
            <th scope="col">Aksi</th>
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
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="data_biaya.php?page=biaya&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="data_biaya.php?page=biaya&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
    </tbody>
</table>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE biaya SET 
                                        nama_pasien = '" . $_POST['nama_pasien'] . "',
                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                        harga_obat = '" . $_POST['harga_obat'] . "',
                                        jasa = '" . $_POST['jasa'] . "',
                                        total_biaya = '" . $harga_obat+$jasa . "'                                        
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $nama_pasien = $_POST['nama_pasien'];
        $nama_obat = $_POST['nama_obat'];
        $harga_obat = $_POST['harga_obat'];
        $jasa = $_POST['jasa'];
        $total_biaya = $harga_obat+$jasa;
        $tambah = mysqli_query($mysqli, "INSERT INTO biaya(nama_pasien,nama_obat,harga_obat,jasa,total_biaya) 
                                        VALUES('$nama_pasien','$nama_obat','$harga_obat','$jasa','$total_biaya')");
    }

    echo "<script> 
            document.location='data_biaya.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM biaya WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE biaya SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='data_biaya.php';
            </script>";
}
?>
</div>
</body>
</html>