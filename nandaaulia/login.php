<!-- login.php  -->
<?php
// Mulai session
session_start();

// Cek jika user sudah login, redirect ke beranda
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Include koneksi database
require_once 'db_connect.php';

$error = '';

// Proses form login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Silakan masukkan username dan password.';
    } else {
        // Mencari user berdasarkan username
        $query = "SELECT user_id, username, password FROM user WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            // Verifikasi password
            if (password_verify($password, $row['password'])) {
                // Set session
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                
                // Redirect ke beranda
                header('Location: index.php');
                exit();
            } else {
                $error = 'Password yang dimasukkan salah.';
            }
        } else {
            $error = 'Username tidak ditemukan.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blog Dinamis</title>
    <link rel="stylesheet" href="styles/login.css">
</head>
<body>
    <div class="auth-container">
        <h2>Login</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <p class="auth-link">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
        <p class="auth-link"><a href="index.php">Kembali ke Beranda</a></p>
    </div>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>