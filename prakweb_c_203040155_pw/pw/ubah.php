<?php
require 'function.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
  header("Location: index.php");
  exit;
}

// ambil id dari url
$id = $_GET['id'];

// query Buku berdasarkan id
$books = query("SELECT * FROM buku WHERE id = $id");

// cek apakah tombol ubah sudah ditekan
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'index.php';
         </script>";
  } else {
    echo "data gagal diubah!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Buku</title>
</head>

<body>

  <h3>Form Ubah Data Buku</h3>

  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $books['id']; ?>">
    <ul>
      <li>
        <label>
          Judul :
          <input type="text" name="judul" autofocus required value="<?= $books['judul']; ?>">
        </label>
      </li>
      <li>
        <label>
          Pengarang :
          <input type="text" name="pengarang" required value="<?= $books['pengarang']; ?>">
        </label>
      </li>
      <li>
        <label>
          Tahun Terbit :
          <input type="text" name="tahun_terbit" required value="<?= $books['tahun_terbit']; ?>">
        </label>
      </li>
      <li>
        <input type="hidden" name="gambar_lama" value="<?= $books['gambar']; ?>">
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/<?= $books['gambar']; ?>" width="120" style="display: block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="ubah">Ubah Data!</button>
      </li>
    </ul>
  </form>

  <script src="script.js"></script>
</body>

</html>