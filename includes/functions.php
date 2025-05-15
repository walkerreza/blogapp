<?php
/**
 * File fungsi-fungsi untuk aplikasi blog
 * Berisi semua fungsi yang digunakan di seluruh aplikasi
 */

/**
 * Mengambil artikel terbaru dari database
 * 
 * @param PDO $conn Koneksi database
 * @param int $limit Jumlah artikel yang akan diambil
 * @return array Array berisi artikel terbaru
 */
function getLatestArticles($conn, $limit = 5) {
    try {
        $query = "SELECT a.*, u.username as author, c.name as category 
                 FROM articles a 
                 JOIN users u ON a.user_id = u.id 
                 JOIN categories c ON a.category_id = c.id 
                 WHERE a.status = 'published' 
                 ORDER BY a.created_at DESC 
                 LIMIT :limit";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error saat mengambil artikel terbaru: " . $e->getMessage());
        return [];
    }
}

/**
 * Mengambil artikel berdasarkan ID
 * 
 * @param PDO $conn Koneksi database
 * @param int $id ID artikel
 * @return array|false Data artikel atau false jika tidak ditemukan
 */
function getArticleById($conn, $id) {
    try {
        $query = "SELECT a.*, u.username as author, c.name as category 
                 FROM articles a 
                 JOIN users u ON a.user_id = u.id 
                 JOIN categories c ON a.category_id = c.id 
                 WHERE a.id = :id";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Error saat mengambil artikel: " . $e->getMessage());
        return false;
    }
}

/**
 * Mengambil artikel berdasarkan kategori
 * 
 * @param PDO $conn Koneksi database
 * @param string $category Nama kategori
 * @param int $limit Jumlah artikel yang akan diambil
 * @return array Array berisi artikel
 */
function getArticlesByCategory($conn, $category, $limit = 10) {
    try {
        $query = "SELECT a.*, u.username as author, c.name as category 
                 FROM articles a 
                 JOIN users u ON a.user_id = u.id 
                 JOIN categories c ON a.category_id = c.id 
                 WHERE c.name = :category AND a.status = 'published' 
                 ORDER BY a.created_at DESC 
                 LIMIT :limit";
        
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error saat mengambil artikel berdasarkan kategori: " . $e->getMessage());
        return [];
    }
}

/**
 * Format tanggal ke format yang lebih mudah dibaca
 * 
 * @param string $date Tanggal dalam format database
 * @return string Tanggal yang sudah diformat
 */
function formatDate($date) {
    $timestamp = strtotime($date);
    return date('d F Y', $timestamp);
}

/**
 * Sanitasi input untuk mencegah XSS
 * 
 * @param string $data Data yang akan disanitasi
 * @return string Data yang sudah disanitasi
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Membuat slug dari judul artikel
 * 
 * @param string $title Judul artikel
 * @return string Slug untuk URL
 */
function createSlug($title) {
    // Konversi ke lowercase dan hapus karakter khusus
    $slug = strtolower($title);
    $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
    // Ganti spasi dengan tanda hubung
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    // Trim tanda hubung di awal dan akhir
    $slug = trim($slug, '-');
    
    return $slug;
}

/**
 * Memeriksa apakah pengguna sudah login
 * 
 * @return bool True jika pengguna sudah login, false jika belum
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect ke halaman lain
 * 
 * @param string $location URL tujuan
 * @return void
 */
function redirect($location) {
    header("Location: $location");
    exit;
}
?>
