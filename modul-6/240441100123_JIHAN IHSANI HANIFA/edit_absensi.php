<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['nip']) || !isset($_GET['tanggal'])) {
    header("Location: absensi.php");
    exit;
}

$nip = $_GET['nip'];
$tanggal = $_GET['tanggal'];

$sql = "SELECT * FROM karyawan_absensi WHERE nip = ? AND tanggal_absensi = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $nip, $tanggal);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: absensi.php");
    exit;
}

$data = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal_absensi_baru = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $update_sql = "UPDATE karyawan_absensi SET tanggal_absensi = ?, jam_masuk = ?, jam_pulang = ? WHERE nip = ? AND tanggal_absensi = ?";
    $stmt_update = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt_update, "sssss", $tanggal_absensi_baru, $jam_masuk, $jam_pulang, $nip, $tanggal);
    $exec = mysqli_stmt_execute($stmt_update);

    if ($exec) {
        if ($tanggal_absensi_baru !== $tanggal) {
            header("Location: edit_absensi.php?nip=" . urlencode($nip) . "&tanggal=" . urlencode($tanggal_absensi_baru));
            exit;
        } else {
            $data['tanggal_absensi'] = $tanggal_absensi_baru;
            $data['jam_masuk'] = $jam_masuk;
            $data['jam_pulang'] = $jam_pulang;
            echo "<p style='color:green;'>Data absensi berhasil diupdate.</p>";
        }
    } else {
        echo "<p style='color:red;'>Gagal mengupdate data absensi.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Edit Data Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-4">
    <h2>Edit Data Absensi</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" value="<?= htmlspecialchars($data['nip']) ?>" disabled>
        </div>
        <div class="mb-3">
            <label for="tanggal_absensi" class="form-label">Tanggal Absensi</label>
            <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi" value="<?= htmlspecialchars($data['tanggal_absensi']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="jam_masuk" class="form-label">Jam Masuk</label>
            <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?= htmlspecialchars($data['jam_masuk']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="jam_pulang" class="form-label">Jam Pulang</label>
            <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" value="<?= htmlspecialchars($data['jam_pulang']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Absensi</button>
        <a href="absensi.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
