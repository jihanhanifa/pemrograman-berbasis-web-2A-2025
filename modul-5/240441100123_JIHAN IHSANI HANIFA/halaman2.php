<?php
$timeline = [
    [
        "tahun" => "2024",
        "kegiatan" => "Masuk kuliah dan mengikuti orientasi mahasiswa baru."
    ],
    [
        "tahun" => "2024-2025 semester 1",
        "kegiatan" => "Mulai aktif diperkuliahan dan belajar berbagai bahasa pemrograman."
    ],
    [
        "tahun" => "2025-semester 2",
        "kegiatan" => "Mulai mengikuti organisasi."
    ],
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline Pengalaman Kuliah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 40px;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: auto;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 50%;
            width: 4px;
            background: #007bff;
            top: 0;
            bottom: 0;
            transform: translateX(-50%);
        }

        .timeline-item {
            position: relative;
            width: 50%;
            padding: 20px;
            box-sizing: border-box;
        }

        .timeline-item.left {
            left: 0;
        }

        .timeline-item.right {
            left: 50%;
        }

        .timeline-content {
            background: white;
            padding: 15px;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            position: relative;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            top: 30px;
            width: 12px;
            height: 12px;
            background: #007bff;
            border-radius: 50%;
            border: 2px solid white;
            z-index: 1;
        }

        .timeline-item.left::after {
            right: -6px;
        }

        .timeline-item.right::after {
            left: -6px;
        }

        .year {
            font-weight: bold;
            color: #007bff;
        }

        .buttons {
            text-align: center;
            margin-top: 40px;
        }

        .buttons a {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            transition: background 0.3s;
        }

        .buttons a:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .timeline-item {
                width: 100%;
                left: 0 !important;
                padding-left: 70px;
                padding-right: 25px;
                margin-bottom: 30px;
            }

            .timeline::before {
                left: 30px;
            }

            .timeline-item::after {
                left: 18px;
            }
        }
    </style>
</head>
<body>

    <h2>Timeline Pengalaman Kuliah</h2>

    <div class="timeline">
        <?php
        $i = 0;
        foreach ($timeline as $item) {
            $posisi = $i % 2 == 0 ? 'left' : 'right';
            echo "<div class='timeline-item $posisi'>
                    <div class='timeline-content'>
                        <div class='year'>{$item['tahun']}</div>
                        <p>{$item['kegiatan']}</p>
                    </div>
                  </div>";
            $i++;
        }
        ?>
    </div>

    <div class="buttons">
        <a href="halaman1.php">Profil Interaktif</a>
        <a href="halaman3.php">Blog Refleksi</a>
    </div>

</body>
</html>
