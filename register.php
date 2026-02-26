<?php
// Database Configuration
$servername = "localhost";
$username = "root";      // apna DB user
$password = "root";      // apna DB password
$dbname = "student_db";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get Data Safely
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $course = trim($_POST['course']);

    // Prepared Statement (Secure 🔐)
    $stmt = $conn->prepare("INSERT INTO students (fullname, email, phone, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $phone, $course);

    if ($stmt->execute()) {
        echo "<h2 style='color:green;'>Registration Successful ✅</h2>";
        echo "<a href='index.html'>Go Back</a>";
    } else {
        echo "<h2 style='color:red;'>Error: " . $stmt->error . "</h2>";
    }

    $stmt->close();
}

$conn->close();
?>