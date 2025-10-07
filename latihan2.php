<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menggunakan variable dinamis dalam satu halaman</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Data Diri</h1>
        <form action="latihan2.php" method="get">
            Nama Anda : <input type="text" name="namanya" placeholder="azfa 24.12.3274">
            Alamat Anda : <textarea name="alamatnya"></textarea> <br>
            <input type="submit" name="kirim" value="sent">
        </form>

        <?php
        if (isset($_GET['kirim'])) {
            echo "<div class='result'>";
            echo "<h3>Hasil Input:</h3>";
            echo "Nama Anda : $_GET[namanya]<br>
";
            echo "Alamat Anda : $_GET[alamatnya]<br>
";
            echo "</div>";
        }
        ?>
    </div>
    <div class="watermark">24.12.3274</div>
</body>

</html>