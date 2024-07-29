<?php
include 'koneksi.php';

$id_produk = $_POST['id_produk'];
$id_payment = $_POST['id_payment'];

$sql = "UPDATE sistem_kasir SET id_payment = '$id_payment' WHERE id_produk = '$id_produk'";

if (mysqli_query($db, $sql)) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}

mysqli_close($db);
?>
