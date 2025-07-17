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

// Admin Authentication Check (You can improve this part)


// Fetch all products for the dashboard
$sql = "SELECT * FROM weapons";
$result = $conn->query($sql);

// Handle delete product
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM weapons WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil dihapus'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus produk');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            <h1 class="display-4">Admin Dashboard</h1>
            <p class="lead">Kelola Produk Anda</p>
        </div>
    </header>

    <!-- Product Management -->
    <div class="container my-5">
        <h2>Daftar Produk</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Assuming the image is stored in 'uploads/' folder, adjust if needed
                        $image_path =  '../user/' . $row['image_url']; // Change this path as per your file structure
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['description']}</td>
                                <td>$ {$row['price']}</td>
                                <td><img src='{$image_path}' alt='{$row['name']}' width='100'></td>
                                <td>
                                    <a href='edit_produk.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='index.php?delete_id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada produk tersedia.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p class="mb-0">© 2024 GunshopAbruzzi. All rights reserved.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #2c2c2c, #6b0f1a);
            background-color: #2c2c2c;
            color: #ffffff;
        }

        .navbar {
            background: linear-gradient(135deg, #2c2c2c, #6b0f1a);
            background-color: #8b0000;
        }

        .navbar .navbar-brand {
            color: #ffffff;
        }

        .navbar .nav-link {
            color: #ffffff;
        }

        .jumbotron {
            background-color: #660000;
            color: #ffffff;
        }

        .btn {
            border: none;
        }

        .btn-primary {
            background-color: #8b0000;
        }

        .btn-warning {
            background-color: #d2691e;
        }

        .btn-danger {
            background-color: #b22222;
        }

        footer {
            background-color: #660000;
            color: #ffffff;
        }

        table {
            background-color: #333333;
        }

        table thead {
            background-color: #8b0000;
            color: #ffffff;
        }

        table tbody tr {
            color: #ffffff;
        }

        table tbody tr:nth-child(even) {
            background-color: #444444;
        }
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
        

    </style>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
