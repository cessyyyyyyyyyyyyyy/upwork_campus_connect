
<?php
// Database connection setup at the start
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "upwork_campus_connect"; // Change to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch testimonials (latest 5)
$sql_reviews = "SELECT client_name, rating, review_text FROM testimonials ORDER BY created_at DESC LIMIT 5";
$result_reviews = $conn->query($sql_reviews);

// Fetch job listings (make sure this query is after all other operations)
$sql_jobs = "SELECT * FROM jobs ORDER BY created_at DESC";
$result_jobs = $conn->query($sql_jobs);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="home.php">
            <img src="logo.png" alt="Logo" class="logo">
        </a>
        <h1>Client Dashboard</h1>
        <ul class="sidebar-links">
            <li><a href="#overview" class="sidebar-link">Overview</a></li>
            <li><a href="#manage-projects" class="sidebar-link">Manage Projects</a></li>
            <li><a href="#job-listings" class="sidebar-link">Job Listings</a></li>
            <li><a href="#payments" class="sidebar-link">Payments</a></li>
            <li><a href="#reviews-tab" class="sidebar-link">Reviews</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
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
                <div class="metric">
                    <h4>Ongoing Projects</h4>
                    <p>2 Projects in Progress</p>
                </div>
                <div class="metric">
                    <h4>Pending Payments</h4>
                    <p>$500</p>
                </div>
            </div>
        </section>

        <!-- Manage Projects Section -->
        <section id="manage-projects" class="section">
            <h2>Manage Projects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Status</th>
                        <th>Freelancer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Website Redesign</td>
                        <td>In Progress</td>
                        <td>Jane Smith</td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="message-btn">Message</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Content Writing</td>
                        <td>Completed</td>
                        <td>John Doe</td>
                        <td>
                            <button class="view-btn">View</button>
                            <button class="review-btn">Review</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

       <!-- Job Listings Section -->
<section id="job-listings" class="section">
    <h1>Job Listings</h1>
    <div class="job-listings-container">
        <?php
        if (isset($result_jobs) && $result_jobs->num_rows > 0) {
            while ($job = $result_jobs->fetch_assoc()) {
                echo "<div class='job-item'>";
                echo "<h3>" . htmlspecialchars($job['title']) . "</h3>";
                echo "<p><strong>Category:</strong> " . htmlspecialchars($job['category']) . "</p>";
                echo "<p><strong>Budget:</strong> ₱" . htmlspecialchars($job['budget']) . "</p>";
                echo "<p><strong>Description:</strong> " . htmlspecialchars($job['description']) . "</p>";
                echo "<p><small>Posted on: " . htmlspecialchars($job['created_at']) . "</small></p>";

                // Add the Apply button form
                echo "<form action='apply_job.php' method='POST'>";
                echo "<input type='hidden' name='job_id' value='" . $job['id'] . "'>"; // Hidden input for job ID
                echo "<button type='submit' class='apply-button'>Apply</button>";
                echo "</form>";

                echo "</div>";
            }
        } else {
            echo "<p>No job listings available.</p>";
        }
        ?>
    </div>
</section>


