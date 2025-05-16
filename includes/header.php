<header class="main-header">
    <div class="logo">
        <a href="index.php">Mini Blog Kreatif</a>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="categories.php">Kategori</a></li>
            <li><a href="about.php">Tentang</a></li>
            <li><a href="contact.php">Kontak</a></li>
        </ul>
    </nav>
    <div class="user-menu">
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <div class="dropdown">
                <button class="dropdown-btn">
                    <i class="fas fa-user-circle"></i> 
                    <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Pengguna'; ?>
                </button>
                <div class="dropdown-content">
                    <a href="profile.php">Profil</a>
                    <a href="my-articles.php">Artikel Saya</a>
                    <a href="logout.php">Keluar</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="btn btn-sm">Masuk</a>
            <a href="register.php" class="btn btn-sm btn-outline">Daftar</a>
        <?php endif; ?>
    </div>
    <div class="mobile-menu-toggle">
        <i class="fas fa-bars"></i>
    </div>
</header>
