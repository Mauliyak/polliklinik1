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
            <a class="nav-link active" aria-current="page" href="hal_admin.php">Home</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
<div>
    <h1>DATA OBAT</h1>
    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $nama_obat = '';
        $kemasan = '';
        $harga = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, 
            "SELECT * FROM obat 
            WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama_obat = $row['nama_obat'];
                $kemasan = $row['kemasan'];
                $harga = $row['harga'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo
            $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="col">
            <label for="inputNamaObat" class="form-label fw-bold">
                Nama Obat
            </label>
            <input type="text" class="form-control" name="nama_obat" id="inputNamaObat" placeholder="Nama Obat" value="<?php echo $nama_obat ?>">
        </div>
        <div class="col">
            <label for="inputKemasan" class="form-label fw-bold">
                Kemasan
            </label>
            <input type="text" class="form-control" name="kemasan" id="inputKemasan" placeholder="Kemasan" value="<?php echo $kemasan ?>">
        </div>
        <div class="col mb-2">
            <label for="inputHarga" class="form-label fw-bold">
            Harga
            </label>
            <input type="int" class="form-control" name="harga" id="inputHarga" placeholder="Harga" value="<?php echo $harga ?>">
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
            <th scope="col">Nama Obat</th>
            <th scope="col">Kemasan</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
        <!-- Kode PHP untuk menampilkan semua isi dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
            $result = mysqli_query($mysqli, "SELECT * FROM obat");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama_obat'] ?></td>
                    <td><?php echo $data['kemasan'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="data_obat_admin.php?page=data_obat_admin&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="data_obat_admin.php?page=data_obat_admin&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
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
        $ubah = mysqli_query($mysqli, "UPDATE obat SET 
                                        nama_obat = '" . $_POST['nama_obat'] . "',
                                        kemasan = '" . $_POST['kemasan'] . "',
                                        harga = '" . $_POST['harga'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $nama_obat = $_POST['nama_obat'];
        $kemasan = $_POST['kemasan'];
        $harga = $_POST['harga'];
        $tambah = mysqli_query($mysqli, "INSERT INTO obat(nama_obat,kemasan,harga) 
                                        VALUES('$nama_obat','$kemasan','$harga')");
    }

    echo "<script> 
            document.location='data_obat_admin.php';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM obat WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE obat SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='data_obat_admin.php';
            </script>";
}
?>

</div>
</body>
</html>