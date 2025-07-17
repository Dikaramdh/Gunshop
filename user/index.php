<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GunshopAbruzzi - Halaman Utama</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
</head>
    <?php 
        include "./components/header.php";
    ?>

    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Selamat Datang di GunshopAbruzzi</h1>
            <p class="lead">Temukan dan jual produk terbaikmu di sini!</p>
            <a href="produk.php" class="btn btn-light btn-lg">Mulai Belanja</a>
        </div>
    </header>
    
    <div class="container my-5">
        <h2 class="text-center mb-4">Fitur Unggulan Kami</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Beragam Produk</h5>
                        <p class="card-text">Dapatkan berbagai produk menarik dari penjual terpercaya.</p>
                        <a href="produk.php" class="btn btn-primary">Lihat Produk</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Mudah dan Cepat</h5>
                        <p class="card-text">Proses jual beli yang simpel dengan sistem pembayaran aman.</p>
                        <a href="login.php" class="btn btn-primary">Masuk Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Support 24/7</h5>
                        <p class="card-text">Tim kami siap membantu kapan saja untuk pengalaman terbaik Anda.</p>
                        <a href="kontak.php" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include "./components/footer.php";
    ?>
    
</body>
</html>
