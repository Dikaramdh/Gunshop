<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - GunshopAbruzzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">GunshopAbruzzi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Tentang Kami</h1>
            <p class="lead">Kenali lebih dekat siapa kami dan visi kami untuk masa depan.</p>
        </div>
    </header>

    <div class="container my-5">
        <h2 class="text-center mb-4">Siapa Kami?</h2>
        <p class="text-justify">
            Kami adalah sekelompok mahasiswa informatika yang ditugaskan untuk membuat sebuah website, dimana tema dari website kami adalah sebuah platform jual beli yang simple mudah dan terpercaya pastinya.
            Berikut adalah daftar nama anggota kelompok kami:
        </p>
        <ul>
            <li>
                <img src="./assets/img/dkpp.jpg" alt="Dika Ramadhani" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                Dika Ramadhani
            </li>
            <li>
                <img src="./assets/img/kmst.jpg" alt="Kiemastiawan Gus Ardhika" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                Kiemastiawan Gus Ardhika
            </li>
            <li>
                <img src="./assets/img/syahdan.jpeg" alt="Bintang Syahdan Satrio" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                Bintang Syahdan Satrio
            </li>
            <li>
                <img src="./assets/img/akai.jpg" alt="Rafly Ananda Maulani" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                Rafly Ananda Maulani
            </li>
            <li>
                <img src="./assets/img/brian.jpg" alt="Briyan Anditia Rewur" class="rounded-circle" style="width: 50px; height: 50px; margin-right: 10px;">
                Briyan Anditia Rewur
            </li>
        </ul>
        

        <h2 class="text-center my-4">Visi dan Misi Kami</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Visi</h4>
                <p>
                    Menjadi toko senjata terkemuka yang mengutamakan keamanan, kualitas, dan inovasi dalam menyediakan berbagai pilihan senjata untuk kebutuhan profesional, koleksi, dan hobi, sambil berkontribusi pada penggunaan senjata yang bertanggung jawab dan aman.
                </p>
            </div>
            <div class="col-md-6">
                <h4>Misi</h4>
                <ul>
                    <li>Menawarkan senjata dan perlengkapan dengan kualitas terbaik dari merek-merek terpercaya di dunia.</li>
                    <li>Memastikan semua pelanggan memiliki akses ke panduan penggunaan senjata yang aman, termasuk pelatihan dan informasi hukum terkait.</li>
                    <li>Memberikan layanan pelanggan yang ramah, responsif, dan profesional untuk memastikan kepuasan pelanggan di setiap transaksi.</li>
                    <li>Mempromosikan penggunaan senjata yang bertanggung jawab melalui kampanye edukasi dan program komunitas..</li>
                </ul>
            </div>
        </div>

        <h2 class="text-center my-4">Mengapa Memilih Kami?</h2>
        <p class="text-justify">
            Dengan pengalaman bertahun-tahun dalam industri ini, kami memahami kebutuhan pengguna dan terus berinovasi untuk memberikan layanan terbaik. Dukungan 24/7 kami memastikan bahwa Anda dapat mengandalkan kami kapan saja. Keamanan dan kenyamanan pelanggan adalah prioritas utama kami.
        </p>
    </div>

    <?php
        include "./components/footer.php";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #1c1c1c;
            color: #f8f9fa;
        }
        .navbar {
            background-color: #600000;
        }
        .jumbotron {
            background: linear-gradient(135deg, #800000, #2c2c2c);
        }
        .jumbotron h1, .jumbotron p {
            color: #f8f9fa;
        }
        .list-group-item {
            background-color: transparent;
            border: none;
            color: #f8f9fa;
        }
        .rounded-circle {
            border: 2px solid #600000;
        }
        footer {
            background-color: #600000;
        }
        a {
            color: #e63946;
        }
        a:hover {
            color: #ff6b6b;
        }
    </style>
</body>
</html>
