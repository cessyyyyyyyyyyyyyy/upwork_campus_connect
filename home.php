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
    <title>Freelance Marketplace</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<header>
    <div class="logo">
        <a href="index.php"><img src="logo.png" alt="FreelanceHub Logo"></a>
    </div>
    <div class="search-bar-container">
        <form class="search-bar" action="search_results.php" method="GET">
            <input type="text" name="search" placeholder="Search for services...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="nav-links">
        <ul>
            <li><a href="freelancer_profile.php">Profile</a></li>
            <li><a href="about_us.php">About Us</a></li>
        </ul>
    </div>
</header>

<main>
    <section class="welcome-section">
        <div class="welcome-message">
            <h2>Welcome to FreelanceHub</h2>
            <p>Your one-stop platform for connecting clients with talented freelancers.</p>
        </div>
    </section>

    <section class="featured-categories">
        <h3>Featured Categories</h3>
        <div class="category-list">
            <div class="category-item"><a href="graphic_design_jobs.php">Graphic Design</a></div>
            <div class="category-item"><a href="writing_jobs.php">Writing</a></div>
            <div class="category-item"><a href="development_jobs.php">Development</a></div>
        </div>
    </section>

    <!-- Testimonials Section -->
<section class="testimonials" id="testimonials-container">
    <h3>What People Say</h3>
    <div id="freelancer-reviews">
        <?php
        if ($result_reviews->num_rows > 0) {
            while ($review = $result_reviews->fetch_assoc()) {
                echo "<div class='testimonial-card'>";
                echo "<h4>" . htmlspecialchars($review['client_name']) . "</h4>";
                echo "<div class='rating'>" . str_repeat("★", $review['rating']) . str_repeat("☆", 5 - $review['rating']) . "</div>";
                echo "<p class='review-text'>" . htmlspecialchars($review['review_text']) . "</p>";
                echo "</div>"; // Close testimonial-card
            }
        } else {
            echo "<p>No reviews yet.</p>";
        }
        ?>
    </div>
</section>


   <!-- Job Listings Section -->
<section class="job-listings-section">
    <h1>Job Listings</h1>
    <div class="job-listings">
        <?php
        if ($result_jobs->num_rows > 0) {
            while ($job = $result_jobs->fetch_assoc()) {
                echo "<div class='job-item'>";
                echo "<h3>" . htmlspecialchars($job['title']) . "</h3>";
                echo "<p><strong>Category:</strong> " . htmlspecialchars($job['category']) . "</p>";
                echo "<p><strong>Budget:</strong> ₱" . htmlspecialchars($job['budget']) . "</p>";
                echo "<p><strong>Description:</strong> " . htmlspecialchars($job['description']) . "</p>";
                echo "<p><small>Posted on: " . htmlspecialchars($job['created_at']) . "</small></p>";
                
                // Apply Button
                echo "<button class='apply-button' onclick='applyForJob(" . htmlspecialchars($job['id']) . ")'>Apply</button>";
                
                echo "</div>"; // Close job-item
            }
        } else {
            echo "<p>No job listings available.</p>";
        }
        ?>
    </div>
</section>

<script>
    // JavaScript function to handle job application
    function applyForJob(jobId) {
        // Redirect to application form or perform an action
        window.location.href = 'apply.php?job_id=' + jobId;
    }
</script>

    </div>
</section>


</main>

<footer class="footer">
  <div class="footer-left">
    <div class="footer-logo">
      <img src="img/logo.png" alt="Logo">
    </div>
    <p>&copy;2024 Taguig City University | All Rights Reserved</p>
  </div>
  
  <div class="footer-right">
    <h3>Contact Us</h3>
    <ul class="social-icon">
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-facebook"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-twitter"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-linkedin"></ion-icon>
        </a></li>
      <li class="social-icon__item"><a class="social-icon__link" href="#">
          <ion-icon name="logo-instagram"></ion-icon>
        </a></li>
    </ul>
  </div>
  
  <div class="waves">
    <div class="wave" id="wave1"></div>
    <div class="wave" id="wave2"></div>
    <div class="wave" id="wave3"></div>
    <div class="wave" id="wave4"></div>
  </div>
</footer>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<script src="reviews.js"></script>

</body>
</html>

<?php
$conn->close();
?>
