<?php
// Include koneksi database
require_once 'db_connect.php';

// SQL untuk menambahkan kolom image_path ke tabel article
$query = "ALTER TABLE article ADD COLUMN image_path VARCHAR(255) DEFAULT NULL AFTER excerpt";

if (mysqli_query($conn, $query)) {
    echo "Kolom image_path berhasil ditambahkan ke tabel article.";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>