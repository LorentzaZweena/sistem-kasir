<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        tr {
            text-align: center;
        }
        body {
            text-decoration: none;
        }
        .buat-logout {
            margin-left: 43em;
        }
        .wide-select {
            width: 100px;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <?php include "koneksi.php"; ?>

    <h3 class="mt-5 ms-5">Sistem Kasir</h3>

    <div class="d-flex flex-row ms-n2">
        <div class="p-2">
            <div class="dropdown">
                <button class="btn btn-light border border-secondary dropdown-toggle dropdown-toggle-split rounded-0 ms-5 mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All table
                </button>
                <ul class="dropdown-menu mt-2">
                    <li><a class="dropdown-item" href="products.php">Data produk</a></li>
                    <li><a class="dropdown-item" href="admin_read.php">Data admin</a></li>
                </ul>
            </div>
        </div>
        <div class="p-2">
            <nav class="navbar bg-transparent">
                <div class="container-fluid bg-transparent">
                    <form class="d-flex bg-transparent rounded-0" role="search">
                        <input class="form-control me-2 rounded-0" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success rounded-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
        <div class="p-2">
            <div class="buat-logout">
                <a class="btn btn-light border border-black rounded-0 mt-2 ms-1" href="tambah_data.php" role="button" style="width: 100%;">Tambah data</a>
            </div>
        </div>
    </div>
    <hr>

    <div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">

    </div>

    <table class="table ms-2" style="width: 90%">
        <thead>
            <tr class="table-primary">
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Nama Kasir</th>
                <th scope="col">Status</th>
                <th scope="col">Payment</th>
                <th scope="col">Customer</th>
                <th scope="col">No Hp</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kota</th>
                <th scope="col">Sumber</th>
                <th scope="col">Item Product</th>
                <th scope="col">QTY</th>
                <th scope="col">Price / Item</th>
                <th scope="col">Total</th>
                <th scope="col">Discount</th>
                <th scope="col">Each Total</th>
                <th scope="col">Grand Total</th>
                <th scope="col">Delivery</th>
                <th scope="col">Packing</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $sql = "SELECT sistem_kasir.*, kasir.nama AS nama_kasir, statusnya.status AS status, payment.payment AS payment, kota.kota AS kota, sumber.sumber AS sumber, produk.nama_produk AS produk 
                FROM sistem_kasir 
                JOIN produk ON sistem_kasir.id_produk = produk.id_produk 
                JOIN kasir ON sistem_kasir.id_kasir = kasir.id_kasir 
                JOIN statusnya ON sistem_kasir.id_status = statusnya.id_status 
                JOIN payment ON sistem_kasir.id_payment = payment.id_payment 
                JOIN kota ON sistem_kasir.id_kota = kota.id_kota 
                JOIN sumber ON sistem_kasir.id_sumber = sumber.id_sumber";
        
                $query = mysqli_query($db, $sql);
                $no = 1;

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

                while ($data = mysqli_fetch_array($query)) {
                    $id = isset($data['id']) ? $data['id'] : '';

                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$data['Tanggal']."</td>";
                    echo "<td>";
                    echo "<select class='form-select wide-select' data-id='".$id."' data-type='kasir'>";
                    foreach ($kasir_options as $kasir) {
                        $selected = $kasir['id_kasir'] == $data['id_kasir'] ? 'selected' : '';
                        echo "<option value='".$kasir['id_kasir']."' $selected>".$kasir['nama']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<select class='form-select wide-select' data-id='".$id."' data-type='status'>";
                    foreach ($status_options as $status) {
                        $selected = $status['id_status'] == $data['id_status'] ? 'selected' : '';
                        echo "<option value='".$status['id_status']."' $selected>".$status['status']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<select class='form-select wide-select' data-id='".$id."' data-type='payment'>";
                    foreach ($payment_options as $payment) {
                        $selected = $payment['id_payment'] == $data['id_payment'] ? 'selected' : '';
                        echo "<option value='".$payment['id_payment']."' $selected>".$payment['payment']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>".(isset($data['customer']) ? $data['customer'] : '')."</td>";
                    echo "<td>".(isset($data['no_hp']) ? $data['no_hp'] : '')."</td>";
                    echo "<td>".(isset($data['alamat']) ? $data['alamat'] : '')."</td>";
                    echo "<td>";
                    echo "<select class='form-select wide-select' data-id='".$id."' data-type='kota'>";
                    foreach ($kota_options as $kota) {
                        $selected = $kota['id_kota'] == $data['id_kota'] ? 'selected' : '';
                        echo "<option value='".$kota['id_kota']."' $selected>".$kota['kota']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>";
                    echo "<select class='form-select wide-select' data-id='".$id."' data-type='sumber'>";
                    foreach ($sumber_options as $sumber) {
                        $selected = $sumber['id_sumber'] == $data['id_sumber'] ? 'selected' : '';
                        echo "<option value='".$sumber['id_sumber']."' $selected>".$sumber['sumber']."</option>";
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "<td>".$data['produk']."</td>";
                    echo "<td><input type='number' class='form-control qty-input' data-id='".$id."' value='".(isset($data['qty']) ? $data['qty'] : 0)."' /></td>";
                    echo "<td>".$data['harga_per_item']."</td>";
                    echo "<td class='total-cell'>".(isset($data['spending_total']) ? $data['spending_total'] : 0)."</td>";
                    echo "<td>".$data['discount']."</td>";
                    echo "<td class='each_total'>".(isset($data['each_total']) ? $data['each_total'] : 0)."</td>";
                    echo "<td>".$data['grand_total']."</td>";
                    echo "<td>".$data['delivery']."</td>";
                    echo "<td>".$data['packing']."</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzU1q58rU+ASpae7rZ6fz7Z39oQB6Qr60MxtRaGtvFQ+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGzU1q58rU+ASpae7rZ6fz7Z39oQB6Qr60MxtRaGtvFQ+" crossorigin="anonymous"></script>
    <script>
        function updateDatabase(id, type, value) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_data.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    showAlert(xhr.responseText);
                }
            };
            xhr.send(`id=${id}&type=${type}&value=${value}`);
        }

        function calculateTotal(input) {
            const qty = parseFloat(input.value) || 0;
            const pricePerItem = parseFloat(input.closest('tr').querySelector('td:nth-child(13)').textContent) || 0;
            const totalCell = input.closest('tr').querySelector('.total-cell');
            const total = qty * pricePerItem;
            totalCell.textContent = total.toFixed(2);

            updateDatabase(input.dataset.id, 'qty', qty);
            const discount = parseFloat(input.closest('tr').querySelector('td:nth-child(15)').textContent) || 0;
            const eachTotal = total - discount;
            input.closest('tr').querySelector('.each_total').textContent = eachTotal.toFixed(2);
            let grandTotal = 0;
            document.querySelectorAll('.each_total').forEach(cell => {
                grandTotal += parseFloat(cell.textContent) || 0;
            });
            document.querySelector('td:nth-child(17)').textContent = grandTotal.toFixed(2);
        }

        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', function() {
                const id = this.dataset.id;
                const type = this.dataset.type;
                const value = this.value;
                updateDatabase(id, type, value);
            });
        });

        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', function() {
                calculateTotal(this);
            });
        });

        function showAlert(message) {
            const alertContainer = document.getElementById('alert-container');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show';
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>`;
            alertContainer.appendChild(alertDiv);

            // Remove alert after 5 seconds
            setTimeout(() => {
                alertDiv.classList.remove('show');
                alertDiv.classList.add('fade');
                setTimeout(() => alertDiv.remove(), 150);
            }, 5000);
        }
    </script>
</body>
</html>
