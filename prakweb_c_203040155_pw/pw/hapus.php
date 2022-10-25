<?php 
require 'function.php';

// mengambil data dari url
$id = $_GET['id'];

if( hapus($id) > 0 ) {
	echo "
		<script>
			alert('data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>
	";
} else {
	echo "data gagal ditambahkan!";
}