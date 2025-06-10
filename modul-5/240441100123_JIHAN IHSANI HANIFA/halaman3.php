<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Blog Reflektif Mahasiswa</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 40px;
      background-color: #fdfdfd;
      color: #333;
    }
    h1, h2 {
      color: #444;
    }
    .artikel-link a {
      display: block;
      padding: 10px;
      margin: 10px 0;
      background-color: #e7f0fa;
      border-left: 4px solid #007acc;
      text-decoration: none;
      color: #007acc;
      border-radius: 4px;
    }
    .artikel-link a:hover {
      background-color: #d0e8ff;
    }
    .konten-artikel {
      background-color: #f4f8fb;
      padding: 20px;
      border-left: 6px solid #007acc;
      border-radius: 5px;
    }
    img {
      max-width: 100%;
      margin: 20px 0;
      border-radius: 5px;
    }
    .kutipan {
      margin-top: 20px;
      background-color: #fff9e6;
      border-left: 5px solid #f0ad4e;
      padding: 10px 15px;
      font-style: italic;
      color: #8a6d3b;
    }
    .navigasi {
      margin-top: 40px;
    }
    .buttons {
            text-align: center;
            margin-top: 40px;
        }

    .buttons a {
        display: inline-block;
        margin: 0 10px;
        padding: 10px 20px;
        background-color: #0077cc;
        color: white;
        text-decoration: none;
        border-radius: 6px;
    }

    .refleksi {
      text-align: justify;
    }
    .sumber {
      margin-top: 10px;
    }

  .buttons {
     text-align: center;
     margin-top: 30px;
    }
  .buttons a {
    margin: 0 10px;
    padding: 10px 20px;
    background-color: #0077cc;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    display: inline-block;
    }

  </style>
</head>
<body>

<h1>Blog Reflektif Mahasiswa</h1>

<?php
$artikel = [
  1 => [
    'judul' => 'Pengalaman Pertama Belajar Coding',
    'tanggal' => '2025-03-05',
    'refleksi' => 'Pengalaman pertama saya belajar coding sangat menantang, tapi juga menyenangkan. Saya mulai dari dasar seperti Python, HTML, CSS lalu perlahan mengenal PHP. Meskipun belum sepenuhnya paham, saya merasa belajar coding membuka banyak peluang dan membuat saya semakin semangat untuk terus belajar.',
    'gambar' => 'foto/gmbr1.jpg', 
    'referensi' => 'https://www.w3schools.com/'
  ],
  2 => [
    'judul' => 'Develioper pemula',
    'tanggal' => '2025-04-28',
    'refleksi' => 'Saya baru mulai belajar coding dan memiliki ketertarikan dalam dunia pengembangan perangkat lunak. Saat ini saya fokus memahami dasar-dasar pemrograman dan pengembangan web. Meskipun masih di tahap awal, saya berkomitmen untuk terus belajar dan meningkatkan kemampuan secara bertahap agar bisa menjadi developer yang andal di masa depan.',
    'gambar' => 'foto/gmbr2.jpg',
    'referensi' => 'https://www.dicoding.com/blog'
  ],
  3 => [
    'judul' => 'bisnis digital',
    'tanggal' => '2025-05-03',
    'refleksi' => 'Saya tertarik dengan bisnis digital karena fleksibel dan punya peluang besar. Saat ini saya sedang belajar cara membangun usaha online, mulai dari promosi hingga cara menjangkau pelanggan. Meskipun masih awal, saya yakin bisnis digital bisa jadi pilihan masa depan saya.',
    'gambar' => 'foto/gmbr3.jpg',
    'referensi' => 'https://kledo.com/blog/bisnis-digital/'
  ]
];

$kutipan = [
  "Jangan menyerah hanya karena hal sulit. Hal sulit membuatmu berkembang.",
  "Setiap hari adalah kesempatan untuk menjadi lebih baik dari kemarin.",
  "Belajar bukan tentang siapa yang tercepat, tapi siapa yang tidak berhenti.",
  "Kesuksesan adalah hasil dari ketekunan dan kerja keras."
];

function ambilKutipanAcak($data) {
  return $data[rand(0, count($data) - 1)];
}

if (isset($_GET['id']) && isset($artikel[$_GET['id']])) {
  $id = $_GET['id'];
  $data = $artikel[$id];
  echo "<div class='konten-artikel'>";
  echo "<h2>{$data['judul']}</h2>";
  echo "<p><em>Diposting pada: {$data['tanggal']}</em></p>";
  echo "<p class='refleksi'>{$data['refleksi']}</p>";
  echo "<img src='{$data['gambar']}' alt='Gambar Artikel'>"; 
  echo "<div class='kutipan'>“" . ambilKutipanAcak($kutipan) . "”</div>";

  if (!empty($data['referensi'])) {
    echo "<div class='sumber'>Referensi: <a href='{$data['referensi']}' target='_blank'>{$data['referensi']}</a></div>";
  }

  echo "<p><a href='halaman3.php'>← Kembali ke daftar artikel</a></p>";
  echo "</div>";
} else {
  echo "<h2>Daftar Artikel</h2>";
  echo "<div class='artikel-link'>";
  foreach ($artikel as $id => $a) {
    echo "<a href='halaman3.php?id=$id'>{$a['judul']} ({$a['tanggal']})</a>";
  }
  echo "</div>";
}
?>

<div class="buttons">
  <a href="halaman1.php">Profil Interaktif</a>
  <a href="halaman2.php">Timeline</a>
</div>
</body>
</html>