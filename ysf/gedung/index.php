<?php
require 'dummy.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gedung Lima Rasa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <!-- header -->
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white shadow" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link text-white" href="#">Home</a>
          <a class="nav-link text-white" href="#">Tentang Kami</a>
          <a class="nav-link text-white" href="#">Transaksi</a>
        </div>
      </div>
    </div>
  </nav>

   <section class="banner py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6">
            <h1 class="fw-bold">Selamat datang di Gedung Lima Rasa Yeyy</h1>
            <p>Silahkan pilih tempat yang kami sediakan</p>
            <a href="#pesan" class="btn btn-primary">Lihat Harga</a>
          </div>
          <div class="col-md-6">
            <img src="img/banner.jpg" alt="banner" class="img-fluid">
          </div>
        </div>
      </div>
    </section>



  <div class="container mt-5">
    <section id="pesan">
      <section id="produk" class="container">
        <h2 class="text-center my-4">Produk</h2>
        <div class="row">
          <!-- Menampilkan daftar menggunakan perulangan dari array $ruang yang berasal dari dummy.php -->
          <?php foreach ($reservasi as $tempat) { ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <!-- Menampilkan gambar yang tersimpan pada array -->
                <img src="img/<?= $tempat[2]; ?>" class="card-img-top" alt="<?= $tempat[0]; ?>">
                <div class="card-body text-center">
                  <h5 class="card-title"><?= $tempat[0]; ?></h5>
                  <!-- Menampilkan harga yang diformat dengan pemisah ribuan -->
                  <p class="card-text">Harga: Rp <?= number_format($tempat[1], 0, ',', '.'); ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="text-center mt-4">
          <a href="pesan.php" class="mb-5 btn btn-primary">Pergi ke Halaman Transaksi</a>
        </div>
      </section>
    </section>

    <video width="100%" controls>
        <source src="vid/fortuner.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video.
    </video>

  </div>

  <section class="mt-5 text-center" id="tentang">
      <h2>Tentang Kami</h2>
      <p>📍 Alamat: Jl. Luxury Plum No.9, Bandung</p>
      <p>📞Telepon: 212-123456</p>
      <p>📧Email: info@gedunglimarasa.com</p>
    </section>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2025 Gedung Lima Rasa</p>
  </footer>
</body>

</html>