<?php
session_start();
include 'db_connection.php';  // Include your database connection

// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upwork_campus_connect"; // Update your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize $result_active_jobs to null
$result_active_jobs = null;

// Query to get active jobs
$query = "SELECT j.title, c.name AS client, a.status, j.deadline
          FROM jobs j
          JOIN applications a ON j.id = a.job_id
          JOIN clients c ON j.client_id = c.id
          WHERE a.freelancer_id = ? AND a.status = 'active'";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $freelancer_id);
    $stmt->execute();

    // Assign query result to $result_active_jobs
    $result_active_jobs = $stmt->get_result();
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close the database connection
$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Example</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <h2>My Dashboard</h2>
        </div>
        <nav>
            <ul>
                <li><a href="#overview" class="sidebar-link active">Overview</a></li>
                <li><a href="#notifications" class="sidebar-link">Notifications</a></li>
                <li><a href="#jobs" class="sidebar-link">Active Jobs</a></li>
                <li><a href="#postajob" class="sidebar-link">Post A Job</a></li>
                <li><a href="#proposals" class="sidebar-link">Proposals</a></li>
                <li><a href="#earnings" class="sidebar-link">Earnings</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Overview Section -->
        <section id="overview" class="section active">
            <h3>Overview</h3>
            <div class="metrics">
                <div class="metric">
                    <h4>Total Earnings</h4>
                    <p>$1,200</p>
                </div>
                <div class="metric">
                    <h4>Active Jobs</h4>
                    <p>3</p>
                </div>
                <div class="metric">
                    <h4>Proposals Submitted</h4>
                    <p>5</p>
                </div>
                <div class="metric">
                    <h4>Profile Completion</h4>
                    <p>80%</p>
                </div>
            </div>
        </section>

        <!-- Notifications Section -->
        <section id="notifications" class="section">
            <h3>Notifications</h3>
            <ul>
                <li>New message from Client A</li>
                <li>Proposal accepted for Project X</li>
                <li>Payment received for Project Y</li>
            </ul>
        </section>

       <!-- Active Jobs Section -->
<section id="jobs" class="section">

<?php
// Display active jobs
echo "<section id='jobs' class='section'>";
echo "<h3>Active Job List</h3>";
echo "<table>";
echo "<thead><tr><th>Job Title</th><th>Client</th><th>Status</th><th>Deadline</th></tr></thead>";
echo "<tbody>";

// Check if $result_active_jobs is not null and contains rows
if ($result_active_jobs && $result_active_jobs->num_rows > 0) {
    while ($job = $result_active_jobs->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($job['title']) . "</td>";
        echo "<td>" . htmlspecialchars($job['client']) . "</td>";
        echo "<td>" . htmlspecialchars($job['status']) . "</td>";
        echo "<td>" . htmlspecialchars($job['deadline']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No active jobs found for this freelancer.</td></tr>";
}

echo "</tbody></table></section>";

?>
</section>

        <!-- Post a Job -->
        <section id="postajob" class="section">
        <title>Post a Job</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }


        h1 {
            font-weight: bold;
            margin-bottom: 10px;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 10px 0 20px;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
            width: 100%;
            max-width: 500px;
        }

        input, textarea, select {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
            border-radius: 5px;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        textarea {
            resize: none;
            height: 100px;
        }

        /* Social Links */
        .social-container {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 10px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
            color: #333;
            font-size: 20px;
            transition: color 0.3s, transform 0.3s;
        }

        .social-container a:hover {
            color: #007bff;
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <form action="submit-job.php" method="POST">
        <h1>Post a Job</h1>
        <p>Fill out the details to post your job listing</p>
        <input type="text" id="title" name="title" placeholder="Job Title" required>
        <input type="text" id="category" name="category" placeholder="Category" required>
        <input type="number" id="budget" name="budget" placeholder="Budget (₱)" required>
        <textarea id="description" name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>
        </section>

        <!-- Proposals Section -->
        <section id="proposals" class="section">
            <h3>Proposals Submitted</h3>
            <ul>
                <li>Project X - Status: Shortlisted</li>
                <li>Project Y - Status: Rejected</li>
            </ul>
        </section>

        <!-- Earnings Section -->
        <section id="earnings" class="section">
            <h3>Earnings</h3>
            <p>Total: $1,200</p>
            <p>Withdrawable: $800</p>
        </section>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 My Dashboard. All Rights Reserved.</p>
        </footer>
    </main>

    <script>
        // Handle sidebar active links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.addEventListener('click', function() {
                // Remove 'active' class from previously active link
                document.querySelector('.sidebar-link.active')?.classList.remove('active');
                // Add 'active' class to the clicked link
                this.classList.add('active');
                
                // Hide all sections
                document.querySelectorAll('.section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show the corresponding section
                const targetSection = document.querySelector(this.getAttribute('href'));
                if (targetSection) {
                    targetSection.classList.add('active');
                }
            });
        });

        // Optionally, set the default active section if needed
        window.addEventListener('load', function() {
            const firstLink = document.querySelector('.sidebar-link');
            if (firstLink) {
                firstLink.click(); // Automatically click the first link to highlight it
            }
        });
    </script>

</body>
</html>
