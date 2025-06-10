<?php
session_start();
include "koneksi.php";

date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$total_karyawan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM karyawan_absensi"))['total'];

$today = date('Y-m-d');

$total_hadir = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM karyawan_absensi WHERE tanggal_absensi = '$today'"))['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Sistem Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            color: #1f2937;
        }
        .sidebar {
            height: 100vh;
            width: 200px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #374151;
            padding-top: 40px;
            color: #e0e7ff;
            display: flex;
            flex-direction: column;
            align-items: center;
            user-select: none;
            box-shadow: 3px 0 12px rgba(55, 65, 81, 0.7);
        }
        .sidebar h2 {
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 40px;
            letter-spacing: 2px;
            font-family: 'Segoe UI Black', sans-serif;
        }
        .sidebar a {
            width: 90%;
            padding: 12px 20px;
            margin: 6px 0;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            color: #d1d5db;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            box-shadow: 0 3px 6px rgb(55 65 81 / 0.3);
        }
        .sidebar a:hover {
            background-color: #4b5563;
            color: #f9fafb;
        }
        .sidebar a.active {
            background-color: #2563eb;
            color: white;
            font-weight: 700;
            box-shadow: 0 0 12px 3px #2563eb;
        }
        .content {
            margin-left: 200px;
            padding: 40px 50px;
            max-width: calc(100% - 200px);
        }
        .content h1 {
            font-weight: 900;
            color: #2563eb;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-shadow: 1px 1px 2px rgba(37, 99, 235, 0.4);
        }
        .content p {
            font-size: 1.1rem;
            margin-bottom: 35px;
            color: #4b5563;
        }
        .cards-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }
        .card {
            flex: 1 1 300px;
            background-color: white;
            border-radius: 15px;
            padding: 30px 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
            text-align: center;
            transition: box-shadow 0.3s ease;
        }
        .card:hover {
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        .card h3 {
            font-weight: 700;
            color: #2563eb;
            margin-bottom: 20px;
            font-size: 1.5rem;
            letter-spacing: 0.04em;
        }
        .card .number {
            font-size: 3.2rem;
            font-weight: 900;
            color: #1e40af;
            margin-bottom: 8px;
        }
        .card small {
            color: #6b7280;
            font-weight: 500;
        }
        @media (max-width: 700px) {
            .content {
                margin-left: 0;
                padding: 20px;
            }
            .cards-container {
                flex-direction: column;
            }
            .card {
                width: 100%;
                max-width: 100%;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding: 15px 0;
                flex-direction: row;
                justify-content: space-around;
                box-shadow: none;
            }
            .sidebar h2 {
                display: none;
            }
            .sidebar a {
                width: auto;
                padding: 10px 15px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>HR SYSTEM</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="karyawan.php">Data Karyawan</a>
        <a href="absensi.php">Data Absensi</a>
        <a href="tambah.php">Tambah Data</a>
        <a href="logout.php">Logout (<?= htmlspecialchars($_SESSION['user']) ?>)</a>
    </div>

    <div class="content">
        <h1>Dashboard</h1>
        <p>Halo, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>! Selamat datang kembali di sistem manajemen karyawan.</p>

        <div class="cards-container">
            <div class="card">
                <h3>Total Karyawan</h3>
                <div class="number"><?= $total_karyawan ?></div>
            </div>

            <div class="card">
                <h3>Karyawan Hadir Hari Ini</h3>
                <div class="number"><?= $total_hadir ?></div>
                <small><?= date('d M Y', strtotime($today)) ?></small>
            </div>
        </div>
    </div>
</body>
</html>
