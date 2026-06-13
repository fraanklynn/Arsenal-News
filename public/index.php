<?php
// Tampilkan semua file di direktori saat ini
echo "Lokasi index.php: " . __DIR__ . "<br>";
echo "Isi folder saat ini:<br>";
$files = scandir(__DIR__);
foreach($files as $file) { echo $file . "<br>"; }

// Cek vendor
echo "<br>Cek vendor di parent folder:<br>";
echo file_exists(__DIR__ . '/../vendor/autoload.php') ? "Ada di ../vendor" : "TIDAK ADA di ../vendor";
echo "<br>";
echo file_exists('/app/vendor/autoload.php') ? "Ada di /app/vendor" : "TIDAK ADA di /app/vendor";

die();