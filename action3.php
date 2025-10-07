<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Input</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Hasilnya :</h1>
        <div class="result">
            <?php
            $name = $_POST['nama'];
            $email = $_POST['email'];
            $jenkel = $_POST['jenkel'];
            $nim = $_POST['nim'];
            $lahir = $_POST['tgl_lahir'];
            $prodi = $_POST['prodi'];
            $prodi1;

            if ($prodi == "si") {
                $prodi1 = "Sistem Informasi";
            } else {
                $prodi1 = "Informatika";
            }

            $umur = date("Y-m-d") - $lahir;

            echo "Hallo, <b>$name</b><br>
";
            echo "Email anda adalah <b>$email</b><br>
";
            echo "Anda seorang <b>$jenkel</b><br>
";
            echo "NIM anda <b>$nim</b><br>
";
            echo "Tanggal Lahir anda <b>$lahir</b><br>
";
            echo "Prodi anda <b>$prodi1</b><br>
";
            echo "Dan sekarang umur mu <b>$umur tahun</b>";
            ?>
        </div>
    </div>
    <div class="watermark">24.12.3274</div>
</body>

</html>