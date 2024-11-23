<?php
session_start();
include('db_connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'client') {
    echo "Unauthorized access.";
    header("Location: login.php");
    exit();
}

// Get client ID from session
$client_id = $_SESSION['user_id'];

// Fetch client details from the database
$query = $conn->prepare("SELECT username, name, email FROM users WHERE id = ?");
$query->bind_param('i', $client_id);
$query->execute();
$result = $query->get_result();

// Check if client data exists
if ($result->num_rows > 0) {
    $client = $result->fetch_assoc();
} else {
    echo "Client not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .profile-info h1,
        .profile-info p {
            margin: 5px 0;
        }

        .profile-info .role {
            font-style: italic;
            color: #888;
        }

        .profile-table table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .profile-table th, .profile-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .profile-table th {
            background-color: #f0f0f0;
            color: #333;
        }

        .profile-table td a {
            color: #007bff;
            text-decoration: none;
        }

        .profile-table td a:hover {
            text-decoration: underline;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        ul li {
            margin: 5px 0;
        }

        .post-job-btn {
            margin-top: 20px;
            text-align: center;
        }

        .post-job-btn .btn {
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }

        .post-job-btn .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="profile-container">
    <!-- Header Section -->
    <div class="header">
        <div class="profile-picture">
            <img src="profile-pic.jpg" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <h1><?php echo htmlspecialchars($client['username']); ?></h1>
            <p class="role">Client</p>
            <p class="location"><?php echo htmlspecialchars($client['email']); ?></p>
        </div>
    </div>

    <!-- Button to Post a New Job -->
    <div class="post-job-btn">
        <a href="post-job.php" class="btn">Post a Job</a>
    </div>

    <!-- Table Section -->
    <div class="profile-table">
        <table>
            <tr>
                <th>Section</th>
                <th>Details</th>
            </tr>
            <tr>
                <td>About Me</td>
                <td contenteditable="true">
                    Brief description of yourself as a client.
                </td>
            </tr>
            <tr>
                <td>Projects Posted</td>
                <td contenteditable="true">
                    <ul>
                        <li>Project 1: Web Design</li>
                        <li>Project 2: Mobile App Development</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Feedback Received</td>
                <td contenteditable="true">
                    <p>★★★★★ - "Great collaboration!" - Freelancer A</p>
                </td>
            </tr>
        </table>
    </div>

</div>

</body>
</html>
