<?php
session_start();
$conn = new mysqli("localhost", "root", "", "admin");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = mysqli_real_escape_string($conn, $_POST["email"]);
$password = mysqli_real_escape_string($conn, $_POST["password"]);

// Fetch user details
$sql = "SELECT u_id,name, email, password FROM users WHERE email = '$name' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$_SESSION["u_id"] = $row["u_id"];
$_SESSION["email"] = $row["email"];
//echo "Login successful! Welcome, " . htmlspecialchars($row["name"]) . "!";
header("Location:admin-dashboard.php");
} else {
echo "Invalid username or password.";
}
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HerImpactHub</title>
    <link rel="stylesheet" href="adminstyle.css">

</head>
<body>
<div class="login-container">
    <h2>Admin Login</h2>
    <form id="admin-login-form" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>

        <button type="submit" class="btn">Login</button>
    </form>
    <p id="error-message" class="error-message"></p>
</div>

</body>
<script>
    history.pushState(null, null, location.href);
    window.onpopstate = function () {
        history.go(1);
    };
</script>
</html>
