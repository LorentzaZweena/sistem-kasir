<?php
include 'koneksi.php';

$id_produk = $_POST['id_produk'];
$id_status = $_POST['id_status'];

$sql = "UPDATE sistem_kasir SET id_status = '$id_status' WHERE id_produk = '$id_produk'";

if (mysqli_query($db, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

mysqli_close($db);
?>
