<?php
$conn = mysqli_connect("localhost", "root", "", "manajemen_karyawan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>