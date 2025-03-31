<?php
session_start();

// Regenerate session ID to prevent fixation attacks
session_regenerate_id(true);

// Unset all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Remove session cookies
if (ini_get("session.use_cookies")) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// Redirect to login with a JavaScript-based history clear
echo "<script>
    sessionStorage.clear();
    localStorage.clear();
    window.location.href = 'admin-login.php';
</script>";
exit;
?>
