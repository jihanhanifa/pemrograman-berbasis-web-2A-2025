<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Profil Interaktif Mahasiswa</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }
    table, th, td {
      border: 1px solid #444;
      border-collapse: collapse;
      padding: 8px;
    }
    table {
      margin-bottom: 20px;
      width: 100%;
      max-width: 600px;
    }
    h1, h2, h3 {
      text-align: center;
    }

    .profile-table {
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
    }
    .error {
      color: red;
      font-weight: bold;
      text-align: center;
    }
    .success {
      color: green;
      font-weight: bold;
      text-align: center;
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
    form {
      max-width: 600px;
      margin: 0 auto 30px auto;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }
    input[type=text], textarea, select {
      width: 100%;
      padding: 6px;
      margin-bottom: 15px;
      box-sizing: border-box;
    }
    input[type=checkbox], input[type=radio] {
      margin-right: 5px;
    }
    button {
      background-color: #0077cc;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }

    .hasil-table {
      margin-left: auto;
      margin-right: auto;
      border-collapse: collapse;
      border: 1px solid #444;
      padding: 8px;
      max-width: 600px;
      width: 100%;
    }
  </style>
</head>
<body>

<h1>Profil Interaktif Mahasiswa</h1>

<table class="profile-table">
  <tr><th>Nama</th><td>Jihan Ihsani Hanifa</td></tr>
  <tr><th>NIM</th><td>240441100123</td></tr>
  <tr><th>Tempat, Tanggal Lahir</th><td>Tuban, 28 Januari 2006</td></tr>
  <tr><th>Email</th><td>jihanhanifaaa@gmail.com</td></tr>
  <tr><th>No. HP</th><td>085182297724</td></tr>
</table>

<h2>Formulir Tambahan</h2>
<form method="POST" action="">
  <label>Bahasa Pemrograman (pisahkan dengan koma):</label>
  <input type="text" name="bahasa" value="<?php echo isset($_POST['bahasa']) ? htmlspecialchars($_POST['bahasa']) : ''; ?>" />

  <label>Pengalaman Proyek:</label>
  <textarea name="pengalaman"><?php echo isset($_POST['pengalaman']) ? htmlspecialchars($_POST['pengalaman']) : ''; ?></textarea>

  <label>Software yang sering digunakan:</label>
  <input type="checkbox" name="software[]" value="VS Code" <?php if (isset($_POST['software']) && in_array('VS Code', $_POST['software'])) echo 'checked'; ?>>VS Code
  <input type="checkbox" name="software[]" value="XAMPP" <?php if (isset($_POST['software']) && in_array('XAMPP', $_POST['software'])) echo 'checked'; ?>>XAMPP
  <input type="checkbox" name="software[]" value="Git" <?php if (isset($_POST['software']) && in_array('Git', $_POST['software'])) echo 'checked'; ?>>Git

  <label>Sistem Operasi:</label>
  <input type="radio" name="os" value="Windows" <?php if (isset($_POST['os']) && $_POST['os']=='Windows') echo 'checked'; ?>>Windows
  <input type="radio" name="os" value="Linux" <?php if (isset($_POST['os']) && $_POST['os']=='Linux') echo 'checked'; ?>>Linux
  <input type="radio" name="os" value="Mac" <?php if (isset($_POST['os']) && $_POST['os']=='Mac') echo 'checked'; ?>>Mac

  <label>Tingkat Penguasaan PHP:</label>
  <select name="php_level">
    <option value="">-- Pilih --</option>
    <option value="Pemula" <?php if(isset($_POST['php_level']) && $_POST['php_level']=='Pemula') echo 'selected'; ?>>Pemula</option>
    <option value="Menengah" <?php if(isset($_POST['php_level']) && $_POST['php_level']=='Menengah') echo 'selected'; ?>>Menengah</option>
    <option value="Mahir" <?php if(isset($_POST['php_level']) && $_POST['php_level']=='Mahir') echo 'selected'; ?>>Mahir</option>
  </select>

  <button type="submit" name="submit">Kirim</button>
</form>

<?php
function tampilkanData($data) {
  echo "<h3>Hasil Input</h3>";
  echo "<table class='hasil-table'>";
  foreach ($data as $key => $value) {
    echo "<tr><th style='text-align:left;'>$key</th><td>$value</td></tr>";
  }
  echo "</table>";
}

if (isset($_POST['submit'])) {
  $bahasa_raw = trim($_POST['bahasa'] ?? '');
  $pengalaman = trim($_POST['pengalaman'] ?? '');
  $software_arr = $_POST['software'] ?? [];
  $os = $_POST['os'] ?? '';
  $php_level = $_POST['php_level'] ?? '';

  if ($bahasa_raw === '' || $pengalaman === '' || empty($software_arr) || $os === '' || $php_level === '') {
    echo "<p class='error'>Semua field wajib diisi!</p>";
  } else {
    $bahasa = array_map('trim', explode(',', $bahasa_raw));
    $bahasa_filtered = array_filter($bahasa, fn($b) => $b !== '');

    $data = [
      "Bahasa Pemrograman" => implode(", ", $bahasa_filtered),
      "Pengalaman Proyek" => nl2br(htmlspecialchars($pengalaman)),
      "Software Digunakan" => implode(", ", $software_arr),
      "Sistem Operasi" => htmlspecialchars($os),
      "Tingkat Penguasaan PHP" => htmlspecialchars($php_level),
    ];

    tampilkanData($data);

    if (count($bahasa_filtered) > 2) {
      echo "<p class='success' style='text-align:center;'>Anda cukup berpengalaman dalam pemrograman!</p>";
    }
  }
}
?>

<div class="buttons">
  <a href="halaman2.php">Timeline</a>
  <a href="halaman3.php">Lihat Blog</a>
</div>

</body>
</html>
