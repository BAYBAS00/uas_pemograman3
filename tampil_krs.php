<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemrograman3.com</title>
</head>

<body>
    <h2>Pemrograman 3 2023</h2>
    <br>
    <a href="input_krs.php">+ TAMBAH KRS</a>
    <br>
    <table border='1'>
        <tr>
            <th>NO</th>
            <th>Nama Mahasiswa</th>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>OPSI</th>
        </tr>
        <?php
        include 'koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT mahasiswa.nama_mhs, matkul.nama, sks.jml_sks from krs Join mahasiswa on mahasiswa.id_mhs=krs.id_mhs Join matkul on matkul.id_matkul=krs.id_matkul join sks on matkul.id_sks=sks.id_sks");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_mhs']; ?></td>
                <td><?php echo $d['nama']; ?></td>
                <td><?php echo $d['jml_sks']; ?></td>
                    <td>
                        <a href="edit_transaksi.php?id=<?php echo $d['id']; ?>">EDIT</a> |
                        <a href="hapus_transaksi.php?id=<?php echo $d['id']; ?>">HAPUS</a>
                    </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>