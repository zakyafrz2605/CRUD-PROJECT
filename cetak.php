<!-- ... (Kode HTML Anda yang sudah ada) -->
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
                <a href="cetak.php?id=<?= $row['no'] ?>" class="btn btn-success">Cetak</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
