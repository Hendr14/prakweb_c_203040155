<?php
require 'function.php';

// ambil id dari URL
$id = $_GET['id'];

// query mahasiswa berdasarkan id
$books = query("SELECT * FROM buku WHERE id = $id");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Buku</title>
</head>

<body>
  <h3>Detail Buku</h3>
  <ul>
    <li><img src="img/<?= $books['gambar']; ?>" width="250"></li>
    <li>Judul : <?= $books['judul']; ?></li>
    <li>Pengarang : <?= $books['pengarang']; ?></li>
    <li>Tahun Terbit : <?= $books['tahun_terbit']; ?></li>
    <li><a href="ubah.php?id=<?= $books['id']; ?>">ubah</a> | <a href="hapus.php?id=<?= $books['id']; ?>" onclick="return confirm('apakah anda yakin?');">hapus</a></li>
    <li><a href="index.php">Kembali ke Daftar Buku</a></li>
  </ul>
</body>

</html>