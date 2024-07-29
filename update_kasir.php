<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id']) && isset($_POST['type']) && isset($_POST['new_id'])) {
        $id = mysqli_real_escape_string($db, $_POST['id']);
        $type = mysqli_real_escape_string($db, $_POST['type']);
        $new_id = mysqli_real_escape_string($db, $_POST['new_id']);

        // Update the relevant column
        $sql = "UPDATE sistem_kasir SET $type = '$new_id' WHERE id = '$id'";
        if (mysqli_query($db, $sql)) {
            echo "Update successful!";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    } else {
        echo "Required parameters are missing.";
    }
}
?>
