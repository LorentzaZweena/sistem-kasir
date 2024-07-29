<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $type = $_POST['type'];
    $value = $_POST['value'];

    // Map the type to the actual column name
    $column_map = [
        'kasir' => 'id_kasir',
        'status' => 'id_status',
        'payment' => 'id_payment',
        'kota' => 'id_kota',
        'sumber' => 'id_sumber'
    ];

    if (!isset($column_map[$type])) {
        echo 'Invalid type';
        exit;
    }

    $column_name = $column_map[$type];
    
    // Replace 'id_kasir' with the actual primary key column name
    $primary_key_column = 'id_kasir';  // Adjust if necessary

    // Prepare the SQL query
    $sql = "UPDATE sistem_kasir SET $column_name = ? WHERE $primary_key_column = ?";

    // Prepare and execute the statement
    if ($stmt = $db->prepare($sql)) {
        // Adjust type of bind_param if necessary
        $stmt->bind_param('si', $value, $id); // Assuming $value is a string and $id is an integer; adjust as needed
        if ($stmt->execute()) {
            echo 'Update successful';
        } else {
            echo 'Error updating record: ' . $db->error;
        }
        $stmt->close();
    } else {
        echo 'Error preparing statement: ' . $db->error;
    }

    $db->close();
} else {
    echo 'Invalid request method';
}
