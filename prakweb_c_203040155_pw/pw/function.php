<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'prakweb_c_203040155_pw');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  // jika hasilnya hanya 1 data
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function upload()
{
  $nama_file = $_FILES["gambar"]["name"];
  $tipe_file = $_FILES["gambar"]["type"];
  $ukuran_file = $_FILES["gambar"]["size"];
  $error = $_FILES["gambar"]["error"];
  $tmp_file = $_FILES["gambar"]["tmp_name"];

  if ($error == 4) {
    return 'no_photo.png';
  }

  // cek apakah yang diupload hanya gambar
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));

  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "
            <script>
                alert('yang anda pilih bukan gambar');
            </script>
        ";
    return false;
  }

  // cek tipe file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "
            <script>
                alert('yang anda pilih bukan gambar');
            </script>
        ";
    return false;
  }

  // cek jika ukurannya terlalu besar
  if ($ukuran_file > 5000000) {
    echo "
            <script>
                alert('ukuran gambar terlalu besar');
            </script>
        ";
    return false;
  }

  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;

  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

  return $nama_file_baru;
}

function tambah($data)
{
  $conn = koneksi();

  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $tahun_terbit = htmlspecialchars($data['tahun_terbit']);
  $gambar_lama = htmlspecialchars($data['gambar']);
  $gambar = upload();

  if (!$gambar) {
    return false;
  }

  if ($gambar == 'no_photo.png') {
    $gambar = $gambar_lama;
  }

  $query = "INSERT INTO
              buku
            VALUES
            ('', '$judul', '$pengarang', '$tahun_terbit', '$gambar');
          ";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();

  $mhs = query("SELECT * FROM buku WHERE id = $id");
  if ($mhs['gambar'] != 'no_photo.png') {
    unlink('img/' . $mhs['gambar']);
  }


  $mhs = query("SELECT * FROM buku WHERE id = $id");
  if ($mhs['gambar'] != 'no_photo.png') {
    unlink('img/' . $mhs['gambar']);
  }

  mysqli_query($conn, "DELETE FROM buku WHERE id = $id") or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = koneksi();

  $id = $data['id'];
  $judul = htmlspecialchars($data['judul']);
  $pengarang = htmlspecialchars($data['pengarang']);
  $tahun_terbit = htmlspecialchars($data['tahun_terbit']);
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();

  if (!$gambar) {
    return false;
  }

  if ($gambar == 'no_photo.png') {
    $gambar = $gambar_lama;
  }

  $query = "UPDATE buku SET
              judul = '$judul',
              pengarang = '$pengarang',
              tahun_terbit = '$tahun_terbit',
              gambar = '$gambar'
            WHERE id = $id";

  mysqli_query($conn, $query) or die(mysqli_error($conn));
  return mysqli_affected_rows($conn);
}