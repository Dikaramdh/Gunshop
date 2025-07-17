<?php
include "./config/database.php";

// Get the product id from the URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the product details from the database
$sql = "SELECT * FROM weapons WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();

// Handle the form submission for order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_id = $_POST['product_id'];  // Product ID from hidden input
    $quantity = $_POST['quantity'];
    $address = $_POST['address'];
    $province = $_POST['province'];
    $city = $_POST['city'];
    $country = $_POST['country'];

    // Fetch the product price from the database
    $sql = "SELECT price FROM weapons WHERE id = $product_id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
    if (!$product) {
        echo "Product not found.";
        exit;
    }
    $price = $product['price'];

    // Calculate the total price
    $total_price = $quantity * $price;

    // Prepare the SQL query to insert the order
    $stmt = $conn->prepare("INSERT INTO orders (product_id, quantity, total_price, address, province, city, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iiissss", $product_id, $quantity, $total_price, $address, $province, $city, $country);
    
    // Execute the query and check if it was successful
    if ($stmt->execute()) {
        // Order inserted successfully
        echo "<script>alert('Order placed successfully!'); window.location.href = 'produk.php';</script>";
    } else {
        // Error inserting order
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - GunshopAbruzzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/detail.css">
</head>
<body>
    <?php
        include "./components/header.php";
    ?>

    <!-- Header -->
    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Detail Produk</h1>
            <p class="lead">Informasi lengkap mengenai produk yang Anda pilih.</p>
        </div>
    </header>

    <!-- Produk Detail -->
    <div class="container my-5">
        <?php if ($product): ?>
            <div class="row">
                <div class="col-md-6">
                    <img src="<?php echo $product["image_url"]; ?>" class="img-fluid" alt="<?php echo $product["name"]; ?>">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $product["name"]; ?></h2>
                    <p><strong>Deskripsi:</strong> <?php echo $product["description"]; ?></p>
                    <p><strong>Harga:</strong> $ <?php echo number_format($product["price"], 0, ',', '.'); ?></p>
                    <div class="button-desc">
                        <a href="produk.php" class="btn btn-secondary">Kembali ke Daftar Produk</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#orderModal">Buy</button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p>Produk tidak ditemukan.</p>
        <?php endif; ?>
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Form Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="address">Alamat Pengiriman</label>
                            <input type="text" class="form-control" id="address" name="address" required placeholder="Masukkan alamat pengiriman">
                        </div>
                        <div class="form-group">
                            <label for="province">Provinsi</label>
                            <input type="text" class="form-control" id="province" name="province" required placeholder="Masukkan provinsi">
                        </div>
                        <div class="form-group">
                            <label for="city">Kota</label>
                            <input type="text" class="form-control" id="city" name="city" required placeholder="Masukkan kota">
                        </div>
                        <div class="form-group">
                            <label for="country">Negara</label>
                            <input type="text" class="form-control" id="country" name="country" required placeholder="Masukkan negara">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Jumlah yang ingin dibeli</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" required placeholder="Masukkan jumlah" oninput="updateTotal()">
                        </div>
                        <div class="form-group">
                            <label for="total">Total Harga</label>
                            <input type="text" class="form-control" id="total" name="total" value="$ <?php echo number_format($product["price"], 0, ',', '.'); ?>" readonly>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 GunshopAbruzzi. All rights reserved.</p>
        <p><a href="privacy.html" class="text-white">Kebijakan Privasi</a> | <a href="terms.html" class="text-white">Syarat dan Ketentuan</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function updateTotal() {
            const price = <?php echo $product['price']; ?>;
            const quantity = document.getElementById('quantity').value;
            const total = price * quantity;
            document.getElementById('total').value = '$ ' + total.toLocaleString('id-ID');
        }
    </script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
