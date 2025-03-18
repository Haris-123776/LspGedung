<?php
// Daftar gedung beserta harga sewanya per hari
$gedung = [
    ["VIP", 10000000, "VIP.jpg"],
    ["Ballroom", 5000000, "/Ballroom.jpg"],
    ["Outdoor", 2000000, "Outdoor.jpg"]
];

// Inisialisasi variabel default
$pilih_gedung = $gedung[0][0]; // Gedung default yang dipilih
$pilih_harga = $gedung[0][1]; // Harga default gedung yang dipilih
$catering = false; // Default tidak memilih catering
$durasi = ''; // Durasi sewa belum diisi
$total_bayar = 0; // Default total bayar 0
$errors = []; // Array untuk menyimpan pesan kesalahan

// Mengecek apakah form telah dikirim (dengan metode POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data inputan dari form
    $pilih_gedung = $_POST['gedung'] ?? $gedung[0][0]; // Gedung yang dipilih
    $pilih_harga = array_column($gedung, 1, 0)[$pilih_gedung]; // Harga sesuai gedung yang dipilih
    $catering = isset($_POST['catering']); // Cek apakah checkbox catering dicentang
    $durasi = $_POST['durasi'] ?? ''; // Mengambil durasi yang diinputkan
    $identitas = $_POST['identitas'] ?? ''; // Mengambil nomor identitas pengguna

        // menegecek apakah durasi brupa angka, jika tidak maka akan muncu pesan error
    if (!is_numeric($durasi)) {
        $errors[] = "Durasi harus berupa angka lebih dari 0";
    }
        // mengecek apakah identitas berupa angka jika tidak maka akan muncul pesan error
    if (!is_numeric($_POST['identitas'])) {
        $errors[] = "Identitas harus berupa angka";
    }

        // strlen untuk menghitung jumlah karakter yang dinputkan pada input dengan name identitas
    if (strlen($_POST['identitas']) !== 16) {
        $errors[] = "Nomor Identitas harus 16 digit angka.";
    }

    // Jika tidak ada error validasi, hitung total pembayaran
    if (empty($errors)) {
        $total_harga_gedung = $pilih_harga * $durasi; // Hitung harga sewa mobil total

        // Memberikan diskon 10% jika durasi sewa 3 hari atau lebih
        $diskon = ($durasi >= 3) ? 0.1 * $total_harga_gedung : 0;

        // Biaya tambahan untuk catering jika dipilih (Rp 1.200.000 per hari)
        $biaya_catering = $catering ? 1200000 * $durasi : 0;

        // Total pembayaran akhir setelah diskon dan biaya catering
        $total_bayar = $total_harga_gedung - $diskon + $biaya_catering;
    }

    // Jika tombol "Simpan" ditekan, tampilkan pesan konfirmasi
    if (isset($_POST['simpan'])) {
        $diskon = ($durasi >= 3) ? 0.1 * $total_harga_gedung : 0;
        $check = $catering ? 'Ya' : 'Tidak'; // Cek apakah memilih catering
        $nama = $_POST['nama'];
        $identitas = $_POST['identitas'];
        $gender = $_POST['gender'];
        $gedung = $_POST['gedung'];

        // Membuat pesan konfirmasi pesanan
        $detail_pesanan = "Pesanan Berhasil!\n\n"
            . "Nama: $nama\n"
            . "Nomor Identitas: $identitas\n"
            . "Jenis Kelamin: $gender\n"
            . "Jenis Gedung: $pilih_gedung \n"
            . "catering: $check\n"
            . "Durasi: $durasi Hari\n"
            . "Diskon: Rp " . number_format($diskon, 0, ',', '.') . "\n"
            . "Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.');

        // Menampilkan alert dan mengarahkan kembali ke halaman utama
        echo "<script>
                alert(`$detail_pesanan`);
                window.location.href = 'index.php';
            </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white text-center">
                <h5>Form Pemesanan</h5>
            </div>
            <div class="card-body">
                <!-- Menampilkan error validasi jika ada -->
                <?php if ($errors) { ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach ($errors as $error) {
                                echo "<li>$error</li>";
                            } ?>
                        </ul>
                    </div>
                <?php } ?>

                <form method="POST">
                    <!-- Input Nama Pemesan -->
                    <input type="text" class="form-control mb-3" name="nama" placeholder="Nama Pemesan" value="<?= $_POST['nama'] ?? '' ?>" required>

                    <!-- Pilihan Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label><br>
                        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?= ($_POST['gender'] ?? '') === 'Laki-laki' ? 'checked' : '' ?>> Laki-laki
                        <input class="form-check-input ms-3" type="radio" name="gender" value="Perempuan" <?= ($_POST['gender'] ?? '') === 'Perempuan' ? 'checked' : '' ?>> Perempuan
                    </div>

                    <!-- Input Nomor Identitas -->
                    <input type="text" class="form-control mb-3" name="identitas" placeholder="Nomor Identitas (16 digit)" value="<?= $_POST['identitas'] ?? '' ?>" required>

                    <!-- Pilihan Mobil -->
                    <select class="form-select mb-3" name="gedung" onchange="this.form.submit()">
                        <?php foreach ($gedung as $nilai) { ?>
                            <option value="<?= $nilai[0] ?>" <?= ($nilai[0] === $pilih_gedung) ? 'selected' : '' ?>>
                                <?= $nilai[0] ?>
                            </option>
                        <?php } ?>
                    </select>

                    <!-- Input Harga Sewa (Readonly) -->
                    <input type="text" class="form-control mb-3" name="harga" value="<?= number_format($pilih_harga, 0, ',', '.') ?>" readonly>

                    <!-- Pilihan Tanggal Sewa -->
                    <input type="date" class="form-control mb-3" name="tanggal" value="<?= $_POST['tanggal'] ?? '' ?>" required>

                    <!-- Input Durasi Sewa -->
                    <input type="number" class="form-control mb-3" name="durasi" placeholder="Durasi Sewa (hari)" value="<?= $durasi ?>" required>

                    <!-- Checkbox Pilihan catering -->
                    <div class="mb-3">
                        <input class="form-check-input" type="checkbox" name="catering" <?= $catering ? 'checked' : '' ?>> Termasuk catering (Rp 1.200.000/hari)
                    </div>

                    <!-- Total Harga (Readonly) -->
                    <input type="text" class="form-control mb-3" value="<?= $total_bayar ? number_format($total_bayar, 0, ',', '.') : '' ?>" placeholder="Total Bayar" readonly>

                    <!-- Tombol Form -->
                    <button type="submit" class="btn btn-primary">Hitung Total</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                    <button type="reset" class="btn btn-danger">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
