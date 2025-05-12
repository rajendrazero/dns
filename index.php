<?php
$host = 'maglev.proxy.rlwy.net';
$port = 35682;
$user = 'root';
$password = 'RQDnCUbLBvpLHlbgfDDGuORKVjFOznhB';
$database = 'railway';

$mysqli = new mysqli($host, $user, $password, $database, $port);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
echo "✅ Koneksi berhasil!<br><br>";

// Cek semua tabel
$result = $mysqli->query("SHOW TABLES");

if ($result) {
    echo "<b>Daftar tabel di database:</b><br>";
    $tableNameToDelete = 'pkk-ecommerce';
    $found = false;

    while ($row = $result->fetch_array()) {
        echo $row[0] . "<br>";
        if ($row[0] === $tableNameToDelete) {
            $found = true;
        }
    }

    // Jika ditemukan, hapus tabel
    if ($found) {
        $drop = $mysqli->query("DROP TABLE `$tableNameToDelete`");
        if ($drop) {
            echo "<br>🗑️ Tabel <b>$tableNameToDelete</b> berhasil dihapus.";
        } else {
            echo "<br>❌ Gagal menghapus tabel <b>$tableNameToDelete</b>: " . $mysqli->error;
        }
    } else {
        echo "<br><br>ℹ️ Tabel <b>$tableNameToDelete</b> tidak ditemukan.";
    }

    $result->free();
} else {
    echo "❌ Gagal mengambil daftar tabel: " . $mysqli->error;
}

$mysqli->close();
?>
