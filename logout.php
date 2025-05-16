<?php
session_start();

// Hapus semua data session
$_SESSION = array();

// Hapus cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

// Set pesan sukses logout
$_SESSION['success_message'] = 'Anda berhasil logout.';

// Redirect ke halaman utama
header("Location: index.php");
exit;
?>
