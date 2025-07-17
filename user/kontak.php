<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - GunshopAbruzzi</title>
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
                        <a class="nav-link" href="about.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="kontak.php">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Hubungi Kami</h1>
            <p class="lead"> Jika anda ingin kedamaian bersiaplah untuk perang!!</p>
        </div>
    </header>

    <div class="container my-5">
        <h2 class="text-center mb-4">Kontak Kami</h2>
        <div class="row">
            <div class="col-md-12">
                <h4>Informasi Kontak</h4>
                <p>
                    <strong>Alamat:</strong> Location Unknown <br>
                    <strong>Telepon:</strong> +62 0387 3564 9998<br>
                    <strong>Email:</strong> support@GunshopAbruzzi.com
                </p>
                <h4>Jam Operasional</h4>
                <p>
                    Buka setiap hari <br>
                    Tutup hari kiamat 
                </p>
            </div>
        </div>
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
