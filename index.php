<?php
// Inisialisasi variabel awal agar form tidak error saat pertama kali dimuat
$persediaan_awal = $pembelian = $biaya_angkut = $retur = $potongan = $persediaan_akhir = "";
$pembelian_bersih = $hpp = null;

// Cek apakah tombol hitung sudah ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap inputan dan mengubahnya menjadi angka (float)
    $persediaan_awal  = (float) $_POST['persediaan_awal'];
    $pembelian        = (float) $_POST['pembelian'];
    $biaya_angkut     = (float) $_POST['biaya_angkut'];
    $retur            = (float) $_POST['retur'];
    $potongan         = (float) $_POST['potongan'];
    $persediaan_akhir = (float) $_POST['persediaan_akhir'];

    // Rumus 1: Menghitung Pembelian Bersih
    $pembelian_bersih = ($pembelian + $biaya_angkut) - ($retur + $potongan);

    // Rumus 2: Menghitung HPP
    $hpp = $persediaan_awal + $pembelian_bersih - $persediaan_akhir;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Hitung HPP</title>
    <!-- Menggunakan Bootstrap untuk tampilan yang modern dan responsif otomatis -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Kalkulator Harga Pokok Penjualan (HPP)</h4>
                </div>
                <div class="card-body p-4">
                    
                    <form method="POST" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Persediaan Awal (Rp)</label>
                                <input type="number" name="persediaan_awal" class="form-control" value="<?= $persediaan_awal ?>" required placeholder="Contoh: 5000000">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Pembelian (Rp)</label>
                                <input type="number" name="pembelian" class="form-control" value="<?= $pembelian ?>" required placeholder="Contoh: 15000000">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Beban/Biaya Angkut (Rp)</label>
                                <input type="number" name="biaya_angkut" class="form-control" value="<?= $biaya_angkut ?>" required placeholder="Isi 0 jika tidak ada">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Retur Pembelian (Rp)</label>
                                <input type="number" name="retur" class="form-control" value="<?= $retur ?>" required placeholder="Isi 0 jika tidak ada">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Potongan Pembelian (Rp)</label>
                                <input type="number" name="potongan" class="form-control" value="<?= $potongan ?>" required placeholder="Isi 0 jika tidak ada">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Persediaan Akhir (Rp)</label>
                                <input type="number" name="persediaan_akhir" class="form-control" value="<?= $persediaan_akhir ?>" required placeholder="Contoh: 4000000">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Hitung HPP</button>
                            <a href="hpp.php" class="btn btn-outline-secondary">Reset Form</a>
                        </div>
                    </form>

                    <?php if ($hpp !== null): ?>
                    <hr class="mt-4 mb-4">
                    <div class="alert alert-success border-0 shadow-sm text-center">
                        <h5 class="mb-3">Hasil Perhitungan</h5>
                        <div class="row text-start justify-content-center">
                            <div class="col-md-8">
                                <p class="mb-1 d-flex justify-content-between">
                                    <span>Pembelian Bersih:</span> 
                                    <strong>Rp <?= number_format($pembelian_bersih, 0, ',', '.') ?></strong>
                                </p>
                                <p class="mb-0 d-flex justify-content-between fs-5 text-primary">
                                    <span><strong>Total HPP:</strong></span> 
                                    <strong>Rp <?= number_format($hpp, 0, ',', '.') ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
