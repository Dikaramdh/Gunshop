<?php
include "./config/database.php";
// Fetch products from the database
$sql = "SELECT * FROM weapons";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - GunshopAbruzzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/product.css">
</head>
<body>
    <?php 
        include "./components/header.php";
    ?>

    <!-- Header -->
    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Temukan Produk Terbaik</h1>
            <p class="lead">Berbagai produk menarik hanya untuk Anda.</p>
        </div>
    </header>

    <!-- Produk -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Daftar Produk</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                // Loop through each product and display it
                while($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-4 mb-4">';
                    echo '<div class="card shadow-sm">';
                    echo '<img src="' . $row["image_url"] . '" class="card-img-top" alt="' . $row["name"] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row["name"] . '</h5>';
                    echo '<p class="card-text">' . $row["description"] . '. Harga: $ ' . number_format($row["price"], 0, ',', '.') . '</p>';
                    echo '<a href="detail_produk.php?id=' . $row["id"] . '" class="btn btn-primary">Detail Produk</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">Tidak ada produk tersedia.</p>';
            }
            ?>

        </div>
    </div>

    <?php
        include "./components/footer.php";
    ?>

</body>
</html>

