<?php
session_start();
include 'config/database.php';
include 'includes/functions.php';

// Ambil ID artikel dari URL
$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID tidak valid, redirect ke halaman utama
if ($article_id <= 0) {
    redirect('index.php');
}

// Ambil data artikel
$article = getArticleById($conn, $article_id);

// Jika artikel tidak ditemukan, redirect ke halaman utama
if (!$article) {
    redirect('index.php');
}

// Ambil artikel terkait
$related_articles = getRelatedArticles($conn, $article['category_id'], $article_id, 3);

// Proses komentar jika ada
$comment_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
    
    $comment = sanitizeInput($_POST['comment']);
    
    if (!empty($comment)) {
        try {
            $query = "INSERT INTO comments (article_id, user_id, content, created_at) 
                     VALUES (:article_id, :user_id, :content, NOW())";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
            $stmt->bindParam(':content', $comment);
            
            if ($stmt->execute()) {
                $comment_message = 'Komentar berhasil ditambahkan';
            } else {
                $comment_message = 'Gagal menambahkan komentar';
            }
        } catch(PDOException $e) {
            $comment_message = 'Terjadi kesalahan: ' . $e->getMessage();
        }
    } else {
        $comment_message = 'Komentar tidak boleh kosong';
    }
}

// Ambil komentar untuk artikel ini
$comments = getCommentsByArticleId($conn, $article_id);

// Tambah jumlah view
updateArticleViews($conn, $article_id);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title']; ?> - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta property="og:title" content="<?php echo $article['title']; ?>">
    <meta property="og:description" content="<?php echo substr(strip_tags($article['content']), 0, 160); ?>">
    <meta property="og:image" content="<?php echo $article['image']; ?>">
    <meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Article Content -->
        <div class="article-container">
            <div class="article-header">
                <div class="article-category"><?php echo $article['category']; ?></div>
                <h1><?php echo $article['title']; ?></h1>
                
                <div class="article-meta-top">
                    <span><i class="fas fa-user"></i> <?php echo $article['author']; ?></span>
                    <span><i class="fas fa-calendar"></i> <?php echo formatDate($article['created_at']); ?></span>
                    <span><i class="fas fa-eye"></i> <?php echo $article['views']; ?> kali dilihat</span>
                </div>
            </div>
            
            <div class="article-featured-image">
                <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>">
            </div>
            
            <div class="article-body">
                <?php echo $article['content']; ?>
                
                <?php if (!empty($article['tags'])): ?>
                    <div class="article-tags">
                        <?php 
                        $tags = explode(',', $article['tags']);
                        foreach ($tags as $tag): 
                        ?>
                            <a href="tag.php?tag=<?php echo trim($tag); ?>" class="tag"><?php echo trim($tag); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <div class="article-share">
                    <h3>Bagikan Artikel</h3>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" class="share-twitter"><i class="fab fa-twitter"></i></a>
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($article['title'] . ' - http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-whatsapp"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://telegram.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($article['title']); ?>" target="_blank" class="share-telegram"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Comments Section -->
            <div class="comments-section">
                <h3>Komentar (<?php echo count($comments); ?>)</h3>
                
                <?php if (!empty($comment_message)): ?>
                    <div class="alert <?php echo strpos($comment_message, 'berhasil') !== false ? 'alert-success' : 'alert-danger'; ?>">
                        <?php echo $comment_message; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <div class="comment-header">
                                <div class="comment-avatar">
                                    <img src="assets/img/avatar.jpg" alt="<?php echo $comment['username']; ?>">
                                </div>
                                <div class="comment-meta">
                                    <h4><?php echo $comment['username']; ?></h4>
                                    <div class="comment-date"><?php echo formatDate($comment['created_at']); ?></div>
                                </div>
                            </div>
                            <div class="comment-body">
                                <p><?php echo $comment['content']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                <?php endif; ?>
                
                <!-- Comment Form -->
                <?php if (isLoggedIn()): ?>
                    <div class="comment-form">
                        <h3>Tinggalkan Komentar</h3>
                        <form action="article.php?id=<?php echo $article_id; ?>" method="post">
                            <div class="form-group">
                                <textarea name="comment" class="form-control" rows="5" placeholder="Tulis komentar Anda di sini..." required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn">Kirim Komentar</button>
                            </div>
                        </form>
                    </div>
                <?php else: ?>
                    <p><a href="login.php">Login</a> untuk meninggalkan komentar.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Related Articles -->
        <?php if (!empty($related_articles)): ?>
            <section class="related-articles">
                <h2>Artikel Terkait</h2>
                <div class="article-grid">
                    <?php foreach ($related_articles as $related): ?>
                        <div class="article-card">
                            <div class="article-image">
                                <img src="<?php echo $related['image']; ?>" alt="<?php echo $related['title']; ?>">
                            </div>
                            <div class="article-content">
                                <div class="article-category"><?php echo $related['category']; ?></div>
                                <h3><a href="article.php?id=<?php echo $related['id']; ?>"><?php echo $related['title']; ?></a></h3>
                                <p class="article-excerpt"><?php echo substr(strip_tags($related['content']), 0, 120); ?>...</p>
                                <div class="article-meta">
                                    <span><i class="fas fa-user"></i> <?php echo $related['author']; ?></span>
                                    <span><i class="fas fa-calendar"></i> <?php echo formatDate($related['created_at']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
