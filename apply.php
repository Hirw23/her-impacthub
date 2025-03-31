<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "funding_db");

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$business = trim($_POST["business"]);
$funding_amount = trim($_POST["funding-amount"]);
$description = trim($_POST["description"]);
$document_path = null;

// Handle file upload
if (!empty($_FILES["documents"]["name"])) {
$target_dir = "uploads/"; // Directory to store files
$file_name = basename($_FILES["documents"]["name"]);
$target_file = $target_dir . time() . "_" . $file_name; // Unique file name
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Allow only certain file formats
$allowed_types = ["pdf", "doc", "docx", "jpg", "png"];
if (in_array($file_type, $allowed_types)) {
if (move_uploaded_file($_FILES["documents"]["tmp_name"], $target_file)) {
$document_path = $target_file;
} else {
echo "Error uploading file.";
}
} else {
echo "Invalid file type. Only PDF, DOC, DOCX, JPG, and PNG are allowed.";
exit;
}
}

// Insert form data into the database
$sql = "INSERT INTO funding_applications (name, email, business, funding_amount, description, document_path)
VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $email, $business, $funding_amount, $description, $document_path);

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
    <title>Apply for Funding - HerImpactHub</title>
    <link rel="stylesheet" href="apply.css">
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
            <li><a href="join.html" class="btn">Join Us</a></li>
        </ul>
    </nav>
</header>

<section class="apply-hero">
    <div class="hero-content">
        <h1>Apply for Funding</h1>
        <p>Complete the application form below to be considered for funding opportunities.</p>
    </div>
</section>

<section class="apply-form">
    <form action="#" method="POST">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="business">Business Name (if applicable):</label>
        <input type="text" id="business" name="business">

        <label for="funding-amount">Requested Funding Amount:</label>
        <input type="number" id="funding-amount" name="funding-amount" required>

        <label for="description">Tell us about your business or project:</label>
        <textarea id="description" name="description" rows="5" required></textarea>

        <label for="documents">Upload Business Proposal or Supporting Documents:</label>
        <input type="file" id="documents" name="documents">

        <button type="submit" class="btn">Submit Application</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 HerImpactHub. All rights reserved.</p>
</footer>
</body>
</html>
