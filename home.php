<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Services Marketplace</title>
</head>
<body>

    <!-- Navbar -->
    <header>
        <nav>
            <div class="logo">
                <h1>Student Marketplace</h1>
            </div>
            <ul class="nav-links">
                <li><a href="about.html">About</a></li>
                <li><a href="Service.php">Services</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="register.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h2>Showcase Your Skills, Connect with Peers</h2>
            <p>Offer services like tutoring, graphic design, resume writing, and more. Build your profile, set your rates, and start earning!</p>
            <a href="#" class="btn">MESSAGE US</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h3>Popular Services</h3>
        <div class="services-container">
            <div class="service-card">
                <h4>Tutoring</h4>
                <p>Find or offer tutoring services for a wide range of subjects.</p>
            </div>
            <div class="service-card">
                <h4>Graphic Design</h4>
                <p>Offer your design skills or find talented peers for your projects.</p>
            </div>
            <div class="service-card">
                <h4>Resume Writing</h4>
                <p>Get help crafting the perfect resume or assist others with theirs.</p>
            </div>
        </div>
    </section>
    <?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Student Services Marketplace</title>
    <link rel="stylesheet" href="home.css">
</head>
</html>


    <!-- Testimonials Section -->
    <section class="testimonials">
        <h3>What Students Are Saying</h3>
        <div class="testimonials-container">
            <div class="testimonial-card">
                <p>"This platform has been amazing! I found a tutor for my calculus class and improved my grades significantly."</p>
                <h5>- Sarah, Engineering Student</h5>
            </div>
            <div class="testimonial-card">
                <p>"As a graphic design major, I love that I can find freelance work right within my university community."</p>
                <h5>- Alex, Graphic Design Student</h5>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Student Services Marketplace. All rights reserved.</p>
    </footer>

</body>
</html>
<style>
    /* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: Arial, sans-serif;
    color: #333;
    line-height: 1.6;
}

/* Header/Navbar */
header {
    background-color: #4CAF50;
    color: #fff;
    padding: 1em 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
}

nav .logo h1 {
    font-size: 1.5em;
    font-weight: bold;
}

nav .nav-links {
    list-style-type: none;
    display: flex;
}

nav .nav-links li {
    margin-left: 20px;
}

nav .nav-links a {
    color: #fff;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

nav .nav-links a:hover {
    color: #ffdd57;
}

/* Hero Section */
.hero {
    background: url('https://www.pixelstalk.net/wp-content/uploads/2016/08/Design-Wallpaper-HD.jpg') no-repeat center center/cover;
    color: #fff;
    text-align: center;
    padding: 100px 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.hero-content h2 {
    font-size: 2.5em;
    margin-bottom: 10px;
}

.hero-content p {
    font-size: 1.2em;
    margin-bottom: 20px;
}

.hero-content .btn {
    background-color: #ffdd57;
    color: #333;
    padding: 10px 20px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.hero-content .btn:hover {
    background-color: #fbc531;
}

/* Services Section */
.services {
    padding: 50px 20px;
    text-align: center;
}

.services h3 {
    font-size: 2em;
    margin-bottom: 30px;
    color: #333;
}

.services-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.service-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    width: 250px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.service-card:hover {
    transform: translateY(-10px);
}

.service-card h4 {
    font-size: 1.5em;
    color: #4CAF50;
    margin-bottom: 10px;
}

.service-card p {
    font-size: 1em;
    color: #666;
}

/* Testimonials Section */
.testimonials {
    background-color: #f7f7f7;
    padding: 50px 20px;
    text-align: center;
}

.testimonials h3 {
    font-size: 2em;
    margin-bottom: 30px;
    color: #333;
}

.testimonials-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

.testimonial-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.testimonial-card p {
    font-size: 1em;
    color: #666;
    font-style: italic;
    margin-bottom: 15px;
}

.testimonial-card h5 {
    font-size: 1.1em;
    color: #333;
    font-weight: bold;
}

/* Footer */
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 20px;
    font-size: 0.9em;
}

footer p {
    margin: 0;
}

</style>