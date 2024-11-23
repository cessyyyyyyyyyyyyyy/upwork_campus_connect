<?php
session_start();
include('db_connection.php');

// Check if the user is logged in as a freelancer
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'freelancer') {
    echo "Unauthorized access.";
    header("Location: login.php");
    exit();
}

// Get freelancer ID from session
$freelancer_id = $_SESSION['user_id'];

// Fetch freelancer details from the database
$query = $conn->prepare("SELECT username, name, email FROM users WHERE id = ?");
$query->bind_param('i', $freelancer_id);
$query->execute();
$result = $query->get_result();

// Check if freelancer data exists
if ($result->num_rows > 0) {
    $freelancer = $result->fetch_assoc();
} else {
    echo "Freelancer not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Profile</title>
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
    justify-content: space-between; /* Ensures the button is on the right */
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

.profile-info {
    flex-grow: 1; /* Ensures profile info takes up available space */
}

.dashboard-btn a {
    background-color: #007bff;
    color: white;
    padding: 12px 20px;
    font-size: 16px;
    text-decoration: none;
    border-radius: 5px;
}

.dashboard-btn a:hover {
    background-color: #0056b3;
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
            <h1><?php echo htmlspecialchars($freelancer['username']); ?></h1>
            <p class="role">Freelancer</p>
            <p class="location"><?php echo htmlspecialchars($freelancer['email']); ?></p>
        </div>
        <div class="dashboard-btn">
        <a href="freelancer_dashboard.php" class="btn">Go to Dashboard</a>
    </div>
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
                    I am an experienced freelancer with expertise in various fields.
                </td>
            </tr>
            <tr>
                <td>Skills</td>
                <td contenteditable="true">
                    <ul>
                        <li>Graphic Design</li>
                        <li>Web Development</li>
                        <li>SEO Optimization</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Services Offered</td>
                <td contenteditable="true">
                    <ul>
                        <li>Logo Design - $30/hr</li>
                        <li>Website Development - $50/hr</li>
                        <li>Social Media Management - $25/hr</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Portfolio</td>
                <td><a href="#" contenteditable="true">View Portfolio</a></td>
            </tr>
            <tr>
                <td>Reviews</td>
                <td contenteditable="true">
                    <p>★★★★★ - "Exceptional work!" - Client A</p>
                    <p>★★★★☆ - "Great communication and results!" - Client B</p>
                </td>
            </tr>
            <tr>
                <td>Availability</td>
                <td contenteditable="true">Monday - Friday, 9 AM - 5 PM</td>
            </tr>
        </table>
    </div>
 
</div>

</body>
</html>
