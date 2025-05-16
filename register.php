<?php
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$errors = [];
$username = '';
$email = '';
$name = '';

// Proses form registrasi (hanya simulasi)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validasi input sederhana
    if (empty($username)) {
        $errors[] = 'Username wajib diisi';
    } elseif (strlen($username) < 3) {
        $errors[] = 'Username minimal 3 karakter';
    }
    
    if (empty($email)) {
        $errors[] = 'Email wajib diisi';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid';
    }
    
    if (empty($name)) {
        $errors[] = 'Nama lengkap wajib diisi';
    }
    
    if (empty($password)) {
        $errors[] = 'Password wajib diisi';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password minimal 6 karakter';
    }
    
    if ($password !== $confirm_password) {
        $errors[] = 'Konfirmasi password tidak cocok';
    }
    
    // Jika tidak ada error, simulasi registrasi berhasil
    if (empty($errors)) {
        // Untuk demo, kita anggap registrasi selalu berhasil
        $_SESSION['success_message'] = 'Registrasi berhasil! Silakan login dengan akun Anda.';
        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Register Form -->
        <div class="form-container">
            <h2>Daftar Akun Baru</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" data-min-length="6" required>
                    <small class="form-text">Password minimal 6 karakter</small>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Konfirmasi Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn" style="width: 100%;">Daftar</button>
                </div>
                
                <p class="text-center">Sudah punya akun? <a href="login.php">Masuk sekarang</a></p>
            </form>
        </div>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
