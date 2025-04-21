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
$success = '';

// Proses form registrasi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi input
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Semua field harus diisi.';
    } elseif ($password !== $confirm_password) {
        $error = 'Password tidak cocok.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid.';
    } else {
        // Cek apakah username sudah dipakai
        $check_username = "SELECT user_id FROM user WHERE username = ?";
        $stmt = mysqli_prepare($conn, $check_username);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        // Cek apakah email sudah dipakai
        $check_email = "SELECT user_id FROM user WHERE email = ?";
        $stmt_email = mysqli_prepare($conn, $check_email);
        mysqli_stmt_bind_param($stmt_email, 's', $email);
        mysqli_stmt_execute($stmt_email);
        mysqli_stmt_store_result($stmt_email);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $error = 'Username sudah digunakan.';
        } elseif (mysqli_stmt_num_rows($stmt_email) > 0) {
            $error = 'Email sudah digunakan.';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user baru
            $insert_query = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
            $stmt_insert = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($stmt_insert, 'sss', $username, $email, $hashed_password);
            
            if (mysqli_stmt_execute($stmt_insert)) {
                $success = 'Registrasi berhasil! Silakan login.';
            } else {
                $error = 'Registrasi gagal: ' . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Blog Dinamis</title>
    <link rel="stylesheet" href="styles/register.css">
</head>
<body>
    <div class="auth-container">
        <h2>Register</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="success-message"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        
        <p class="auth-link">Sudah punya akun? <a href="login.php">Login</a></p>
        <p class="auth-link"><a href="index.php">Kembali ke Beranda</a></p>
    </div>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>