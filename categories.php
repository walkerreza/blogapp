<?php
session_start();

// Data statis kategori
$categories = [
    [
        'id' => 1,
        'name' => 'Teknologi',
        'icon' => 'fas fa-laptop-code',
        'description' => 'Artikel tentang teknologi terbaru, pemrograman, dan perkembangan digital.'
    ],
    [
        'id' => 2,
        'name' => 'Seni',
        'icon' => 'fas fa-paint-brush',
        'description' => 'Artikel tentang seni, fotografi, desain, dan kreativitas.'
    ],
    [
        'id' => 3,
        'name' => 'Kuliner',
        'icon' => 'fas fa-utensils',
        'description' => 'Artikel tentang makanan, resep, dan tips memasak.'
    ],
    [
        'id' => 4,
        'name' => 'Travel',
        'icon' => 'fas fa-plane',
        'description' => 'Artikel tentang perjalanan, destinasi wisata, dan pengalaman traveling.'
    ]
];

// Data statis artikel per kategori
$articles_by_category = [
    1 => [ // Teknologi
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
            'id' => 5,
            'title' => 'Tren Teknologi 2025 yang Perlu Diketahui',
            'content' => 'Teknologi terus berkembang dengan cepat. Berikut adalah beberapa tren teknologi terbaru di tahun 2025 yang perlu Anda ketahui...',
            'image' => 'assets/img/article5.jpg',
            'category' => 'Teknologi',
            'author' => 'Ahmad Rizki',
            'created_at' => '2025-05-01 11:20:00',
            'views' => 175
        ]
    ],
    2 => [ // Seni
        [
            'id' => 2,
            'title' => 'Tips Fotografi untuk Pemula',
            'content' => 'Fotografi adalah seni menangkap momen. Bagi pemula, memahami dasar-dasar fotografi sangat penting untuk menghasilkan foto yang bagus...',
            'image' => 'assets/img/article2.jpg',
            'category' => 'Seni',
            'author' => 'Jane Smith',
            'created_at' => '2025-05-08 14:30:00',
            'views' => 85
        ]
    ],
    3 => [ // Kuliner
        [
            'id' => 3,
            'title' => 'Resep Masakan Tradisional Indonesia',
            'content' => 'Indonesia memiliki kekayaan kuliner yang luar biasa. Mari kita jelajahi beberapa resep masakan tradisional yang mudah dibuat di rumah...',
            'image' => 'assets/img/article3.jpg',
            'category' => 'Kuliner',
            'author' => 'Budi Santoso',
            'created_at' => '2025-05-05 09:15:00',
            'views' => 200
        ]
    ],
    4 => [ // Travel
        [
            'id' => 4,
            'title' => 'Destinasi Wisata Tersembunyi di Indonesia',
            'content' => 'Indonesia memiliki banyak tempat wisata yang belum banyak dikenal. Artikel ini akan membahas beberapa destinasi tersembunyi yang wajib dikunjungi...',
            'image' => 'assets/img/article4.jpg',
            'category' => 'Travel',
            'author' => 'Siti Nuraini',
            'created_at' => '2025-05-03 16:45:00',
            'views' => 150
        ]
    ]
];

// Ambil kategori dari URL
$category_id = isset($_GET['cat']) ? (int)$_GET['cat'] : 0;
$category_name = isset($_GET['name']) ? $_GET['name'] : '';

// Fungsi untuk format tanggal
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d F Y', $timestamp);
}

// Jika kategori ID valid, ambil artikel berdasarkan kategori
$articles = [];
if ($category_id > 0 && isset($articles_by_category[$category_id])) {
    $articles = $articles_by_category[$category_id];
    
    // Ambil nama kategori
    foreach ($categories as $cat) {
        if ($cat['id'] == $category_id) {
            $category_name = $cat['name'];
            break;
        }
    }
} 
// Jika nama kategori valid, cari ID dan ambil artikel
elseif (!empty($category_name)) {
    foreach ($categories as $cat) {
        if (strtolower($cat['name']) == strtolower($category_name)) {
            $category_id = $cat['id'];
            $category_name = $cat['name'];
            if (isset($articles_by_category[$category_id])) {
                $articles = $articles_by_category[$category_id];
            }
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo !empty($category_name) ? $category_name : 'Kategori'; ?> - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <?php if (!empty($category_name) && !empty($articles)): ?>
            <!-- Category Articles -->
            <section class="category-articles">
                <h1><?php echo $category_name; ?></h1>
                <div class="article-grid">
                    <?php foreach ($articles as $article): ?>
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
                </div>
            </section>
        <?php else: ?>
            <!-- All Categories -->
            <section class="all-categories">
                <h1>Semua Kategori</h1>
                <div class="category-grid">
                    <?php foreach ($categories as $category): ?>
                        <a href="categories.php?cat=<?php echo $category['id']; ?>" class="category-card">
                            <i class="<?php echo $category['icon']; ?>"></i>
                            <h3><?php echo $category['name']; ?></h3>
                            <p><?php echo $category['description']; ?></p>
                            <span class="article-count">
                                <?php echo isset($articles_by_category[$category['id']]) ? count($articles_by_category[$category['id']]) : 0; ?> artikel
                            </span>
                        </a>
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
