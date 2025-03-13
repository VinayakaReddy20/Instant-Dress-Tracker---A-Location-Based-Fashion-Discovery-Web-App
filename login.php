<?php
session_start();
include 'config.php'; // Ensure the correct database connection is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $shop_id = trim($_POST['shop_id']);
    $rememberMe = isset($_POST['rememberMe']) ? true : false;

    // Check email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format!');</script>";
    } elseif (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long!');</script>";
    } else {
        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT id, password, shop_id FROM shopownerlogin WHERE email = ? AND shop_id = ?");
        $stmt->bind_param("ss", $email, $shop_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $row['password'])) {
                // Start the session with the user ID
                $_SESSION['shop_id'] = $row['shop_id'];

                // Remember user if checked
                if ($rememberMe) {
                    setcookie('shop_id', $row['shop_id'], time() + (86400 * 30), "/");
                }

                echo "<script>alert('Login successful!'); window.location.href = 'dashboard.php';</script>";
            } else {
                echo "<script>alert('Invalid email or password. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('No account found with this email or shop ID. Please sign up.'); window.location.href = 'signup.php';</script>";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Your existing styles */
        body { font-family: 'Arial', sans-serif; background: #e1b382; color: #2d545e; display: flex; flex-direction: column; align-items: center; padding: 20px; margin: 0; min-height: 100vh; box-sizing: border-box; }
        header { width: 100%; display: flex; flex-direction: column; align-items: center; background-color: #2d545e; padding: 30px 40px; box-shadow: 0 4px 10px rgba(18, 52, 59, 0.5); border-radius: 12px; margin-bottom: 20px; }
        header h1 { font-size: 32px; color: #e1b382; margin-bottom: 10px; font-weight: bold; text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.5); }
        header a { text-decoration: none; color: #e1b382; font-weight: bold; margin-top: 10px; }
        main { display: flex; justify-content: center; align-items: center; width: 100%; flex-direction: column; }
        form { background-color: #ffffff; padding: 30px; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 500px; }
        form label { display: block; margin-bottom: 8px; font-weight: bold; color: #2d545e; }
        form input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #d3b892; border-radius: 5px; background-color: #f8f4e3; color: #2d545e; }
        form input:focus { border-color: #b08c5a; box-shadow: 0 0 10px rgba(176, 140, 90, 0.4); outline: none; }
        form button { background: linear-gradient(90deg, #2d545e, #12343b); color: #ffffff; border: none; cursor: pointer; transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease; padding: 14px 28px; font-size: 16px; border-radius: 12px; margin-top: 10px; width: 100%; }
        form button:hover { background: linear-gradient(90deg, #c89666, #e1b382); transform: translateY(-3px); box-shadow: 0 6px 12px rgba(18, 52, 59, 0.5); }
        form a { color: #b08c5a; display: inline-block; margin-top: 15px; }
        form a:hover { text-decoration: underline; }
        form label.checkbox-label { display: flex; align-items: center; font-size: 14px; margin-top: 10px; }
        form label.checkbox-label input { margin-right: 10px; }
    </style>
</head>
<body>
    <header>
        <h1>Login to Your Dashboard</h1>
        <a href="shopowner_int.php">Go Back</a>
    </header>
    <main>
        <form method="POST" action="">
            <label for="shop_id">Shop ID:</label>
            <input type="text" id="shop_id" name="shop_id" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required minlength="8">

            <button type="submit">Login</button>
            <a href="signup.php">Sign Up Here</a>
            <label class="checkbox-label">
            <input type="checkbox" id="rememberMe" name="rememberMe"> Remember Me
            </label>
        </form>
    </main>
</body>
</html>
