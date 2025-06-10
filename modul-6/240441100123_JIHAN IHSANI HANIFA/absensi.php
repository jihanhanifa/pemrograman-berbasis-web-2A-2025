<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$query_absensi = "SELECT nip, tanggal_absensi, jam_masuk, jam_pulang FROM karyawan_absensi";
$result_absensi = mysqli_query($conn, $query_absensi);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Data Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .sidebar {
            height: 100vh;
            width: 220px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 12px 20px;
            text-decoration: none;
            font-size: 18px;
            color: #ddd;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: white;
        }
        .sidebar .active {
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-light px-3 mb-4">Manajemen Karyawan</h3>
        <a href="dashboard.php">Dashboard</a>
        <a href="karyawan.php">Data Karyawan</a>
        <a href="absensi.php" class="active">Data Absensi</a>
        <a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user']) ?>)</a>
    </div>

    <div class="content">
        <h2>Data Absensi</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>NIP</th>
                    <th>Tanggal Absensi</th>
                    <th>Jam Masuk</th>
                    <th>Jam Pulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_absensi)) : ?>
                    <tr>
                        <td><?= htmlspecialchars($row['nip']) ?></td>
                        <td><?= htmlspecialchars($row['tanggal_absensi']) ?></td>
                        <td><?= htmlspecialchars($row['jam_masuk']) ?></td>
                        <td><?= htmlspecialchars($row['jam_pulang']) ?></td>
                        <td>
                            <a href="edit.php?nip=<?= $row['nip'] ?>" class="btn btn-sm btn-success">Edit</a>
                            <a href="delete.php?nip=<?= $row['nip'] ?>" onclick="return confirm('Yakin hapus data absensi?')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
