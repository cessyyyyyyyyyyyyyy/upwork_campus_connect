<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: 0;
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
        <input type="number" id="budget" name="budget" placeholder="Budget" required>
        <textarea id="description" name="description" placeholder="Job Description" required></textarea>
        <button type="submit">Post Job</button>
    </form>
</body>
</html>
