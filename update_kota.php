<?php
include 'koneksi.php';

$id_produk = $_POST['id_produk'];
$id_kota = $_POST['id_kota'];

$sql = "UPDATE produk SET id_kota = '$id_kota' WHERE id_produk = '$id_produk'";

if (mysqli_query($db, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

mysqli_close($db);
?>
