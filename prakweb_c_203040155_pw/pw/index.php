<?php
require 'function.php';
$book = query("SELECT * FROM buku");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar buku</title>
</head>

<body>
  <h3>Daftar buku</h3>

  <a href="tambah.php">Tambah Data buku</a>
  <br><br>

  <div class="container">
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Judul</th>
        <th>Aksi</th>
      </tr>
      <?php $i = 1;
      foreach ($book as $m) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $m['gambar']; ?>" width="60"></td>
          <td><?= $m['judul']; ?></td>
          <td>
            <a href="detail.php?id=<?= $m['id']; ?>">lihat detail</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <script src="script.js"></script>
</body>

</html>