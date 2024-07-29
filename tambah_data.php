<?php
include 'koneksi.php'; // Ensure you include your database connection

// Fetch dropdown options for select fields
function fetchOptions($db, $table, $idColumn, $nameColumn) {
    $sql = "SELECT $idColumn, $nameColumn FROM $table";
    $query = mysqli_query($db, $sql);
    $options = [];
    while ($data = mysqli_fetch_assoc($query)) {
        $options[] = $data;
    }
    return $options;
}

$kasir_options = fetchOptions($db, 'kasir', 'id_kasir', 'nama');
$status_options = fetchOptions($db, 'statusnya', 'id_status', 'status');
$payment_options = fetchOptions($db, 'payment', 'id_payment', 'payment');
$kota_options = fetchOptions($db, 'kota', 'id_kota', 'kota');
$sumber_options = fetchOptions($db, 'sumber', 'id_sumber', 'sumber');
$produk_options = fetchOptions($db, 'produk', 'id_produk', 'nama_produk');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Sistem Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">Tambah Data Sistem Kasir</h3>
        <form action="insert_sistem_kasir.php" method="post">
            <div class="mb-3">
                <label for="Tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="Tanggal" name="Tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="Kasir" class="form-label">Kasir</label>
                <select class="form-select" id="Kasir" name="id_kasir" required>
                    <option value="" disabled selected>Pilih Kasir</option>
                    <?php foreach ($kasir_options as $kasir): ?>
                        <option value="<?php echo $kasir['id_kasir']; ?>"><?php echo $kasir['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Status" class="form-label">Status</label>
                <select class="form-select" id="Status" name="id_status" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <?php foreach ($status_options as $status): ?>
                        <option value="<?php echo $status['id_status']; ?>"><?php echo $status['status']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Payment" class="form-label">Pembayaran</label>
                <select class="form-select" id="Payment" name="id_payment" required>
                    <option value="" disabled selected>Pilih Pembayaran</option>
                    <?php foreach ($payment_options as $payment): ?>
                        <option value="<?php echo $payment['id_payment']; ?>"><?php echo $payment['payment']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Customer" class="form-label">Customer</label>
                <input type="text" class="form-control" id="Customer" name="Customer" required>
            </div>
            <div class="mb-3">
                <label for="no_hp" class="form-label">No HP</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>
            <div class="mb-3">
                <label for="Alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="Alamat" name="Alamat" required>
            </div>
            <div class="mb-3">
                <label for="Kota" class="form-label">Kota</label>
                <select class="form-select" id="Kota" name="id_kota" required>
                    <option value="" disabled selected>Pilih Kota</option>
                    <?php foreach ($kota_options as $kota): ?>
                        <option value="<?php echo $kota['id_kota']; ?>"><?php echo $kota['kota']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Sumber" class="form-label">Sumber</label>
                <select class="form-select" id="Sumber" name="id_sumber" required>
                    <option value="" disabled selected>Pilih Sumber</option>
                    <?php foreach ($sumber_options as $sumber): ?>
                        <option value="<?php echo $sumber['id_sumber']; ?>"><?php echo $sumber['sumber']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="Produk" class="form-label">Produk</label>
                <select class="form-select" id="Produk" name="id_produk" required>
                    <option value="" disabled selected>Pilih Produk</option>
                    <?php foreach ($produk_options as $produk): ?>
                        <option value="<?php echo $produk['id_produk']; ?>" data-harga="<?php echo $produk['harga_jual']; ?>"><?php echo $produk['nama_produk']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="QTY" class="form-label">QTY</label>
                <input type="number" class="form-control" id="QTY" name="QTY" required>
            </div>
            <div class="mb-3">
                <label for="harga_per_item" class="form-label">Harga per Item</label>
                <input type="number" class="form-control" id="harga_per_item" name="harga_per_item" required>
            </div>
            <div class="mb-3">
                <label for="spending_total" class="form-label">Spending Total</label>
                <input type="text" class="form-control" id="spending_total" name="spending_total" readonly>
            </div>
            <div class="mb-3">
                <label for="each_total" class="form-label">Each Total</label>
                <input type="text" class="form-control" id="each_total" name="each_total" readonly>
            </div>
            <div class="mb-3">
                <label for="grand_total" class="form-label">Grand Total</label>
                <input type="text" class="form-control" id="grand_total" name="grand_total" readonly>
            </div>
            <div class="mb-3">
                <label for="delivery" class="form-label">Delivery</label>
                <input type="text" class="form-control" id="delivery" name="delivery" required>
            </div>
            <div class="mb-3">
                <label for="packing" class="form-label">Packing</label>
                <input type="number" class="form-control" id="packing" name="packing" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produkSelect = document.getElementById('Produk');
            const qtyInput = document.getElementById('QTY');
            const hargaPerItemInput = document.getElementById('harga_per_item');
            const spendingTotalInput = document.getElementById('spending_total');
            const eachTotalInput = document.getElementById('each_total');
            const grandTotalInput = document.getElementById('grand_total');

            produkSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const hargaPerItem = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
                hargaPerItemInput.value = hargaPerItem.toFixed(2);
                calculateTotals();
            });

            qtyInput.addEventListener('input', function () {
                calculateTotals();
            });

            hargaPerItemInput.addEventListener('input', function () {
                calculateTotals();
            });

            function calculateTotals() {
                const qty = parseInt(qtyInput.value) || 0;
                const hargaPerItem = parseFloat(hargaPerItemInput.value) || 0;

                const eachTotal = hargaPerItem;
                const spendingTotal = hargaPerItem * qty;
                const grandTotal = spendingTotal;

                eachTotalInput.value = eachTotal.toFixed(2);
                spendingTotalInput.value = spendingTotal.toFixed(2);
                grandTotalInput.value = grandTotal.toFixed(2);
            }
        });
    </script>
</body>
</html>
