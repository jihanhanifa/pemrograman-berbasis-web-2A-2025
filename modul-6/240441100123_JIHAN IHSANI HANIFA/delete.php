<?php
session_start();
include 'koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['nip'])) {
    $nip = $_GET['nip'];

    $sql = "DELETE FROM karyawan_absensi WHERE nip = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nip);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header("Location: dashboard.php?pesan=hapus_berhasil");
            exit;
        } else {
            echo "Gagal menghapus data: " . mysqli_stmt_error($stmt);
        }
    } else {
        echo "Gagal menyiapkan statement: " . mysqli_error($conn);
    }
} else {
    echo "NIP tidak ditemukan dalam parameter.";
}
?>
