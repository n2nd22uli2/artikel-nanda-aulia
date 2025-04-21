<?php
// Include koneksi database
require_once 'db_connect.php';

// Mulai session
session_start();

// Cek apakah id artikel tersedia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$article_id = $_GET['id'];

// Query untuk mendapatkan detail artikel
$query = "
    SELECT 
        a.article_id,
        a.title,
        a.content,
        a.published_at,
        a.image_path,
        GROUP_CONCAT(DISTINCT au.name SEPARATOR ', ') AS authors,
        GROUP_CONCAT(DISTINCT c.name SEPARATOR ', ') AS categories
    FROM 
        article a
    LEFT JOIN 
        article_author aa ON a.article_id = aa.article_id
    LEFT JOIN 
        author au ON aa.author_id = au.author_id
    LEFT JOIN 
        article_category ac ON a.article_id = ac.article_id
    LEFT JOIN 
        category c ON ac.category_id = c.category_id
    WHERE 
        a.article_id = ? AND a.status = 'published'
    GROUP BY 
        a.article_id
";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $article_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Cek jika artikel tidak ditemukan
if (mysqli_num_rows($result) === 0) {
    header('Location: index.php');
    exit();
}

$article = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - Blog Dinamis</title>
    <link rel="stylesheet" href="styles/article.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Blog Dinamis</h1>
            <div class="user-section">
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="user-profile">
                        <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
                        <a href="add_article.php" class="btn">Tambah Artikel</a>
                        <a href="logout.php" class="btn">Logout</a>
                    </div>
                <?php else: ?>
                    <div class="auth-buttons">
                        <a href="login.php" class="btn btn-login">Login</a>
                        <a href="register.php" class="btn btn-register">Register</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="add_article.php">Tambah Artikel</a></li>
                <?php endif; ?>
                <li><a href="#">Kategori</a></li>
                <li><a href="#">Tentang</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <article class="single-article">
            <h2><?php echo htmlspecialchars($article['title']); ?></h2>
            
            <div class="article-meta">
                <span class="date">
                    <?php echo date('d F Y', strtotime($article['published_at'])); ?>
                </span>
                <span class="authors">
                    Oleh: <?php echo htmlspecialchars($article['authors'] ?? 'Penulis tidak diketahui'); ?>
                </span>
                <span class="categories">
                    Kategori: <?php echo htmlspecialchars($article['categories'] ?? 'Tidak terkategori'); ?>
                </span>
            </div>
            
            <?php if (!empty($article['image_path'])): ?>
                <div class="article-image">
                    <img src="<?php echo htmlspecialchars($article['image_path']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>">
                </div>
            <?php endif; ?>
            
            <div class="article-content">
                <?php 
                    // Convert newlines to <br> tags for better readability
                    echo nl2br(htmlspecialchars($article['content'])); 
                ?>
            </div>
            
            <a href="index.php" class="btn">Kembali ke Beranda</a>
        </article>
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