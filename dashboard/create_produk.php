<?php
// Connect to the database
$servername = "localhost";
$username = "root";  // Change this if necessary
$password = "";      // Change this if necessary
$dbname = "jual_beli";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    
    // Handle image upload
    $image_url = "";
    if (isset($_FILES["image_url"]) && $_FILES["image_url"]["error"] == 0) {
        $allowed_types = ["image/jpeg", "image/png", "image/gif"];
        $file_type = $_FILES["image_url"]["type"];
        
        // Check if the file type is allowed
        if (in_array($file_type, $allowed_types)) {
            $file_name = $_FILES["image_url"]["name"];
            $file_tmp = $_FILES["image_url"]["tmp_name"];
            $file_size = $_FILES["image_url"]["size"];

            // Check if the file size is below the 2MB limit
            if ($file_size <= 2 * 1024 * 1024) {
                // Create a unique file name to avoid conflicts
                $unique_file_name = uniqid('prod_', true) . "-" . basename($file_name);
                $target_dir = "uploads/";

                // Check if the upload directory exists, if not, create it
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $target_file = $target_dir . $unique_file_name;
                
                // Move the file to the server's directory
                if (move_uploaded_file($file_tmp, $target_file)) {
                    $image_url = $target_file; // Store the file path in the database
                } else {
                    $message = "Gagal mengunggah gambar.";
                }
            } else {
                $message = "Ukuran file terlalu besar. Maksimal 2MB.";
            }
        } else {
            $message = "Tipe file tidak diperbolehkan. Hanya JPEG, PNG, dan GIF yang diperbolehkan.";
        }
    } else {
        $message = "Harap unggah gambar produk.";
    }

    // Insert product into the database if no errors
    if ($image_url && empty($message)) {
        $stmt = $conn->prepare("INSERT INTO weapons (name, description, price, image_url) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $name, $description, $price, $image_url);

        if ($stmt->execute()) {
            $message = "Produk berhasil ditambahkan!";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - GunshopAbruzzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../user/assets/css/create.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">GunshopAbruzzi</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <!-- Header -->
    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Tambah Produk</h1>
            <p class="lead">Form untuk menambahkan produk baru ke dalam toko.</p>
        </div>
    </header>

    <!-- Form to add product -->
    <div class="container my-5">
        <h2>Form Tambah Produk</h2>
        
        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi Produk</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Harga Produk</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="image_url">Gambar Produk</label>
                <input type="file" class="form-control" id="image_url" name="image_url" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambahkan Produk</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 GunshopAbruzzi. All rights reserved.</p>
        <p><a href="privacy.html" class="text-white">Kebijakan Privasi</a> | <a href="terms.html" class="text-white">Syarat dan Ketentuan</a></p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
