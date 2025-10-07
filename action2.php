<?php
$name = $_POST['nama'];
$angka1 = $_POST['angka1'];
$angka2 = $_POST['angka2'];

$hasil;

echo "<br>";
echo "Perhitungan Aritmatika";
echo "<br>";
echo "<br>";

echo "$angka1 + $angka2 = " . ($angka1 + $angka2) . "<br>";
echo "$angka1 - $angka2 = " . ($angka1 - $angka2) . "<br>";
echo "$angka1 * $angka2 = " . ($angka1 * $angka2) . "<br>";
echo "$angka1 / $angka2 = " . ($angka1 / $angka2) . "<br>";
echo "$angka1 % $angka2 = " . ($angka1 % $angka2) . "<br>";
