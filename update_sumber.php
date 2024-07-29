<?php
include 'koneksi.php';

$id_produk = $_POST['id_produk'];
$id_sumber = $_POST['id_sumber'];

$sql = "UPDATE produk SET id_sumber = '$id_sumber' WHERE id_produk = '$id_produk'";

if (mysqli_query($db, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

mysqli_close($db);
?>
