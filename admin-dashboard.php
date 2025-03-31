<?php
session_start();

 //Check if user is logged in
if (!isset($_SESSION['u_id'])) {
    header("Location:admin-login.php");
    exit();
}
// Database connection for funding applicants
$funding_conn = mysqli_connect("localhost", "root", "", "funding_db");
if (!$funding_conn) {
    die("Funding DB Connection failed: " . mysqli_connect_error());
}

// Database connection for mentorship applicants
$mentorship_conn = mysqli_connect("localhost", "root", "", "mentorship_db");
if (!$mentorship_conn) {
    die("Mentorship DB Connection failed: " . mysqli_connect_error());
}

// Database connection for signups
$signups_conn = mysqli_connect("localhost", "root", "", "admin");
if (!$signups_conn) {
    die("Signups DB Connection failed: " . mysqli_connect_error());
}
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>

<div class="header">
    <h1>Admin Dashboard</h1>
    <div class="nav-links">
        <a href="index.html" class="main-page-button">Main Page</a>
        <a href="admin-login.php" class="logout-button">Logout</a>
    </div>
</div>
<!-- Funding Applicants -->
<h2>Funding Applicants</h2>
<table id="fundingTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Amount Requested</th>

    </tr>
    </thead>
    <tbody>
    <?php
            $funding_result = mysqli_query($funding_conn, "SELECT name, email,funding_amount FROM funding_applications");
            while ($row = mysqli_fetch_assoc($funding_result)) {
                echo "<tr>
    <td>" . htmlspecialchars($row['name']) . "</td>
    <td>" . htmlspecialchars($row['email']) . "</td>
    <td>" . htmlspecialchars($row['funding_amount']) . "</td>

    </tr>";
    }
    ?>
    </tbody>
</table>

<!-- Mentorship Applicants -->
<h2>Mentorship Applicants</h2>
<table id="mentorshipTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Field of Interest</th>

    </tr>
    </thead>
    <tbody>
    <?php
            $mentorship_result = mysqli_query($mentorship_conn, "SELECT name, email,interest FROM mentorship_applications");
            while ($row = mysqli_fetch_assoc($mentorship_result)) {
                echo "<tr>
    <td>" . htmlspecialchars($row['name']) . "</td>
    <td>" . htmlspecialchars($row['email']) . "</td>
    <td>" . htmlspecialchars($row['interest']) . "</td>

    </tr>";
    }
    ?>
    </tbody>
</table>

<!-- New Signups -->
<h2>New Signups</h2>
<table id="signupsTable">
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
    </tr>
    </thead>
    <tbody>
    <?php
            $signups_result = mysqli_query($signups_conn, "SELECT name, email FROM users");
            while ($row = mysqli_fetch_assoc($signups_result)) {
                echo "<tr>
    <td>" . htmlspecialchars($row['name']) . "</td>
    <td>" . htmlspecialchars($row['email']) . "</td>
    </tr>";
    }
    ?>
    </tbody>
</table>

<?php
// Close database connections
mysqli_close($funding_conn);
mysqli_close($mentorship_conn);
mysqli_close($signups_conn);
?>

</body>
</html>