</section>

        <!-- Payments Section -->
        <section id="payments" class="section">
            <h2>Payments</h2>
            <div class="payment-list">
                <p><strong>Project:</strong> Website Redesign</p>
                <p><strong>Amount:</strong> $500</p>
                <button>Pay Now</button>
            </div>
            <div class="payment-list">
                <p><strong>Project:</strong> Content Writing</p>
                <p><strong>Amount:</strong> $200</p>
                <button>Pay Now</button>
            </div>
        </section>

        <!-- Review Section -->
        <section id="reviews-tab" class="section">
            <h2>Submit Your Review</h2>
            <form action="submit_testimonial.php" method="POST">
                <label for="client_name">Your Name:</label>
                <input type="text" id="client_name" name="client_name" required>
                <label for="rating">Rating (1-5):</label>
                <input type="number" id="rating" name="rating" min="1" max="5" required>
                <label for="review_text">Your Review:</label>
                <textarea id="review_text" name="review_text" required></textarea>
                <button type="submit" name="submit_review">Submit Review</button>
            </form>

            <h3>Recent Reviews</h3>
            <div id="reviews-container">
                <?php
                if (isset($reviews_result) && $reviews_result->num_rows > 0) {
                    while ($row = $reviews_result->fetch_assoc()) {
                        echo "<div class='review'>";
                        echo "<p><strong>" . htmlspecialchars($row['client_name']) . "</strong> - " . str_repeat('★', $row['rating']) . str_repeat('☆', 5 - $row['rating']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['review_text']) . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No reviews yet. Be the first to leave one!</p>";
                }
                ?>
            </div>
        </section>
    </div>
</body>
</html>


  
    <script>
        // JavaScript to handle adding reviews dynamically
        document.getElementById('add-review-btn').addEventListener('click', function(event) {
            event.preventDefault();
            
            const rating = document.getElementById('rating').value;
            const review = document.getElementById('review').value;
            const name = document.getElementById('client-name').value;

            if (review && name) {
                const reviewContainer = document.getElementById('reviews-container');
                const newReview = document.createElement('div');
                newReview.classList.add('review');
                newReview.innerHTML = `
                    <p><strong>${name}</strong> - ${'★'.repeat(rating)}${'☆'.repeat(5 - rating)}</p>
                    <p>${review}</p>
                `;
                reviewContainer.appendChild(newReview);

                // Clear form after submission
                document.getElementById('rating').value = '5';
                document.getElementById('review').value = '';
                document.getElementById('client-name').value = '';
            }
        });
    </script>
<script>
function applyForJob(jobId) {
    // Send an AJAX request to the server
    fetch('apply_job.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ job_id: jobId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to the freelancer dashboard's "Active Jobs" section
            window.location.href = 'freelancer_dashboard.php#jobs';
        } else {
            alert('Failed to apply for the job: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    });
}
</script>

</body>
</html>

<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    display: flex;
}
/* Sidebar Logo */
.sidebar .logo {
    display: block;
    width: 100px; /* Adjust based on your logo size */
    margin: 0 auto 20px; /* Center logo and give space below */
}


/* Sidebar */
.sidebar {
    width: 250px;
    background-color: #007BFF;
    color: white;
    height: 100vh;
    padding: 20px;
    box-sizing: border-box;
    position: fixed;
}

.sidebar h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-align: center;
}

.sidebar-links {
    list-style: none;
    padding: 0;
}

.sidebar-links li {
    margin: 15px 0;
}

.sidebar-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
}

.sidebar-links a:hover {
    text-decoration: underline;
}
/* Sidebar Links */
.sidebar-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
    padding: 10px 15px;
    border-radius: 4px;
}

.sidebar-links a:hover {
    text-decoration: underline;
    background-color: #0056b3; /* Slightly darker hover effect */
}

/* Active Link Highlight */
.sidebar-links a.active {
    background-color: #0056b3; /* Highlighted background */
    font-weight: bold;        /* Bold text for the active link */
    text-decoration: none;    /* Ensure no underline */
}


/* Main Content */
.main-content {
    margin-left: 270px;
    padding: 20px;
    width: calc(100% - 270px);
    box-sizing: border-box;
}

.section {
    margin-bottom: 40px;
}

.section h2 {
    font-size: 20px;
    margin-bottom: 10px;
}
.section {
    display: none;
}

/* Display the first section by default */
.section:first-of-type {
    display: block;
}
.section {
    margin-top: 20px;
}

.metrics {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.metric {
    background-color: #f4f4f4;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.metric h4 {
    font-size: 16px;
    margin-bottom: 10px;
}

.metric p {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

/* Responsive layout for smaller screens */
@media (max-width: 768px) {
    .metrics {
        grid-template-columns: 1fr;
    }
}


/* Freelancer Cards */
.freelancer-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 20px;
}

.freelancer-card {
    background: #ffffff;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    position: relative;
}

.freelancer-card img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-bottom: 15px;
    object-fit: cover;
    border: 4px solid #007BFF;
}

.freelancer-card h3 {
    font-size: 18px;
    margin: 10px 0;
    color: #333;
}

.freelancer-card p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
}

.freelancer-card button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.freelancer-card button:hover {
    background-color: #0056b3;
}

/* Hover Effects */
.freelancer-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.freelancer-card:hover button {
    background-color: #0056b3;
}

.freelancer-card:hover h3 {
    color: #007BFF;
}


/* Responsive Design */
@media (max-width: 768px) {
    #post-jobs .card {
        padding: 20px;
    }

    #post-jobs input, #post-jobs textarea, #post-jobs select {
        padding: 8px;
    }

    #post-jobs button {
        font-size: 14px;
    }
}
/* Section styling */
#job-listings {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centers the content horizontally */
    justify-content: center; /* Centers content vertically if needed */
    padding: 40px 20px;
    margin: 0 auto;
    width: 100%;
    max-width: 1200px; /* Ensures layout is not too wide */
}


