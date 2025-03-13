<?php
// Database connection
$conn = new mysqli('localhost', 'root', '09[8BlRZTZ]1sb.7', 'shopplatform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle sign-up form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $shop_id = intval($_POST['shop_id']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $shopName = htmlspecialchars(trim($_POST['shopName']));
    $shopAddress = htmlspecialchars(trim($_POST['shopAddress']));
    $shopContactNumber = htmlspecialchars(trim($_POST['shopContactNumber']));
    $operatingHours = htmlspecialchars(trim($_POST['operatingHours']));

    // Validate inputs
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error-message'>Invalid email format.</div>";
    } elseif (strlen($password) < 8) {
        echo "<div class='error-message'>Password must be at least 8 characters long.</div>";
    } elseif (!is_numeric($shopContactNumber) || strlen($shopContactNumber) < 10) {
        echo "<div class='error-message'>Invalid contact number.</div>";
    } else {
        // Check for duplicate Shop ID or Email
        $stmt = $conn->prepare("SELECT * FROM shopownersignup WHERE shop_id = ? OR email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("is", $shop_id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='error-message'>Shop ID or Email already exists.</div>";
            $stmt->close(); // Close statement before exiting
        } else {
            // Hash password securely
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert new shop owner into shopownersignup table
            $stmt->close(); // Close the previous statement
            $stmt = $conn->prepare("INSERT INTO shopownersignup (shop_id, email, password, shopName, shopAddress, shopContactNumber, operatingHours) VALUES (?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("issssss", $shop_id, $email, $hashedPassword, $shopName, $shopAddress, $shopContactNumber, $operatingHours);
                if ($stmt->execute()) {
                    echo "<div class='success-message'>Sign-up successful!</div>";
                } else {
                    echo "<div class='error-message'>Error: " . $stmt->error . "</div>";
                }
                $stmt->close(); // Close the statement after execution
            } else {
                echo "<div class='error-message'>Error preparing statement: " . $conn->error . "</div>";
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Owner Sign Up</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f9f4e8;
            color: #2d545e;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
            margin: 0;
            min-height: 100vh;
            box-sizing: border-box;
        }
        header {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #2d545e;
            padding: 30px 40px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            margin-bottom: 40px;
            color: #f9f4e8;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-size: 40px;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 1px;
        }
        header a {
            text-decoration: none;
            color: #f9f4e8;
            font-weight: bold;
            margin-top: 10px;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            flex-direction: column;
        }
        form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            margin-top: 20px;
        }
        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #2d545e;
        }
        form input, form button {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #d3b892;
            border-radius: 8px;
            background-color: #f8f4e3;
            color: #2d545e;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        form button {
            background: linear-gradient(90deg, #2d545e, #12343b);
            color: #f9f4e8;
            border: none;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            padding: 16px 32px;
            border-radius: 25px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .success-message {
            color: #28a745;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
        .error-message {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Shop Owner Sign Up</h1>
        <a href="shopowner_int.php">Go Back to Option Page</a>
    </header>
    <main>
        <form method="POST">
            <label for="shop_id">Shop ID:</label>
            <input type="text" id="shop_id" name="shop_id" required pattern="\d+" title="Shop ID must be a number">

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">

            <label for="shopName">Shop Name:</label>
            <input type="text" id="shopName" name="shopName" required>

            <label for="shopAddress">Shop Address:</label>
            <input type="text" id="shopAddress" name="shopAddress" required>

            <label for="shopContactNumber">Shop Contact Number:</label>
            <input type="text" id="shopContactNumber" name="shopContactNumber" required minlength="10">

            <label for="operatingHours">Operating Hours:</label>
            <input type="text" id="operatingHours" name="operatingHours" required>

            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
