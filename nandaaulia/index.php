<?php
// Include koneksi database
require_once 'db_connect.php';

// Mulai session
session_start();

// Query untuk menampilkan artikel dengan penulis dan kategori
$query = "
    SELECT 
        a.article_id,
        a.title,
        a.excerpt,
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
        a.status = 'published'
    GROUP BY 
        a.article_id
    ORDER BY 
        a.published_at DESC
";

$result = mysqli_query($conn, $query);

if (!$result) {
    echo "Error: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Dinamis</title>
    <link rel="stylesheet" href="styles/index.css">
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
        <?php if(isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        
        <section class="articles">
            <h2>Artikel Terbaru</h2>
            
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <article class="article-card">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        
                        <?php if (!empty($row['image_path'])): ?>
                            <div class="article-image">
                                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="article-meta">
                            <span class="date">
                                <?php echo date('d F Y', strtotime($row['published_at'])); ?>
                            </span>
                            <span class="authors">
                                Oleh: <?php echo htmlspecialchars($row['authors'] ?? 'Penulis tidak diketahui'); ?>
                            </span>
                            <span class="categories">
                                Kategori: <?php echo htmlspecialchars($row['categories'] ?? 'Tidak terkategori'); ?>
                            </span>
                        </div>
                        
                        <?php if (!empty($row['excerpt'])): ?>
                            <p class="excerpt"><?php echo htmlspecialchars($row['excerpt']); ?></p>
                        <?php else: ?>
                            <p class="excerpt"><?php echo substr(strip_tags($row['content']), 0, 150) . '...'; ?></p>
                        <?php endif; ?>
                        
                        <a href="article.php?id=<?php echo $row['article_id']; ?>" class="read-more">Baca Selengkapnya</a>
                    </article>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Belum ada artikel yang dipublikasikan.</p>
            <?php endif; ?>
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