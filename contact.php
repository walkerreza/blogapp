<?php
session_start();

$success_message = '';
$error_message = '';

// Proses form kontak (hanya simulasi)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Validasi input sederhana
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error_message = 'Semua bidang wajib diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Format email tidak valid';
    } else {
        // Simulasi pengiriman pesan berhasil
        $success_message = 'Pesan Anda berhasil dikirim. Kami akan segera menghubungi Anda.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-container">
                <div class="contact-info">
                    <h1>Hubungi Kami</h1>
                    <p>Jika Anda memiliki pertanyaan, saran, atau ingin berkolaborasi dengan kami, silakan isi formulir di samping atau hubungi kami melalui informasi kontak di bawah ini.</p>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h3>Alamat</h3>
                                <p>Jl. Kreatif No. 123, Jakarta, Indonesia</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h3>Email</h3>
                                <p>info@miniblogkreatif.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <h3>Telepon</h3>
                                <p>+62 812 3456 7890</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h3>Jam Kerja</h3>
                                <p>Senin - Jumat: 09:00 - 17:00</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <h3>Ikuti Kami</h3>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form">
                    <?php if (!empty($success_message)): ?>
                        <div class="alert alert-success">
                            <?php echo $success_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($error_message)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error_message; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="contact.php" method="post">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subjek</label>
                            <input type="text" id="subject" name="subject" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn">Kirim Pesan</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="map-container">
                <h2>Lokasi Kami</h2>
                <div class="map">
                    <!-- Placeholder untuk peta, dalam implementasi nyata bisa menggunakan Google Maps atau OpenStreetMap -->
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <p>Peta Lokasi</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
