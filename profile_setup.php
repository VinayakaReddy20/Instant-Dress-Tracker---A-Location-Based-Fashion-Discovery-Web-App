<?php
// Start the session (if needed)
session_start();

// Initialize variables
$shopDescription = $shopLogo = $shopBanner = '';
$errors = [];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    $shopDescription = trim($_POST['shopDescription']);
    $shopLogo = $_FILES['shopLogo'];
    $shopBanner = $_FILES['shopBanner'];

    // Validation
    if (empty($shopDescription)) {
        $errors[] = "Please provide a shop description.";
    }
    if (empty($shopLogo['name'])) {
        $errors[] = "Please upload a shop logo.";
    }
    if (empty($shopBanner['name'])) {
        $errors[] = "Please upload a shop banner image.";
    }

    // If no errors, process the data
    if (empty($errors)) {
        // Handle file uploads (example: save to a directory)
        $uploadDir = 'uploads/';
        $logoPath = $uploadDir . basename($shopLogo['name']);
        $bannerPath = $uploadDir . basename($shopBanner['name']);

        if (move_uploaded_file($shopLogo['tmp_name'], $logoPath) && move_uploaded_file($shopBanner['tmp_name'], $bannerPath)) {
            // Save data to database or perform other actions
            // Example: Insert into database (pseudo-code)
            // $sql = "INSERT INTO shop_profiles (description, logo, banner) VALUES ('$shopDescription', '$logoPath', '$bannerPath')";
            // mysqli_query($conn, $sql);

            // Display success message
            echo "<script>alert('Shop profile saved successfully!');</script>";
        } else {
            $errors[] = "Failed to upload files.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Profile Setup</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #e1b382; /* Sand Tan background */
            color: #2d545e; /* Night Blue text */
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0;
            margin: 0;
            min-height: 100vh;
            box-sizing: border-box;
            overflow-x: hidden;
        }

        /* Header Styling */
        header {
            background-color: #2d545e; /* Night Blue */
            padding: 30px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(18, 52, 59, 0.5); /* Night Blue Shadow */
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            border-radius: 12px;
            text-align: center;
            position: relative;
            z-index: 10;
        }

        h1 {
            font-size: 40px;
            color: #e1b382; /* Sand Tan text */
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.5); /* Night Blue Shadow */
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        header a {
            text-decoration: none;
            color: #e1b382; /* Sand Tan text */
            font-weight: bold;
            transition: color 0.3s ease;
            font-size: 18px;
        }

        header a:hover {
            color: #c89666; /* Sand Tan Shadow hover effect */
        }

        /* Main Section Styling */
        main {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        form {
            background-color: #f5f5f5; /* Light background */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(18, 52, 59, 0.1); /* Subtle shadow */
            width: 100%;
            max-width: 500px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #2d545e; /* Night Blue text */
        }

        form input,
        form textarea,
        form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #2d545e; /* Night Blue border */
            border-radius: 5px;
            background-color: #ffffff; /* White background for inputs */
            color: #2d545e; /* Night Blue text */
        }

        form input:focus,
        form textarea:focus {
            border-color: #c89666; /* Sand Tan focus border */
            box-shadow: 0 0 10px rgba(200, 150, 102, 0.4);
            outline: none;
        }

        form button {
            background: linear-gradient(90deg, #2d545e, #12343b); /* Night Blue gradient */
            color: #e1b382; /* Sand Tan text */
            padding: 16px 32px;
            font-size: 18px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin: 15px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(18, 52, 59, 0.4);
        }

        form button:hover {
            background: linear-gradient(90deg, #c89666, #e1b382); /* Sand Tan Shadow gradient on hover */
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.5); /* Night Blue Shadow */
        }

        /* Footer Styling */
        footer {
            background-color: #2d545e; /* Night Blue footer */
            padding: 20px 0;
            width: 100%;
            text-align: center;
            color: #fff;
        }

        footer .social-media {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        footer .social-media li {
            margin: 0 10px;
        }

        footer .social-media a {
            color: #e1b382; /* Sand Tan for social media links */
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        footer .social-media a:hover {
            color: #c89666; /* Sand Tan Shadow hover effect */
        }
        /* Add your CSS styles here (same as in the original file) */
    </style>
</head>
<body>
    <header>
        <h1>Set Up Shop Profile</h1>
        <a href="dashboard.php">Go Back</a>
    </header>
    <main>
        <?php if (!empty($errors)): ?>
            <div style="color: red; margin-bottom: 20px;">
                <?php foreach ($errors as $error): ?>
                    <p><?php echo $error; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form id="profileForm" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="shopDescription">Shop Description:</label>
                <textarea id="shopDescription" name="shopDescription" placeholder="Write a brief description of your shop..." required><?php echo htmlspecialchars($shopDescription); ?></textarea>
            </div>
            <div class="form-group">
                <label for="shopLogo">Shop Logo:</label>
                <input type="file" id="shopLogo" name="shopLogo" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="shopBanner">Shop Banner Image:</label>
                <input type="file" id="shopBanner" name="shopBanner" accept="image/*" required>
            </div>
            <button type="submit">Save Profile</button>
        </form>
    </main>
    <footer>
        <ul class="social-media">
            <li><a href="#">Facebook</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Instagram</a></li>
        </ul>
    </footer>
</body>
</html>