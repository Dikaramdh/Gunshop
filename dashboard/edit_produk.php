<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Change if needed
$password = "";     // Change if needed
$dbname = "jual_beli";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product from the database
    $sql = "SELECT * FROM weapons WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Product found, fetch details
        $product = $result->fetch_assoc();
    } else {
        echo "<script>alert('Produk tidak ditemukan'); window.location='admin_dashboard.php';</script>";
        exit;
    }
    $stmt->close();
} else {
    echo "<script>alert('ID produk tidak ditemukan'); window.location='admin_dashboard.php';</script>";
    exit;
}

// Handle form submission (edit product)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle file upload (optional)
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // File upload logic
        $image = $_FILES['image'];
        $image_name = uniqid('prod_') . '-' . $image['name'];
        $image_tmp = $image['tmp_name'];
        $image_path = 'uploads/' . $image_name;

        // Move the uploaded file to the uploads folder
        if (move_uploaded_file($image_tmp, $image_path)) {
            $update_sql = "UPDATE weapons SET name = ?, description = ?, price = ?, image_url = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("ssisi", $name, $description, $price, $image_name, $product_id);
        } else {
            echo "<script>alert('Gagal mengunggah gambar');</script>";
            exit;
        }
    } else {
        // If no new image is uploaded, update the product without changing the image
        $update_sql = "UPDATE weapons SET name = ?, description = ?, price = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("ssii", $name, $description, $price, $product_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil diperbarui'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk');</script>";
    }
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="create_produk.php">Tambah Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Header -->
    <header class="jumbotron jumbotron-fluid text-center bg-info text-white mb-0">
        <div class="container">
            <h1 class="display-4">Edit Produk</h1>
            <p class="lead">Perbarui detail produk di bawah ini</p>
        </div>
    </header>

    <!-- Edit Product Form -->
    <div class="container my-5">
        <form action="edit_produk.php?id=<?php echo $product['id']; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>

            <div class="form-group">
                <label for="image">Gambar Produk (Opsional)</label>
                <input type="file" class="form-control-file" id="image" name="image">
                <small class="form-text text-muted">Biarkan kosong jika Anda tidak ingin mengubah gambar.</small>
            </div>

            <button type="submit" class="btn btn-success btn-block">Perbarui Produk</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 Jual Beli. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #1a1a1a;
            color: #f5f5f5;
        }
        .navbar {
            background-color: #660000;
        }
        .navbar-brand, .nav-link {
            color: #f5f5f5 !important;
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ff4d4d !important;
        }
        .jumbotron {
            background-color: #990000;
            color: #f5f5f5;
        }
        .btn-success {
            background-color: #660000;
            border-color: #660000;
        }
        .btn-success:hover {
            background-color: #990000;
            border-color: #990000;
        }
        .form-control, .form-control-file {
            background-color: #333;
            color: #f5f5f5;
            border: 1px solid #660000;
        }
        .form-control:focus {
            background-color: #333;
            color: #f5f5f5;
            border-color: #990000;
            box-shadow: none;
        }
        footer {
            background-color: #660000;
            color: #f5f5f5;
        }
    </style>
</body>
</html>
