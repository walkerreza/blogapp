<?php
session_start();

// Cek apakah pengguna sudah login
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$errors = [];
$username = '';

// Proses form login (hanya simulasi)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Validasi input sederhana
    if (empty($username)) {
        $errors[] = 'Username wajib diisi';
    }
    
    if (empty($password)) {
        $errors[] = 'Password wajib diisi';
    }
    
    // Jika tidak ada error, simulasi login berhasil
    if (empty($errors)) {
        // Untuk demo, kita anggap login selalu berhasil
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        
        // Redirect ke halaman utama
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Blog Kreatif</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <?php include 'includes/header.php'; ?>
        
        <!-- Login Form -->
        <div class="form-container">
            <h2>Masuk ke Akun Anda</h2>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="username">Username atau Email</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $username; ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn" style="width: 100%;">Masuk</button>
                </div>
                
                <p class="text-center">Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
                <p class="text-center"><a href="forgot-password.php">Lupa password?</a></p>
            </form>
        </div>
        
        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="assets/js/script.js"></script>
</body>
</html>
