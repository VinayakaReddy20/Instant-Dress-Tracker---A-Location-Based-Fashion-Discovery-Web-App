<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dress Map - Customer</title>
    <style>
       body {
            font-family: 'Arial', sans-serif;
            background: #e1b382;
            color: #2d545e;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
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
            padding: 20px;
            box-shadow: 0 4px 12px rgba(18, 52, 59, 0.5);
            border-radius: 12px;
            margin-bottom: 40px;
            text-align: center;
        }
        header h1 {
            font-size: 36px;
            color: #e1b382;
            font-weight: bold;
            text-transform: uppercase;
            text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.5);
        }
        /* Premium Search Box Styling */
        header input {
            width: 80%;
            padding: 15px;
            margin: 20px 0;
            border: 2px solid #c89666;
            border-radius: 50px;
            background-color: #ffffff;
            font-size: 18px;
            color: #2d545e;
            box-shadow: 0 2px 10px rgba(18, 52, 59, 0.2);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
        header input:focus {
            border-color: #e1b382;
            box-shadow: 0 0 15px rgba(200, 150, 102, 0.6);
            outline: none;
        }
        header input::placeholder {
            color: #c89666;
            font-style: italic;
        }
        /* Search Button */
        header button {
            padding: 15px 30px;
            background: linear-gradient(90deg, #2d545e, #12343b);
            color: #e1b382;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }
        header button:hover {
            background: linear-gradient(90deg, #c89666, #e1b382);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.2);
        }
        /* Go Back Button */
        .go-back-button {
            margin-top: 20px;
            padding: 12px 25px;
            background: #2d545e;
            color: #e1b382;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
        }
        .go-back-button:hover {
            background: #c89666;
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.2);
        }
        .results {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .resultSection {
            margin-bottom: 40px;
        }
        .resultCard {
            background-color: #ffffff;
            padding: 20px;
            border: 2px solid #2d545e;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.4s ease;
            box-shadow: 0 3px 6px rgba(18, 52, 59, 0.1);
        }
        .resultCard:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(18, 52, 59, 0.15);
        }
        .resultCard h3 {
            font-size: 22px;
            color: #2d545e;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .resultCard p {
            font-size: 15px;
            color: #2d545e;
            line-height: 1.6;
        }
        /* Style for dress images */
        .resultCard img {
            width: 256px;
            height: 256px;
            object-fit: cover;
            border-radius: 8px;
        }
        .resultCard .dressDetails p {
            font-size: 14px;
            margin-bottom: 5px;
        }
        .no-results {
            color: #2d545e;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dress Map</h1>
        <form method="POST">
            <input type="text" name="query" id="searchBar" placeholder="Search for dresses or shops...">
            <button type="submit" id="searchButton">Search</button>
        </form>
        <button class="go-back-button" onclick="window.location.href='MainIndex.php'">Go Back</button>
    </header>
    <main>
        <div id="results" class="results">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "09[8BlRZTZ]1sb.7";
        $dbname = "Shopplatform";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $query = isset($_POST['query']) ? $conn->real_escape_string($_POST['query']) : '';
        
        $hasResults = false;
        
        // Fetch shop details
        $shopSql = "SELECT shopName, shopAddress, shopContactNumber FROM shopownersignup WHERE shopName LIKE '%$query%'";
        $shopResult = $conn->query($shopSql);
        
        // Output shop results
        if ($shopResult && $shopResult->num_rows > 0) {
            echo "<div class='resultSection'>";
            echo "<h2>Shop Results</h2>";
            while ($row = $shopResult->fetch_assoc()) {
                echo "<div class='resultCard'>";
                echo "<div class='shopDetails'>";
                echo "<h3>Shop: " . htmlspecialchars($row['shopName']) . "</h3>";
                echo "<p><strong>Address:</strong> " . htmlspecialchars($row['shopAddress']) . "</p>";
                echo "<p><strong>Contact:</strong> " . htmlspecialchars($row['shopContactNumber']) . "</p>";
                echo "</div>";
                echo "</div>";
                $hasResults = true;
            }
        }
        
        // Fetch dress details only if there is a search query
        if (!empty($query)) {
            $dressSql = "SELECT name, price, sizes, colors, photo FROM Stock WHERE name LIKE '%$query%' OR sizes LIKE '%$query%' OR colors LIKE '%$query%'";
            $dressResult = $conn->query($dressSql);
        
            // Output dress results
            if ($dressResult && $dressResult->num_rows > 0) {
                echo "<div class='resultSection'>";
                echo "<h2>Dress Results</h2>";
                while ($row = $dressResult->fetch_assoc()) {
                    echo "<div class='resultCard'>";
                    echo "<div class='dressDetails'>";
                    echo "<h3>Dress: " . htmlspecialchars($row['name']) . "</h3>";
                    echo "<p><strong>Price:</strong> ₹" . number_format($row['price'], 2) . "</p>";
                    echo "<p><strong>Sizes:</strong> " . htmlspecialchars($row['sizes']) . "</p>";
                    echo "<p><strong>Colors:</strong> " . htmlspecialchars($row['colors']) . "</p>";
        
                    if (!empty($row['photo'])) {
                        echo '<p><strong>Photo:</strong><br>';
                        echo '<img src="data:image/jpg;base64,' . base64_encode($row['photo']) . '" />';
                        echo '</p>';
                    } else {
                        echo '<p><strong>Photo:</strong><br>';
                        echo '<img src="default-image.jpg" />';
                        echo '</p>';
                    }
                    echo "</div>";
                    echo "</div>";
                    $hasResults = true;
                }
            }
        }
        
        if (!$hasResults) {
            echo "<p class='no-results'>No results found.</p>";
        }
        
        $conn->close();
        ?>
        </div>
    </main>
</body>
</html>
