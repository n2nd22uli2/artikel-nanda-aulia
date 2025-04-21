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

// Query untuk mengambil kategori
$query_categories = "SELECT category_id, name FROM category";
$result_categories = mysqli_query($conn, $query_categories);

// Query untuk mengambil penulis (optional, jika ingin user memilih penulis)
$query_authors = "SELECT author_id, name FROM author";
$result_authors = mysqli_query($conn, $query_authors);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - Blog Dinamis</title>
    <link rel="stylesheet" href="styles/add_article.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Blog Dinamis</h1>
            <div class="user-section">
                <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
                <a href="logout.php">Logout</a>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="add_article.php">Tambah Artikel</a></li>
                <li><a href="#">Kategori</a></li>
                <li><a href="#">Tentang</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <section class="add-article">
            <h2>Tambah Artikel Baru</h2>
            
            <form action="process_article.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Judul Artikel</label>
                    <input type="text" id="title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="excerpt">Ringkasan (Excerpt)</label>
                    <textarea id="excerpt" name="excerpt" rows="3"></textarea>
                    <small>Ringkasan singkat artikel (opsional)</small>
                </div>
                
                <div class="form-group">
                    <label for="content">Konten Artikel</label>
                    <textarea id="content" name="content" rows="10" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="image">Gambar Artikel</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <small>Upload gambar untuk artikel (opsional)</small>
                </div>
                
                <div class="form-group">
                    <label>Kategori</label>
                    <?php while ($category = mysqli_fetch_assoc($result_categories)): ?>
                    <div class="checkbox-item">
                        <input type="checkbox" id="category_<?php echo $category['category_id']; ?>" 
                               name="categories[]" value="<?php echo $category['category_id']; ?>">
                        <label for="category_<?php echo $category['category_id']; ?>">
                            <?php echo htmlspecialchars($category['name']); ?>
                        </label>
                    </div>
                    <?php endwhile; ?>
                </div>
                
                <div class="form-group">
                    <label>Penulis</label>
                    <?php while ($author = mysqli_fetch_assoc($result_authors)): ?>
                    <div class="radio-item">
                        <input type="radio" id="author_<?php echo $author['author_id']; ?>" 
                               name="author_id" value="<?php echo $author['author_id']; ?>">
                        <label for="author_<?php echo $author['author_id']; ?>">
                            <?php echo htmlspecialchars($author['name']); ?>
                        </label>
                    </div>
                    <?php endwhile; ?>
                    <div class="radio-item">
                        <input type="radio" id="author_user" name="author_id" value="user" checked>
                        <label for="author_user">
                            Saya sebagai penulis (<?php echo htmlspecialchars($_SESSION['username']); ?>)
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status">Status Publikasi</label>
                    <select id="status" name="status">
                        <option value="published">Terbitkan sekarang</option>
                        <option value="draft">Simpan sebagai draft</option>
                    </select>
                </div>
                
                <button type="submit">Simpan Artikel</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Blog Dinamis - Nanda Aulia</p>
    </footer>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>