<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    // Get form data
    $client_name = $_POST['client_name'];
    $rating = $_POST['rating'];
    $review_text = $_POST['review_text'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'upwork_campus_connect');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert review into the testimonials table
    $stmt = $conn->prepare("INSERT INTO testimonials (client_name, rating, review_text) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $client_name, $rating, $review_text); // s for string, i for integer
    $stmt->execute();

    // Close connection
    $stmt->close();
    $conn->close();

    // Redirect to avoid form resubmission on refresh
    header("Location: client_dashboard.php");
    exit();
}
?>
