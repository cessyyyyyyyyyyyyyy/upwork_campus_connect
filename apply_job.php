<?php
session_start();  // Start the session

// Include the database connection
include('db_connection.php');
$host = 'localhost';        // Database host
$user = 'root';             // Database username
$password = '';             // Database password (empty for local default)
$dbname = 'upwork_campus_connect';  // Database name

// Create a new connection
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check if the connection is successful
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in (session should have a user ID)
    if (isset($_SESSION['user_id'])) {
        $freelancer_id = $_SESSION['user_id'];  // Get freelancer ID from session
        $job_id = $_POST['job_id'];  // Get the job ID from the form

        // Prepare SQL query to insert application into the database
        if ($stmt = $mysqli->prepare("INSERT INTO applications (freelancer_id, job_id, status) VALUES (?, ?, 'active')")) {
            // Bind parameters ('ii' means two integers)
            $stmt->bind_param('ii', $freelancer_id, $job_id);

            // Execute the statement and check for success
            if ($stmt->execute()) {
                echo "Applied successfully!";
            } else {
                echo "Error executing query: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            echo "Error preparing query: " . $mysqli->error;
        }
    } else {
        echo "You must be logged in to apply for a job.";
    }
}
?>
