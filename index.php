<?php
session_start();

// Data statis untuk artikel terbaru
$articles = [
    [
        'id' => 1,
        'title' => 'Cara Membuat Website dengan HTML dan CSS',
        'content' => 'HTML dan CSS adalah fondasi dasar untuk membuat website. Dalam artikel ini, kita akan membahas langkah-langkah dasar untuk membuat website sederhana menggunakan HTML dan CSS...',
        'image' => 'assets/img/article1.jpg',
        'category' => 'Teknologi',
        'author' => 'John Doe',
        'created_at' => '2025-05-10 10:00:00',
        'views' => 120
    ],
    [
        'id' => 2,
        'title' => 'Tips Fotografi untuk Pemula',
        'content' => 'Fotografi adalah seni menangkap momen. Bagi pemula, memahami dasar-dasar fotografi sangat penting untuk menghasilkan foto yang bagus...',
        'image' => 'assets/img/article2.jpg',
        'category' => 'Seni',
        'author' => 'Jane Smith',
        'created_at' => '2025-05-08 14:30:00',
        'views' => 85
    ],
    [
        'id' => 3,
        'title' => 'Resep Masakan Tradisional Indonesia',
        'content' => 'Indonesia memiliki kekayaan kuliner yang luar biasa. Mari kita jelajahi beberapa resep masakan tradisional yang mudah dibuat di rumah...',
        'image' => 'assets/img/article3.jpg',
        'category' => 'Kuliner',
        'author' => 'Budi Santoso',
        'created_at' => '2025-05-05 09:15:00',
        'views' => 200
    ],
    [
        'id' => 4,
        'title' => 'Destinasi Wisata Tersembunyi di Indonesia',
        'content' => 'Indonesia memiliki banyak tempat wisata yang belum banyak dikenal. Artikel ini akan membahas beberapa destinasi tersembunyi yang wajib dikunjungi...',
        'image' => 'assets/img/article4.jpg',
        'category' => 'Travel',
        'author' => 'Siti Nuraini',
        'created_at' => '2025-05-03 16:45:00',
        'views' => 150
    ],
    [
        'id' => 5,
        'title' => 'Tren Teknologi 2025 yang Perlu Diketahui',
        'content' => 'Teknologi terus berkembang dengan cepat. Berikut adalah beberapa tren teknologi terbaru di tahun 2025 yang perlu Anda ketahui...',
        'image' => 'assets/img/article5.jpg',
        'category' => 'Teknologi',
        'author' => 'Ahmad Rizki',
        'created_at' => '2025-05-01 11:20:00',
        'views' => 175
    ]
];

// Fungsi untuk format tanggal
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d F Y', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Hero Section -->
        <div class="hero">
            <div class="hero-content">
                <h1>Selamat Datang di Mini Blog Kreatif</h1>
                <p>Temukan inspirasi dan ide-ide kreatif untuk keseharianmu</p>
                <?php if(!isset($_SESSION['user_id'])): ?>
                    <a href="login.php" class="btn">Masuk</a>
                    <a href="register.php" class="btn btn-outline">Daftar</a>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Featured Articles -->
        <section class="featured-articles">
            <h2>Artikel Terbaru</h2>
            <div class="article-grid">
                <?php if($articles): ?>
                    <?php foreach($articles as $article): ?>
                        <div class="article-card">
                            <div class="article-image">
                                <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>">
                            </div>
                            <div class="article-content">
                                <div class="article-category"><?php echo $article['category']; ?></div>
                                <h3><a href="article.php?id=<?php echo $article['id']; ?>"><?php echo $article['title']; ?></a></h3>
                                <p class="article-excerpt"><?php echo substr($article['content'], 0, 120); ?>...</p>
                                <div class="article-meta">
                                    <span><i class="fas fa-user"></i> <?php echo $article['author']; ?></span>
                                    <span><i class="fas fa-calendar"></i> <?php echo formatDate($article['created_at']); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Belum ada artikel yang tersedia.</p>
                <?php endif; ?>
            </div>
        </section>
        
        <!-- Categories Section -->
        <section class="categories">
            <h2>Kategori</h2>
            <div class="category-grid">
                <a href="category.php?cat=teknologi" class="category-card">
                    <i class="fas fa-laptop-code"></i>
                    <h3>Teknologi</h3>
                </a>
                <a href="category.php?cat=seni" class="category-card">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Seni</h3>
                </a>
                <a href="category.php?cat=kuliner" class="category-card">
                    <i class="fas fa-utensils"></i>
                    <h3>Kuliner</h3>
                </a>
                <a href="category.php?cat=travel" class="category-card">
                    <i class="fas fa-plane"></i>
                    <h3>Travel</h3>
                </a>
            </div>
        </section>
        
        <!-- Newsletter -->
        <section class="newsletter">
            <h2>Berlangganan Newsletter</h2>
            <p>Dapatkan update artikel terbaru langsung ke email Anda</p>
            <form action="subscribe.php" method="post" class="newsletter-form">
                <input type="email" name="email" placeholder="Masukkan email Anda" required>
                <button type="submit" class="btn">Berlangganan</button>
            </form>
        </section>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
