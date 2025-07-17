<?php
$conn = new mysqli('localhost', 'root', '', 'jual_beli');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // If the username exists, show a message and don't insert
        $message = "Username sudah terdaftar. Silakan pilih username lain.";
    } else {
        // Hash the password for storage in the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert the user
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        // Execute the query and check for success
        if ($stmt->execute()) {
            // Redirect to kelpaimam/index.php after successful registration
            header("Location: index.php");
            exit(); // Ensure that no further code is executed after the redirect
        } else {
            $message = "Registrasi gagal! Terjadi kesalahan.";
        }
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Jual Beli</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="register-form w-50">
            <form action="register.php" method="POST" class="bg-light p-5 rounded">
                <h2 class="text-center mb-4">Register</h2>

                <!-- Display message if set -->
                <?php if ($message): ?>
                    <div class="alert alert-info"><?php echo $message; ?></div>
                <?php endif; ?>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-success btn-block">Register</button>
                <p class="mt-3 text-center">Already have an account? <a href="login.php">Login</a></p>
            </form>
        </div>
    </div>
    <style>
        body {
            background: linear-gradient(135deg, #2c2c2c, #6b0f1a);
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #3d070f;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .navbar-brand:hover, .nav-link:hover {
            color: #d9534f !important;
        }

        .register-form {
            background: #1e1e1e;
            border: 1px solid #6b0f1a;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            padding: 2rem;
        }

        .register-form h2 {
            color: #d9534f;
            text-shadow: 0 0 5px #6b0f1a;
        }

        .form-control {
            background: #2e2e2e;
            border: 1px solid #6b0f1a;
            color: #fff;
        }

        .form-control:focus {
            background: #2e2e2e;
            border-color: #d9534f;
            color: #fff;
            box-shadow: 0 0 5px #d9534f;
        }

        .btn-success {
            background: #d9534f;
            border: none;
        }

        .btn-success:hover {
            background: #a72c2c;
        }

        .text-primary {
            color: #d9534f !important;
        }

        .text-primary:hover {
            text-decoration: underline;
        }

        footer {
            background: #3d070f;
            color: #fff;
        }

        footer a {
            color: #d9534f !important;
        }
    </style>
</body>
</html>
