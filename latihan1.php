<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggunaan parameter POST</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>INFORMASI USER</h1>
        <form action="action1.php" method="POST">
            <table>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><input type="text" name="nameuser" placeholder="azfa 24.12.3274"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><input type="email" name="emailuser"></td>
                </tr>
                <tr>
                    <td colspan="3"><input type="submit"></td>
                </tr>
            </table>
        </form>
    </div>
    <div class="watermark">24.12.3274</div>
</body>

</html>