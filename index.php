<?php
$host = 'interchange.proxy.rlwy.net';
$port = 53896;
$user = 'root';
$password = 'rafaganteng123';
$database = 'railway';

$mysqli = new mysqli($host, $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
echo "Koneksi berhasil!<br><br>";

// Ambil semua tabel
$result = $mysqli->query("SHOW TABLES");

if ($result) {
    echo "<b>Daftar tabel:</b><br>";
    $tableNameToDelete = 'pkk-ecommerce';
    $found = false;

    while ($row = $result->fetch_array()) {
        echo $row[0] . "<br>";
        if ($row[0] === $tableNameToDelete) {
            $found = true;
        }
    }

    // Jika tabel ditemukan, hapus
    if ($found) {
        $dropResult = $mysqli->query("DROP TABLE `$tableNameToDelete`");
        if ($dropResult) {
            echo "<br>Tabel <b>$tableNameToDelete</b> berhasil dihapus.";
        } else {
            echo "<br>Gagal menghapus tabel <b>$tableNameToDelete</b>: " . $mysqli->error;
        }
    } else {
        echo "<br><br>Tabel <b>$tableNameToDelete</b> tidak ditemukan.";
    }

    $result->free();
} else {
    echo "Gagal mengambil daftar tabel: " . $mysqli->error;
}

$mysqli->close();
?>
