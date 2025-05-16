<?php
session_start();

// Fungsi untuk format tanggal
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d F Y', $timestamp);
}

// Data statis artikel
$articles = [
    1 => [
        'id' => 1,
        'title' => 'Cara Membuat Website dengan HTML dan CSS',
        'content' => '<p>HTML dan CSS adalah fondasi dasar untuk membuat website. Dalam artikel ini, kita akan membahas langkah-langkah dasar untuk membuat website sederhana menggunakan HTML dan CSS.</p>

<h2>Persiapan</h2>
<p>Sebelum mulai, pastikan Anda memiliki text editor seperti Visual Studio Code, Sublime Text, atau Notepad++. Tools ini akan membantu Anda menulis kode dengan lebih mudah.</p>

<h2>Struktur Dasar HTML</h2>
<p>Berikut adalah struktur dasar HTML yang perlu Anda ketahui:</p>
<pre>
&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;title&gt;Judul Website&lt;/title&gt;
    &lt;link rel="stylesheet" href="style.css"&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;h1&gt;Hello World!&lt;/h1&gt;
    &lt;p&gt;Ini adalah paragraf pertama saya.&lt;/p&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>

<h2>Dasar CSS</h2>
<p>CSS digunakan untuk memberikan style pada HTML. Berikut contoh CSS sederhana:</p>
<pre>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

h1 {
    color: #333;
}

p {
    line-height: 1.6;
}
</pre>

<p>Dengan menguasai dasar HTML dan CSS, Anda sudah bisa membuat website sederhana. Untuk pengembangan lebih lanjut, Anda bisa mempelajari JavaScript untuk menambahkan interaktivitas pada website Anda.</p>',
        'image' => 'assets/img/article1.jpg',
        'category' => 'Teknologi',
        'category_id' => 1,
        'author' => 'John Doe',
        'created_at' => '2025-05-10 10:00:00',
        'views' => 120,
        'tags' => 'html,css,web development'
    ],
    2 => [
        'id' => 2,
        'title' => 'Tips Fotografi untuk Pemula',
        'content' => '<p>Fotografi adalah seni menangkap momen. Bagi pemula, memahami dasar-dasar fotografi sangat penting untuk menghasilkan foto yang bagus.</p><p>Artikel lengkap tentang tips fotografi untuk pemula.</p>',
        'image' => 'assets/img/article2.jpg',
        'category' => 'Seni',
        'category_id' => 2,
        'author' => 'Jane Smith',
        'created_at' => '2025-05-08 14:30:00',
        'views' => 85,
        'tags' => 'fotografi,tips,pemula'
    ],
    3 => [
        'id' => 3,
        'title' => 'Resep Masakan Tradisional Indonesia',
        'content' => '<p>Indonesia memiliki kekayaan kuliner yang luar biasa. Mari kita jelajahi beberapa resep masakan tradisional yang mudah dibuat di rumah.</p><p>Artikel lengkap tentang resep masakan tradisional Indonesia.</p>',
        'image' => 'assets/img/article3.jpg',
        'category' => 'Kuliner',
        'category_id' => 3,
        'author' => 'Budi Santoso',
        'created_at' => '2025-05-05 09:15:00',
        'views' => 200,
        'tags' => 'kuliner,resep,masakan indonesia'
    ],
    4 => [
        'id' => 4,
        'title' => 'Destinasi Wisata Tersembunyi di Indonesia',
        'content' => '<p>Indonesia memiliki banyak tempat wisata yang belum banyak dikenal. Artikel ini akan membahas beberapa destinasi tersembunyi yang wajib dikunjungi.</p><p>Artikel lengkap tentang destinasi wisata tersembunyi di Indonesia.</p>',
        'image' => 'assets/img/article4.jpg',
        'category' => 'Travel',
        'category_id' => 4,
        'author' => 'Siti Nuraini',
        'created_at' => '2025-05-03 16:45:00',
        'views' => 150,
        'tags' => 'travel,wisata,indonesia'
    ],
    5 => [
        'id' => 5,
        'title' => 'Tren Teknologi 2025 yang Perlu Diketahui',
        'content' => '<p>Teknologi terus berkembang dengan cepat. Berikut adalah beberapa tren teknologi terbaru di tahun 2025 yang perlu Anda ketahui.</p><p>Artikel lengkap tentang tren teknologi 2025.</p>',
        'image' => 'assets/img/article5.jpg',
        'category' => 'Teknologi',
        'category_id' => 1,
        'author' => 'Ahmad Rizki',
        'created_at' => '2025-05-01 11:20:00',
        'views' => 175,
        'tags' => 'teknologi,tren,2025'
    ]
];

// Data statis komentar
$all_comments = [
    1 => [
        [
            'id' => 1,
            'username' => 'user123',
            'content' => 'Artikel yang sangat bermanfaat! Terima kasih atas informasinya.',
            'created_at' => '2025-05-12 08:30:00'
        ],
        [
            'id' => 2,
            'username' => 'webdev',
            'content' => 'Saya sudah mencoba tips ini dan hasilnya luar biasa. Sangat direkomendasikan!',
            'created_at' => '2025-05-13 14:15:00'
        ]
    ],
    2 => [
        [
            'id' => 3,
            'username' => 'photogeek',
            'content' => 'Tips yang bagus untuk pemula seperti saya. Akan saya coba tekniknya.',
            'created_at' => '2025-05-10 09:45:00'
        ]
    ],
    3 => [
        [
            'id' => 4,
            'username' => 'foodlover',
            'content' => 'Resepnya mudah diikuti dan hasilnya enak. Keluarga saya sangat menyukainya!',
            'created_at' => '2025-05-07 18:20:00'
        ],
        [
            'id' => 5,
            'username' => 'chef_amatir',
            'content' => 'Saya menambahkan sedikit variasi pada resepnya dan rasanya jadi lebih enak. Terima kasih atas inspirasinya!',
            'created_at' => '2025-05-08 11:10:00'
        ]
    ],
    4 => [],
    5 => [
        [
            'id' => 6,
            'username' => 'tech_enthusiast',
            'content' => 'Sangat menarik melihat perkembangan teknologi yang begitu cepat. Saya tidak sabar melihat apa yang akan datang selanjutnya.',
            'created_at' => '2025-05-02 16:30:00'
        ]
    ]
];

// Ambil ID artikel dari URL
$article_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Jika ID tidak valid, redirect ke halaman utama
if ($article_id <= 0 || !isset($articles[$article_id])) {
    header('Location: index.php');
    exit;
}

// Ambil data artikel
$article = $articles[$article_id];

// Ambil artikel terkait (artikel dengan kategori yang sama)
$related_articles = [];
foreach ($articles as $related) {
    if ($related['category_id'] == $article['category_id'] && $related['id'] != $article_id) {
        $related_articles[] = $related;
        if (count($related_articles) >= 3) break; // Maksimal 3 artikel terkait
    }
}

// Proses komentar jika ada
$comment_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        header('Location: login.php');
        exit;
    }
    
    $comment = trim($_POST['comment']);
    
    if (!empty($comment)) {
        // Simulasi penambahan komentar berhasil
        $comment_message = 'Komentar berhasil ditambahkan';
    } else {
        $comment_message = 'Komentar tidak boleh kosong';
    }
}

// Ambil komentar untuk artikel ini
$comments = isset($all_comments[$article_id]) ? $all_comments[$article_id] : [];
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
