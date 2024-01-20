<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Pemrograman3.com</title>
</head>
<?php
// koneksi ke database
include "koneksi.php";
// menangkap data yang dikirim ke database
if (!empty($_POST["save"])) {

    $namaMhs = $_POST["nama_mhs"];
    $matkul = $_POST["matkul"];

    //input data ke database
    $a = mysqli_query($koneksi, "insert into krs values ('','$namaMhs','$matkul')");
    if ($a) {
        //mengalihkan halaman kembali
        header("location: tampil_krs.php");
    } else {
        echo mysqli_error($koneksi);
    }
}
?>

<body>
    <div class="container">
        <h2>Pemograman 3 2023</h2>
        <h3>TAMBAH DATA KRS</h3>
        <form method="POST">
            <table>
                <tr>
                    <td>Nama Mahasiswa</td>
                    <td>
                        <select name="nama_mhs" id="nama_mhs" required>
                            <option value="">--Pilih--</option>
                            <?php
                            $data = mysqli_query($koneksi, 'select * from mahasiswa');

                            while ($d = mysqli_fetch_array($data)) {
                            ?>
                                <option value="<?= $d['id_mhs']; ?>"><?= $d['nama_mhs']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Mata Kuliah</td>
                    <td>
                        <select name="matkul" id="matkulSelect" required onchange="updateSks()">
                            <option value="">--Pilih--</option>
                            <?php
                            // Ambil data matkul dari database
                            $data = mysqli_query($koneksi, 'SELECT matkul.*, sks.jml_sks FROM matkul INNER JOIN sks ON matkul.id_sks = sks.id_sks');

                            while ($row = $data->fetch_assoc()) {
                                echo "<option value='{$row['id_matkul']}' data-sks='{$row['jml_sks']}'>{$row['nama']}</option>";
                            }
                            $koneksi->close();
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>SKS</td>
                    <td>
                        <input type="text" name="sks" id="sks" readonly>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="save"></td>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function updateSks() {
            var matkulSelect = document.getElementById("matkulSelect");
            var jmlSksInput = document.getElementById("sks");

            // Mengambil nilai SKS dari atribut data-sks option yang dipilih
            var selectedOption = matkulSelect.options[matkulSelect.selectedIndex];
            var sks = selectedOption.getAttribute("data-sks");
            // console.log(sks)

            // Menyimpan nilai SKS ke dalam input "Jumlah SKS"
            jmlSksInput.value = sks;
        }
    </script>

</body>

</html>