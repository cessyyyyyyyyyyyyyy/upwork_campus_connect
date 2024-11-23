<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "upwork_campus_connect"; // Change to your database name

    // Create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data and sanitize it
    $title = $_POST['title'];
    $category = $_POST['category'];
    $budget = $_POST['budget'];
    $description = $_POST['description'];

    // Check if any value is empty and handle accordingly
    if (empty($title) || empty($category) || empty($budget) || empty($description)) {
        echo "Please fill in all fields.";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO jobs (title, category, budget, description) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $title, $category, $budget, $description); // 'ssds' means string, string, decimal, string

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to home page after posting
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();
}
?>
