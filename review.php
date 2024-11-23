<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Freelancer Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="profile-container">
        <!-- Other sections here -->

        <!-- Reviews Section -->
        <div class="reviews">
            <h2>Reviews</h2>
            <div id="reviews-container">
                <!-- Reviews will be dynamically added here -->
            </div>
        </div>

        <!-- Add Review Section -->
        <div class="add-review">
            <h3>Add a Review</h3>
            <label for="rating">Rating:</label>
            <select id="rating">
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>
            <label for="review">Review:</label>
            <textarea id="review" placeholder="Write your review here..."></textarea>
            <label for="client-name">Name:</label>
            <input type="text" id="client-name" placeholder="Your name">
            <button id="add-review-btn">Submit Review</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
 <style>

.reviews {
    margin-top: 30px;
}

#reviews-container {
    margin-top: 20px;
}

.review-item {
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    background-color: #f9f9f9;
}

.review-item p {
    margin: 5px 0;
}

.add-review {
    margin-top: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f4f4f4;
}

.add-review label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
}

#review, #client-name, #rating {
    width: 100%;
    margin-top: 5px;
    padding: 8px;
    font-size: 14px;
}

#add-review-btn {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#add-review-btn:hover {
    background-color: #0056b3;
}

 </style>