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
    <?php 
        include "koneksi.php";
    ?>

    <!-- judul halaman -->
    <h3 class="mt-5 ms-5">Sistem Kasir</h3>

    <!-- navigasi untuk mengakses data kamar dan data lainnya -->
    <div class="d-flex flex-row ms-n2">
        <div class="p-2">
            <div class="dropdown">
                <button class="btn btn-light border border-secondary dropdown-toggle dropdown-toggle-split rounded-0 ms-5 mt-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    All table
                </button>
                <ul class="dropdown-menu mt-2">
                    <li><a class="dropdown-item" href="products.php">Data produk</a></li>
                    <li><a class="dropdown-item" href="admin_read.php">Data admin</a></li>
                    <!-- <li><a class="dropdown-item" href="penyewaan_read.php">ERROR</a></li> -->
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
                <a class="btn btn-light border border-black rounded-0 mt-2 ms-1" href="logout.php" role="button" style="width: 100%;">Logout</a>
            </div>
        </div>
    </div>
    <hr>

    <div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
        <!-- Alert container for Bootstrap alerts -->
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
                $sql = "SELECT sistem_kasir.*, kasir.nama AS nama_kasir, statusnya.status AS status, payment.payment AS payment, kota.kota AS kota, sumber.sumber AS sumber, produk.id_produk AS id_produk, sistem_kasir.customer, sistem_kasir.no_hp, sistem_kasir.alamat, sistem_kasir.qty, sistem_kasir.harga_per_item, sistem_kasir.spending_total, sistem_kasir.discount, sistem_kasir.each_total, sistem_kasir.grand_total, sistem_kasir.delivery, sistem_kasir.packing 
                FROM sistem_kasir 
                JOIN produk ON sistem_kasir.id_produk = produk.id_produk 
                JOIN kasir ON sistem_kasir.id_kasir = kasir.id_kasir 
                JOIN statusnya ON sistem_kasir.id_status = statusnya.id_status 
                JOIN payment ON sistem_kasir.id_payment = payment.id_payment 
                JOIN kota ON sistem_kasir.id_kota = kota.id_kota 
                JOIN sumber ON sistem_kasir.id_sumber = sumber.id_sumber";
        
                $query = mysqli_query($db, $sql);
                $no = 1;

                // Fetch all kasir data for the dropdown
                $kasir_sql = "SELECT id_kasir, nama FROM kasir";
                $kasir_query = mysqli_query($db, $kasir_sql);
                $kasir_options = [];
                while ($kasir_data = mysqli_fetch_assoc($kasir_query)) {
                    $kasir_options[] = $kasir_data;
                }

                // Fetch all status data for the dropdown
                $status_sql = "SELECT id_status, status FROM statusnya";
                $status_query = mysqli_query($db, $status_sql);
                $status_options = [];
                while ($status_data = mysqli_fetch_assoc($status_query)) {
                    $status_options[] = $status_data;
                }

                // Fetch all payment data for the dropdown
                $payment_sql = "SELECT id_payment, payment FROM payment";
                $payment_query = mysqli_query($db, $payment_sql);
                $payment_options = [];
                while ($payment_data = mysqli_fetch_assoc($payment_query)) {
                    $payment_options[] = $payment_data;
                }

                // Fetch all kota data for the dropdown
                $kota_sql = "SELECT id_kota, kota FROM kota";
                $kota_query = mysqli_query($db, $kota_sql);
                $kota_options = [];
                while ($kota_data = mysqli_fetch_assoc($kota_query)) {
                    $kota_options[] = $kota_data;
                }

                // Fetch all sumber data for the dropdown
                $sumber_sql = "SELECT id_sumber, sumber FROM sumber";
                $sumber_query = mysqli_query($db, $sumber_sql);
                $sumber_options = [];
                while ($sumber_data = mysqli_fetch_assoc($sumber_query)) {
                    $sumber_options[] = $sumber_data;
                }

                while($data = mysqli_fetch_array($query)){
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
                    echo "<td>".$data['customer']."</td>";
                    echo "<td>".$data['no_hp']."</td>";
                    echo "<td>".$data['alamat']."</td>";
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
                    echo "<td>".$data['id_produk']."</td>";
                    echo "<td>".$data['qty']."</td>";
                    echo "<td>".$data['harga_per_item']."</td>";
                    echo "<td>".$data['spending_total']."</td>";
                    echo "<td>".$data['discount']."</td>";
                    echo "<td>".$data['each_total']."</td>";
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
        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', function() {
                const id = this.dataset.id;
                const type = this.dataset.type;
                const value = this.value;
                
                // Send AJAX request to update the data
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'update_data.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                        showAlert(xhr.responseText);
                    }
                };
                xhr.send(`id=${id}&type=${type}&value=${value}`);
            });
        });

        function showAlert(message) {
            const alertContainer = document.getElementById('alert-container');
            const alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show';
            alertDiv.role = 'alert';
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
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
