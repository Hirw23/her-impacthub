
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "mentorship_db");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
$interest = trim($_POST["interest"]);
$experience = trim($_POST["experience"]);

// Prepare SQL query to insert data safely
$sql = "INSERT INTO mentorship_applications (name, email, phone, interest, experience)
VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $phone, $interest, $experience);

if ($stmt->execute()) {
echo "Application submitted successfully!";
} else {
echo "Error: " . $stmt->error;
}

$stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Mentorship - HerImpactHub</title>
    <link rel="stylesheet" href="applym.css">
</head>
<body>
<header>
    <nav>
        <a href="index.html" class="logo">HerImpactHub</a>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="funding.html">Funding</a></li>
            <li><a href="mentorship.html">Mentorship</a></li>
            <li><a href="join.html" class="btn-join">Join Us</a></li>
        </ul>
    </nav>
</header>

<section class="apply-hero">
    <div class="apply-content">
        <h1>Apply for Mentorship</h1>
        <p>Take the next step in your career and personal growth by connecting with an experienced mentor.</p>
    </div>
</section>

<section class="apply-form">
    <h2>Mentorship Application Form</h2>
    <form method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="interest">Area of Interest:</label>
        <select id="interest" name="interest" required>
            <option value="Entrepreneurship">Entrepreneurship</option>
            <option value="Leadership">Leadership</option>
            <option value="Technology">Technology</option>
            <option value="Finance">Finance</option>
        </select>

        <label for="experience">Briefly Describe Your Background:</label>
        <textarea id="experience" name="experience" rows="4" required></textarea>

        <button type="submit" class="btn-apply">Submit Application</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 HerImpactHub. All rights reserved.</p>
</footer>
<script src="script.js"></script>
</body>
</html>
