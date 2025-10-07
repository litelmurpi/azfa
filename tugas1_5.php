<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Mahasiswa Amikom</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Informasi Mahasiswa</h1>
        <form action="action3.php" method="POST">
            <table>
                <tr>
                    <td>Masukkan Nama </td>
                    <td>:</td>
                    <td><input type="text" name="nama"></td>
                </tr>
                <tr>
                    <td>Email </td>
                    <td>:</td>
                    <td><input type="email" name="email"></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin </td>
                    <td>:</td>
                    <td>
                        <input type="radio" name="jenkel" id="laki2" value="laki-laki">
                        <label for="laki2">Laki-Laki</label>
                        <input type="radio" name="jenkel" id="perempuan" value="perempuan">
                        <label for="perempuan">Perempuan</label>
                    </td>
                </tr>
                <tr>
                    <td>NIM</td>
                    <td>:</td>
                    <td><input type="text" name="nim"></td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>:</td>
                    <td><input type="date" name="tgl_lahir"></td>
                </tr>
                <tr>
                    <td><label for="prodi">Prodi</label></td>
                    <td>:</td>
                    <td>
                        <select name="prodi" id="prodi">
                            <option value="si">Sistem Informasi</option>
                            <option value="if">Informatika</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit"></td>
                    <td colspan="3"><input type="reset" value="Reset Form"></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="watermark">24.12.3274</div>
</body>

</html>