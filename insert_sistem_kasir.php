<?php
include 'koneksi.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $tanggal = $_POST['Tanggal'];
    $id_kasir = $_POST['id_kasir'];
    $id_status = $_POST['id_status'];
    $id_payment = $_POST['id_payment'];
    $customer = $_POST['Customer'];
    $no_hp = $_POST['no_hp'];
    $alamat = $_POST['Alamat'];
    $id_kota = $_POST['id_kota'];
    $id_sumber = $_POST['id_sumber'];
    $id_produk = $_POST['id_produk'];
    $qty = $_POST['QTY'];
    $harga_per_item = $_POST['harga_per_item'];
    $spending_total = $_POST['spending_total'];
    $each_total = $_POST['each_total'];
    $grand_total = $_POST['grand_total'];
    $delivery = $_POST['delivery'];
    $packing = $_POST['packing'];
    
    // Prepare SQL statement
    $sql = "INSERT INTO sistem_kasir 
            (Tanggal, id_kasir, id_status, id_payment, Customer, no_hp, Alamat, id_kota, id_sumber, id_produk, QTY, harga_per_item, spending_total, each_total, grand_total, delivery, packing)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param('siiissisiiissssss', 
            $tanggal, $id_kasir, $id_status, $id_payment, $customer, $no_hp, $alamat, $id_kota, $id_sumber, $id_produk, $qty, $harga_per_item, $spending_total, $each_total, $grand_total, $delivery, $packing);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error: " . $db->error;
    }

    // Close the database connection
    $db->close();
}
?>
