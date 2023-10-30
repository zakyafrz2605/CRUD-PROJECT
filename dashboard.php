<?php
$conn = mysqli_connect("localhost", "root", "", "siperlu");

if (isset($_POST['bsimpan'])) {
    if (isset($_GET['hal'])) {
        if ($_GET['hal'] == "edit") {
            $edit = mysqli_query($conn, "UPDATE mhs SET
            nim = '$_POST[tnim]',
            nama = '$_POST[tnama]',
            prodi = '$_POST[tprodi]',
            kapan_lulus = '$_POST[tlulus]'
            WHERE no = '$_GET[id]'
            ");
            if ($edit) {
                echo "<script>
                alert('Edit data Sukses!');
                document.location='dashboard.php';
                </script>";
            } else {
                echo "<script>
                alert('Edit data Gagal!');
                document.location='dashboard.php';
                </script>";
            }
        }
    } else {
        $simpan = mysqli_query($conn, "INSERT INTO mhs (nim, nama, prodi, kapan_lulus)
            VALUES ('$_POST[tnim]', '$_POST[tnama]', '$_POST[tprodi]', '$_POST[tlulus]')
            ");
        if ($simpan) {
            echo "<script>
            alert('Simpan Data Sukses!');
            document.location='dashboard.php';
            </script>";
        } else {
            echo "<script>
            alert('Simpan data Gagal!');
            document.location='dashboard.php';
            </script>";
        }
    }
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($conn, "SELECT * FROM mhs WHERE no = '$_GET[id]' ");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $nim = $data['nim'];
            $nama = $data['nama'];
            $prodi = $data['prodi'];
            $lulus = $data['kapan_lulus'];
        }
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($conn, "DELETE FROM mhs WHERE no = '$_GET[id]' ");
        if ($hapus) {
            echo "<script>
            alert('Hapus Data Sukses!');
            document.location='dashboard.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD-SIPERLU</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar-expand-lg navbar-light bg-warning fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>WEB KAMPUS INSTITUT TEKNOLOGI NASIONAL BANDUNG</b></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" ariacurrent="page" href="registrasi.php" onclick="return confirm('Yakin ingin keluar')">Logout</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <hr>
    <div class="container">
        <br/>
        <br/>
        <h2 class="text-center"> FORM DATA MAHASISWA</h2>
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                MASUKAN DATA MAHASISWA
            </div>
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label>NIM</label>
                        <input type="text" name="tnim" value="<?= @$nim ?>" class="form-control" placeholder="Input NIM anda disini!" required>
                    </div>
                    <div class "form-group">
                        <label>NAMA</label>
                        <input type="text" name="tnama" value="<?= @$nama ?>" class="form-control" placeholder="Input Nama anda disini!" required> 
                    </div>
                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="text" name="tprodi" value="<?= @$prodi ?>" class="form-control" placeholder="Input Prodi anda disini!" required> 
                    </div>
                    <div class="form-group">
                        <label>Kapan Anda Mau Lulus?</label>
                        <input type="date" name="tlulus" value="<?= @$lulus ?>" class="form-control" required> 
                    </div>
                    <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                    <button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
                </form>
            </div>
        </div>
        <br/>
        <div class="card mt-3">
            <div class="card-header bg-success text-white">
                DAFTAR DATA MAHASISWA
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Kapan Mau Lulus</th>
                            <th>Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM mhs";
                        $data = mysqli_query($conn, $query);
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['nim'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['prodi'] ?></td>
                            <td><?= $row['kapan_lulus'] ?></td>
                            <td>
                                <a href="dashboard.php?hal=edit&id=<?= $row['no'] ?>" class="btn btn-warning">Edit</a>
                                <a href="dashboard.php?hal=hapus&id=<?= $row['no'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Tambahkan bagian ini untuk menampilkan data -->
        <div class="card mt-3">
            <div class="card-header bg-info text-white">
                PRINT DATA MAHASISWA
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Program Studi</th>
                            <th>Kapan Mau Lulus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM mhs";
                        $data = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($data)) {
                        ?>
                        <tr>
                            <td><?= $row['nim'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['prodi'] ?></td>
                            <td><?= $row['kapan_lulus'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
