<?php
session_start();

include "./config/database.php";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the SQL query to fetch the user by username
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if a user with the username exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Password is correct, set session and redirect
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php"); // Redirect to a dashboard or home page
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Login gagal! Username atau password salah.'); window.location = 'login.php';</script>";
        }
    } else {
        // Username not found
        echo "<script>alert('Login gagal! Username atau password salah.'); window.location = 'login.php';</script>";
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
    <title>Login - GunshopAbruzzi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <?php 
        include "./components/header.php";
    ?>

    <!-- Login Form -->
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-form w-50">
            <form action="login.php" method="POST" class="bg-light shadow p-5 rounded">
                <h2 class="text-center mb-4">Jawa dilarang Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username Anda" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <div class="text-center mt-3">
                    <a href="register.php" class="text-primary">Belum punya akun? Daftar di sini</a>
                </div>
            </form>
        </div>
    </div>

    
    <?php
        include "./components/footer.php";
    ?>
    
</body>
</html>
