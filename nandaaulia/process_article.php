<?php
// Mulai session
session_start();

// Cek jika user belum login, redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Include koneksi database
require_once 'db_connect.php';

// Fungsi untuk membuat slug dari judul
function createSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string); // Hapus karakter non-alfanumerik
    $string = preg_replace('/\s+/', '-', $string); // Ganti spasi dengan tanda hubung
    $string = preg_replace('/-+/', '-', $string); // Hapus tanda hubung berulang
    return trim($string, '-');
}

// Cek jika form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $title = trim($_POST['title']);
    $excerpt = trim($_POST['excerpt']);
    $content = trim($_POST['content']);
    $status = $_POST['status'];
    $categories = isset($_POST['categories']) ? $_POST['categories'] : [];
    $author_id = $_POST['author_id'];
    
    // Validasi data
    if (empty($title) || empty($content)) {
        // Redirect kembali ke form dengan pesan error
        $_SESSION['error'] = 'Judul dan konten artikel wajib diisi.';
        header('Location: add_article.php');
        exit();
    }
    
    // Buat slug dari judul
    $slug = createSlug($title);
    
    // Cek apakah slug sudah digunakan
    $check_slug = "SELECT article_id FROM article WHERE slug = ?";
    $stmt_check = mysqli_prepare($conn, $check_slug);
    mysqli_stmt_bind_param($stmt_check, 's', $slug);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_store_result($stmt_check);
    
    if (mysqli_stmt_num_rows($stmt_check) > 0) {
        // Jika slug sudah ada, tambahkan timestamp
        $slug = $slug . '-' . time();
    }
    mysqli_stmt_close($stmt_check);
    
    // Set tanggal publikasi jika status published
    $published_at = ($status === 'published') ? date('Y-m-d H:i:s') : null;
    
    // Upload gambar jika ada
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Direktori untuk menyimpan gambar
        
        // Buat direktori jika belum ada
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Dapatkan informasi file
        $file_name = basename($_FILES['image']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Cek ekstensi file
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($file_ext, $allowed_exts)) {
            $_SESSION['error'] = 'Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.';
            header('Location: add_article.php');
            exit();
        }
        
        // Buat nama file unik untuk menghindari penimpaan
        $new_file_name = $slug . '-' . time() . '.' . $file_ext;
        $target_file = $upload_dir . $new_file_name;
        
        // Pindahkan file ke direktori upload
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = $target_file;
        } else {
            $_SESSION['error'] = 'Gagal mengupload gambar.';
            header('Location: add_article.php');
            exit();
        }
    }
    
    // Mulai transaksi database
    mysqli_begin_transaction($conn);
    
    try {
        // Masukkan artikel ke database
        $query = "INSERT INTO article (title, slug, content, excerpt, status, published_at, image_path) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssssss', $title, $slug, $content, $excerpt, $status, $published_at, $image_path);
        mysqli_stmt_execute($stmt);
        
        // Dapatkan ID artikel yang baru dibuat
        $article_id = mysqli_insert_id($conn);
        
        // Jika memilih sebagai penulis sendiri
        if ($author_id === 'user') {
            // Cek apakah user sudah terdaftar sebagai penulis
            $check_author = "SELECT author_id FROM author WHERE email = (SELECT email FROM user WHERE user_id = ?)";
            $stmt_check_author = mysqli_prepare($conn, $check_author);
            mysqli_stmt_bind_param($stmt_check_author, 'i', $_SESSION['user_id']);
            mysqli_stmt_execute($stmt_check_author);
            mysqli_stmt_store_result($stmt_check_author);
            
            if (mysqli_stmt_num_rows($stmt_check_author) > 0) {
                // Jika sudah ada, ambil author_id
                mysqli_stmt_bind_result($stmt_check_author, $user_author_id);
                mysqli_stmt_fetch($stmt_check_author);
            } else {
                // Jika belum, buat data penulis baru
                // Get user email
                $get_user = "SELECT username, email FROM user WHERE user_id = ?";
                $stmt_user = mysqli_prepare($conn, $get_user);
                mysqli_stmt_bind_param($stmt_user, 'i', $_SESSION['user_id']);
                mysqli_stmt_execute($stmt_user);
                $user_result = mysqli_stmt_get_result($stmt_user);
                $user_data = mysqli_fetch_assoc($user_result);
                
                // Insert into author table
                $insert_author = "INSERT INTO author (name, email, bio) VALUES (?, ?, 'Penulis blog')";
                $stmt_insert_author = mysqli_prepare($conn, $insert_author);
                mysqli_stmt_bind_param($stmt_insert_author, 'ss', $user_data['username'], $user_data['email']);
                mysqli_stmt_execute($stmt_insert_author);
                
                $user_author_id = mysqli_insert_id($conn);
                mysqli_stmt_close($stmt_insert_author);
            }
            
            mysqli_stmt_close($stmt_check_author);
            
            // Set author_id ke id penulis yang sesuai dengan user
            $author_id = $user_author_id;
        }
        
        // Tambahkan hubungan artikel dengan penulis
        $query_author = "INSERT INTO article_author (article_id, author_id) VALUES (?, ?)";
        $stmt_author = mysqli_prepare($conn, $query_author);
        mysqli_stmt_bind_param($stmt_author, 'ii', $article_id, $author_id);
        mysqli_stmt_execute($stmt_author);
        
        // Tambahkan hubungan artikel dengan kategori
        if (!empty($categories)) {
            $query_category = "INSERT INTO article_category (article_id, category_id) VALUES (?, ?)";
            $stmt_category = mysqli_prepare($conn, $query_category);
            
            foreach ($categories as $category_id) {
                mysqli_stmt_bind_param($stmt_category, 'ii', $article_id, $category_id);
                mysqli_stmt_execute($stmt_category);
            }
            
            mysqli_stmt_close($stmt_category);
        }
        
        // Commit transaksi
        mysqli_commit($conn);
        
        // Set pesan sukses
        $_SESSION['success'] = 'Artikel berhasil disimpan.';
        
        // Redirect ke halaman beranda atau detail artikel
        header('Location: index.php');
        exit();
        
    } catch (Exception $e) {
        // Rollback transaksi jika ada error
        mysqli_rollback($conn);
        
        // Set pesan error
        $_SESSION['error'] = 'Terjadi kesalahan: ' . $e->getMessage();
        header('Location: add_article.php');
        exit();
    }
}

// Jika tidak melalui form POST, redirect ke form tambah artikel
header('Location: add_article.php');
exit();
?>