/* Container for job listings */
.job-listings-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 columns */
    gap: 20px; /* Space between items */
    margin-top: 20px;
    justify-items: center; /* Centers items within each grid cell */
    width: 100%;
}


/* Individual job item styling */
.job-item {
    background-color: #ffefeb;
    padding: 15px; /* Adjust padding as necessary */
    border-radius: 10px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
    width: 90%; /* Makes the job item fill its grid column */
    max-width: 250px; /* Prevents items from becoming too wide */
}

.job-item h3 {
    color: #ff5e57;
    margin-bottom: 10px; /* Space between title and content */
    text-align: center; /* Centers the title */
}

.job-item p {
    font-size: 1rem;
    color: #333;
    margin-bottom: 5px; /* Space between paragraphs */
    text-align: center; /* Centers text */
}

.job-item:hover {
    transform: scale(1.05);
}


.job-item small {
    font-size: 0.8rem;
    color: #aaa;
    text-align: center;
}


.apply-button {
    background-color: #3586ff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease;
    font-size: 1rem;
    margin-top: 10px; /* Adds space above the button */
    display: block;
    margin-left: auto;
    margin-right: auto; /* Centers the button */
}
.apply-button:hover {
    background-color: #0056b3;
}



/* Manage Projects Section */
#manage-projects {
    margin-bottom: 40px;
}

/* Table Style */
table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
}

table th, table td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 16px;
}

table th {
    background-color: #FF6F61; /* Pink-red */
    color: white;
}

table td {
    background-color: #f9f9f9;
}

table td button {
    padding: 8px 15px;
    font-size: 14px;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-right: 10px;
}

/* Button Styles */
.view-btn {
    background-color: #FF6F61; /* Pink-red */
}

.message-btn {
    background-color: #FF8C00; /* Orange */
}

.review-btn {
    background-color: #FF3B2F; /* Darker red */
}

/* Button Hover Effects */
.view-btn:hover {
    background-color: #FF3B2F;
}

.message-btn:hover {
    background-color: #FF6F00;
}

.review-btn:hover {
    background-color: #FF1A00;
}

/* Row Hover Effect */
tbody tr:hover {
    background-color: #f2f2f2;
}

/* Responsive Design */
@media (max-width: 768px) {
    table th, table td {
        font-size: 14px;
        padding: 10px;
    }

    table td button {
        font-size: 12px;
        padding: 6px 12px;
    }
}

/* Payments Section */
#payments {
    margin-bottom: 40px;
}

/* Payment List Design */
.payment-list {
    background: #fff;
    padding: 20px;
    margin-bottom: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.payment-list p {
    font-size: 16px;
    margin: 5px 0;
    color: #333;
}

.payment-list p strong {
    color: #FF6F61; /* Pink-red */
}

.payment-list button {
    padding: 12px 20px;
    background-color: #FF6F61; /* Pink-red */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.payment-list button:hover {
    background-color: #FF3B2F; /* Darker red-orange on hover */
}

/* Hover Effects for Payment Entries */
.payment-list:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.payment-list:hover button {
    background-color: #FF3B2F;
}

/* Review Section Styles */
#reviews-tab {
    padding: 20px;
}

#reviews-tab h2 {
    font-size: 24px;
    margin-bottom: 20px;
}

#reviews-tab form {
    margin-bottom: 20px;
}

#reviews-tab input, #reviews-tab textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

#reviews-tab button {
    background-color: #FF6F61;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

#reviews-tab button:hover {
    background-color: #FF3B2F;
}

.review {
    background-color: #fff;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.review p {
    font-size: 16px;
    color: #333;
}

.review p strong {
    color: #FF6F61;
}

.review p:first-child {
    font-weight: bold;
}



/* Responsive Design */
@media (max-width: 768px) {
    .payment-list {
        padding: 15px;
    }

    .payment-list p {
        font-size: 14px;
    }

    .payment-list button {
        font-size: 14px;
        padding: 10px 18px;
    }
}


</style>
<script>
    // Get all sidebar links and sections
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    const sections = document.querySelectorAll('.section');

    // Add click event listener to each link
    sidebarLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent default anchor behavior
            
            // Remove active class from all links
            sidebarLinks.forEach(link => link.classList.remove('active'));

            // Add active class to the clicked link
            link.classList.add('active');

            // Hide all sections
            sections.forEach(section => section.style.display = 'none');

            // Show the related section
            const targetSection = document.querySelector(link.getAttribute('href'));
            if (targetSection) {
                targetSection.style.display = 'block';
            }
        });
    });

    // Show only the first section by default
    document.querySelector('.section').style.display = 'block';
</script>
