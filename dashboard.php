<?php
// Assuming you're using PHP to fetch data from a backend:
// Replace this with your actual PHP logic to get data from your database or API
$shopName = "Your Shop"; // You can fetch this from the database
$dailySales = 1000; // Example data, replace with actual dynamic value
$monthlySales = 5000; // Example data
$outOfStock = 5; // Example data

$recentActivity = [
    "New order placed by customer",
    "Stock updated for dress XYZ",
    "Profile updated"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(120deg, #e1b382, #f5e8c7);
            color: #2d545e;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            box-sizing: border-box;
        }

        header {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(90deg, #2d545e, #12343b);
            padding: 30px;
            box-shadow: 0 4px 12px rgba(18, 52, 59, 0.5);
            border-radius: 12px;
            margin-bottom: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 36px;
            color: #e1b382;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.5);
        }

        .Log-out {
            margin-top: 10px;
            padding: 10px 20px;
            font-size: 14px;
            background: #2d545e;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .Log-out:hover {
            background: #c89666;
            transform: translateY(-3px);
        }

        main {
            width: 100%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            gap: 40px;
        }

        .stats, .actions, .recent {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.1);
            width: 100%;
            text-align: center;
        }

        .stats h2, .actions h2, .recent h2 {
            font-size: 24px;
            color: #c89666;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .stats p, .actions p, .recent p {
            font-size: 16px;
            color: #2d545e;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        button {
            padding: 14px 28px;
            font-size: 16px;
            color: #ffffff;
            background: linear-gradient(90deg, #2d545e, #12343b);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            font-weight: bold;
        }

        button:hover {
            background: linear-gradient(90deg, #c89666, #e1b382);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.2);
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome back! Here’s what’s happening in your store today.</h1>
        <button class="Log-out" id="logoutButton">Log out</output></button>
    </header>
    <main>
        <section class="stats">
            <h2>Quick Stats</h2>
            <div id="quickStats">
                <p>Today's Sales: <?php echo $dailySales; ?></p>
                <p>Monthly Sales: <?php echo $monthlySales; ?></p>
                <p>Out of Stock Items: <?php echo $outOfStock; ?></p>
            </div>
        </section>
        <section class="actions">
            <h2>Actions</h2>
            <div class="buttons">
                <form action="stockmgt.php" method="get">
                    <button type="submit">Stock Management</button>
                </form>
                <form action="profile_setup.php" method="get">
                    <button type="submit">Update Shop Profile</button>
                </form>
            </div>
        </section>
        <section class="recent">
            <h2>Recent Activity</h2>
            <div id="recentActivity">
                <?php
                foreach ($recentActivity as $activity) {
                    echo "<p>$activity</p>";
                }
                ?>
            </div>
        </section>
    </main>
    <script>
        document.getElementById('logoutButton').addEventListener('click', () => {
            window.location.href = 'MainIndex.php';
        });
    </script>
</body>
</html>
