<?php
// Data array untuk menyimpan informasi sewa gedung
$gedung = [
    ["VIP", 10000000, "VIP.jpg"],
    ["Ballroom", 5000000, "/Ballroom.jpg"],
    ["Outdoor", 2000000, "Outdoor.jpg"]
];
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sewa Gedung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk kartu produk */
        .product-card {
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Styling untuk gambar di kartu produk */
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        /* Styling untuk gambar di carousel */
        .carousel-item img {
            height: 450px;
            object-fit: cover;
        }

        /* Styling tombol pesan */
        .pesan-btn-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Sewa Gedung</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#produk">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">Tentang Kami</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel untuk tampilan gambar gedung -->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/VIP.jpg" class="d-block w-100" alt="VIP">
                <div class="carousel-caption d-none d-md-block">
                    <h5>VIP</h5>
                    <p>Rp. 10.000.000 /malam</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/Ballroom.jpg" class="d-block w-100" alt="Ballroom">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Ballroom</h5>
                    <p>Rp. 5.000.000</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/Outdoor.jpg" class="d-block w-100" alt="Outdoor">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Outdoor</h5>
                    <p>Rp. 2.000.000</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Bagian daftar gedung -->
    <div class="container mt-5">
        <section id="produk">
            <h2 class="text-center">Daftar Gedung</h2>
            <div class="row">
                <?php foreach ($gedung as $nilai) { ?>
                    <div class="col-md-4">
                        <div class="product-card">
                            <img src="img/<?= $nilai[2] ?>" alt="<?= $nilai[0] ?>">
                            <h5 class="mt-2"> <?= $nilai[0] ?> </h5>
                            <h5 class="mt-2">Rp <?= $nilai[1] ?></h5>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>
    </div>

    <!-- Tombol pesan -->
    <div class="pesan-btn-container">
        <a href="transaksi.php" class="btn btn-lg btn-success">Pesan Sekarang</a>
    </div>

    <!-- Bagian video gedung -->
    <div class="container mt-4 text-center">
        <h3>Video Gedung</h3>
        <video width="100%" controls>
            <source src="img/gedung.mp4" type="video/mp4">
            Browser Anda tidak mendukung tag video.
        </video>
    </div>


    <script>
        // Script untuk mengubah ukuran video menggunakan slider
        function resizeVideo() {
            let video = document.getElementById("videoPlayer");
            let widthSlider = document.getElementById("videoWidth");
            let widthValue = document.getElementById("widthValue");

            video.style.width = widthSlider.value + "px";
            widthValue.innerText = widthSlider.value;
        }
    </script>

    <!-- Bagian tentang kami -->
    <div class="container mt-5">
        <section id="tentang">
            <div class="card shadow-lg">
                <div class="card-body text-center">
                    <h2 class="card-title">Tentang Kami</h2>
                    <p>Selamat datang di <strong>Rental Kami</strong>, penyedia layanan sewa gedung</p>
                    <p><strong>📍 Alamat:</strong> Jalan S.farman 123</p>
                    <p><strong>📞 Telepon:</strong> <a href="tel:+62895383875089">+62455483874079</a></p>
                    <p><strong>📧 Email:</strong> <a href="mailto:rentalkami@gmail.com">sewagedung@gmail.com</a></p>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2025 M.Haris Saputra.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>