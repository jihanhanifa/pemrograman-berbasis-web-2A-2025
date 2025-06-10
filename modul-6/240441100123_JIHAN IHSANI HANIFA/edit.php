<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['nip'])) {
    header("Location: dashboard.php");
    exit;
}

$nip = $_GET['nip'];

$sql = "SELECT * FROM karyawan_absensi WHERE nip = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $nip);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 0) {
    header("Location: dashboard.php");
    exit;
}

$data = mysqli_fetch_assoc($result);
$data_lama = $data;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $kota_asal = $_POST['kota_asal'];
    $tanggal_absensi = $_POST['tanggal_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_pulang = $_POST['jam_pulang'];

    $update_sql = "UPDATE karyawan_absensi SET 
        nama = ?, umur = ?, jenis_kelamin = ?, departemen = ?, jabatan = ?, kota_asal = ?, tanggal_absensi = ?, jam_masuk = ?, jam_pulang = ?
        WHERE nip = ?";
    $stmt_update = mysqli_prepare($conn, $update_sql);
    mysqli_stmt_bind_param($stmt_update, "sissssssss", 
        $nama, $umur, $jenis_kelamin, $departemen, $jabatan, $kota_asal, $tanggal_absensi, $jam_masuk, $jam_pulang, $nip);
    mysqli_stmt_execute($stmt_update);

    if (mysqli_stmt_affected_rows($stmt_update) > 0) {
        $sql_new = "SELECT * FROM karyawan_absensi WHERE nip = ?";
        $stmt_new = mysqli_prepare($conn, $sql_new);
        mysqli_stmt_bind_param($stmt_new, "s", $nip);
        mysqli_stmt_execute($stmt_new);
        $result_new = mysqli_stmt_get_result($stmt_new);
        $data_baru = mysqli_fetch_assoc($result_new);
    } else {
        $error = "Gagal mengupdate data atau tidak ada perubahan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Karyawan</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h2>Edit Data Karyawan</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <label>NIP</label>
            <input type="text" name="nip" value="<?= htmlspecialchars($data['nip']) ?>" disabled />

            <label>Nama</label>
            <input type="text" name="nama" required value="<?= htmlspecialchars($data['nama']) ?>" />

            <label>Umur</label>
            <input type="number" name="umur" required value="<?= htmlspecialchars($data['umur']) ?>" />

            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" required>
                <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
            </select>

            <label>Departemen</label>
            <input type="text" name="departemen" required value="<?= htmlspecialchars($data['departemen']) ?>" />

            <label>Jabatan</label>
            <input type="text" name="jabatan" required value="<?= htmlspecialchars($data['jabatan']) ?>" />

            <label>Kota Asal</label>
            <input type="text" name="kota_asal" required value="<?= htmlspecialchars($data['kota_asal']) ?>" />

            <label>Tanggal Absensi</label>
            <input type="date" name="tanggal_absensi" required value="<?= htmlspecialchars($data['tanggal_absensi']) ?>" />

            <label>Jam Masuk</label>
            <input type="time" name="jam_masuk" required value="<?= htmlspecialchars($data['jam_masuk']) ?>" />

            <label>Jam Pulang</label>
            <input type="time" name="jam_pulang" required value="<?= htmlspecialchars($data['jam_pulang']) ?>" />

            <button type="submit">Update Data</button>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($data_baru)): ?>
            <h3>Perbandingan Data Lama dan Data Baru</h3>
            <table border="1" cellpadding="5" cellspacing="0">
                <tr><th>Field</th><th>Data Lama</th><th>Data Baru</th></tr>
                <tr><td>NIP</td><td><?= htmlspecialchars($data_lama['nip']) ?></td><td><?= htmlspecialchars($data_baru['nip']) ?></td></tr>
                <tr><td>Nama</td><td><?= htmlspecialchars($data_lama['nama']) ?></td><td><?= htmlspecialchars($data_baru['nama']) ?></td></tr>
                <tr><td>Umur</td><td><?= htmlspecialchars($data_lama['umur']) ?></td><td><?= htmlspecialchars($data_baru['umur']) ?></td></tr>
                <tr><td>Jenis Kelamin</td><td><?= htmlspecialchars($data_lama['jenis_kelamin']) ?></td><td><?= htmlspecialchars($data_baru['jenis_kelamin']) ?></td></tr>
                <tr><td>Departemen</td><td><?= htmlspecialchars($data_lama['departemen']) ?></td><td><?= htmlspecialchars($data_baru['departemen']) ?></td></tr>
                <tr><td>Jabatan</td><td><?= htmlspecialchars($data_lama['jabatan']) ?></td><td><?= htmlspecialchars($data_baru['jabatan']) ?></td></tr>
                <tr><td>Kota Asal</td><td><?= htmlspecialchars($data_lama['kota_asal']) ?></td><td><?= htmlspecialchars($data_baru['kota_asal']) ?></td></tr>
                <tr><td>Tanggal Absensi</td><td><?= htmlspecialchars($data_lama['tanggal_absensi']) ?></td><td><?= htmlspecialchars($data_baru['tanggal_absensi']) ?></td></tr>
                <tr><td>Jam Masuk</td><td><?= htmlspecialchars($data_lama['jam_masuk']) ?></td><td><?= htmlspecialchars($data_baru['jam_masuk']) ?></td></tr>
                <tr><td>Jam Pulang</td><td><?= htmlspecialchars($data_lama['jam_pulang']) ?></td><td><?= htmlspecialchars($data_baru['jam_pulang']) ?></td></tr>
            </table>
        <?php endif; ?>

        <p><a href="dashboard.php">Kembali ke Dashboard</a></p>
    </div>
</body>
</html>
