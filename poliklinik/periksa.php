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
            <a class="nav-link active" aria-current="page" href="hal_dokter.php">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="data_obat.php">Data Obat</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="data_pasien.php">Data Pasien</a>
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
<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $id_pasien = '';
        $id_dokter = '';
        $tgl_periksa = '';
        $obat = '';
        $catatan = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, 
            "SELECT * FROM periksa 
            WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $id_pasien = $row['id_pasien'];
                $id_dokter = $row['id_dokter'];
                $tgl_periksa = $row['tgl_periksa'];
                $obat = $row['obat'];
                $catatan = $row['catatan'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo
            $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="col">
            <label for="idPasien" class="form-label fw-bold">
                Id Pasien
            </label><br>
            <select name="id_pasien" id="id">
                <option disabled selected> Pilih </option>
                <?php 
                $ambil = mysqli_query($mysqli, 
                "SELECT * FROM pasien");
                while ($data = mysqli_fetch_array($ambil)) {
                ?>
                <option class="form-control" value="<?=$data['id']?>"><?=$data['id']?></option> 
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col">
            <label for="idDokter" class="form-label fw-bold">
                Id Dokter
            </label><br>
            <select name="id_dokter" id="id">
                <option disabled selected> Pilih </option>
                <?php 
                $ambil = mysqli_query($mysqli, 
                "SELECT * FROM dokter");
                while ($data = mysqli_fetch_array($ambil)) {
                ?>
                <option class="form-control" value="<?=$data['id']?>"><?=$data['id']?></option> 
                <?php
                }
                ?>
            </select>
        </div>
        <div class="col">
            <label for="inputTanggalPeriksa" class="form-label fw-bold">
                Tanggal Periksa
            </label>
            <input type="date" class="form-control" name="tgl_periksa" id="inputTanggalPeriksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
        </div>
        <div class="col">
            <label for="inputObat" class="form-label fw-bold">
                Obat
            </label>
            <input type="text" class="form-control" name="obat" id="inputObat" placeholder="Obat" value="<?php echo $obat ?>">
        </div>
        <div class="col mb-2">
            <label for="inputCatatan" class="form-label fw-bold">
                Catatan
            </label>
            <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan" value="<?php echo $catatan ?>">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
        </div>
    </form>

    <table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Id Pasien</th>
            <th scope="col">Id Dokter</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Obat</th>
            <th scope="col">Catatan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
            $result = mysqli_query($mysqli, "SELECT * FROM periksa");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['id_pasien'] ?></td>
                    <td><?php echo $data['id_dokter'] ?></td>
                    <td><?php echo $data['tgl_periksa'] ?></td>
                    <td><?php echo $data['obat'] ?></td>
                    <td><?php echo $data['catatan'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="periksa.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="periksa.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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
        $ubah = mysqli_query($mysqli, "UPDATE periksa SET 
                                        id_pasien = '" . $_POST['id_pasien'] . "',
                                        id_dokter = '" . $_POST['id_dokter'] . "',
                                        tgl_periksa = '" . $_POST['tgl_periksa'] . "',
                                        obat = '" . $_POST['obat'] . "',
                                        catatan = '" . $_POST['catatan'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $id_pasien = $_POST['id_pasien'];
        $id_dokter = $_POST['id_dokter'];
        $tgl_periksa = $_POST['tgl_periksa'];
        $obat = $_POST['obat'];
        $catatan = $_POST['catatan'];
        $tambah = mysqli_query($mysqli, "INSERT INTO periksa(id_pasien,id_dokter,tgl_periksa,obat,catatan) 
                                        VALUES('$id_pasien','$id_dokter','$tgl_periksa','$obat','$catatan')");
    }

    echo "<script> 
            document.location='periksa.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE periksa SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='periksa.php';
            </script>";
}
?>
</div>
</body>
</html>