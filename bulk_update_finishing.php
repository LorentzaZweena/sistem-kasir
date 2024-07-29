<?php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['finishing'] as $id_produk => $id_finishing) {
        $sql = "UPDATE produk SET id_finishing='$id_finishing' WHERE id_produk='$id_produk'";
        mysqli_query($db, $sql);
    }
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
