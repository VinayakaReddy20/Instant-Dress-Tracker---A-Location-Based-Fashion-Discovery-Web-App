<?php
// You can include common header/footer or configuration files if needed.
// For example:
// include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME TO DRESS MAP</title>
    <style>
        /* Basic Styling */
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

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 30px;
            justify-content: center;
            margin-bottom: 20px;
        }

        nav a {
            text-decoration: none;
            color: #e1b382; /* Sand Tan text */
            font-weight: bold;
            transition: color 0.3s ease;
            font-size: 18px;
        }

        nav a:hover {
            color: #c89666; /* Sand Tan Shadow hover effect */
        }

        h1 {
            font-size: 40px;
            color: #e1b382; /* Sand Tan text */
            margin-bottom: 20px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.5); /* Night Blue Shadow */
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Great Vibes', cursive; /* Replace with your chosen font */
            font-size: 48px;
            letter-spacing: 2px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }

        .buttons {
            margin-top: 30px;
            text-align: center;
        }

        button {
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

        button:hover {
            background: linear-gradient(90deg, #c89666, #e1b382); /* Sand Tan Shadow gradient on hover */
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.5); /* Night Blue Shadow */
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

        section {
            background: #f5f5f5; /* Light background for sections */
            padding: 60px 40px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(18, 52, 59, 0.1); /* Night Blue Shadow */
            width: 100%;
            text-align: center;
            margin-bottom: 60px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        section:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.2);
        }

        section h2 {
            font-size: 28px;
            color: #2d545e; /* Night Blue text */
            margin-bottom: 30px;
            font-weight: bold;
            text-transform: uppercase;
        }

        section p {
            font-size: 18px;
            color: #2d545e; /* Night Blue text */
            margin-bottom: 30px;
        }

        section img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 20px;
        }

        /* Popular Brands Section */
        #brands {
            padding: 40px 20px;
            background: #f5f5f5; /* Light background */
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(18, 52, 59, 0.1); /* Subtle shadow */
            margin-bottom: 60px;
        }

        #brands h2 {
            font-size: 28px;
            color: #2d545e; /* Night Blue text */
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        .brands-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center;
        }

        .brand {
            flex: 1 1 calc(25% - 20px); /* Responsive column width */
            max-width: 200px;
            text-align: center;
            margin: 10px;
        }

        .brand img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .brand img:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

        .brand p {
            font-size: 18px;
            color: #2d545e; /* Night Blue text */
            margin-top: 10px;
            font-weight: bold;
        }

        /* Footer Styling */
        footer {
            background-color: #2d545e; /* Night Blue footer */
            padding: 20px 0;
            width: 100%;
            text-align: center;
            color: #fff;
        }

        .social-media {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .social-media li {
            margin: 0 10px;
        }

        .social-media a {
            color: #e1b382; /* Sand Tan for social media links */
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-media a:hover {
            color: #c89666; /* Sand Tan Shadow hover effect */
        }
        /* Add the rest of your styles here */
    </style>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#brands">Brands</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <h1>WELCOME TO DRESS MAP</h1>
        <div class="buttons">
            <button id="customerButton">Enter as Customer</button>
            <button id="ownerButton">Enter as Shop Owner</button>
        </div>
    </header>
    <main>
        <section class="background-section">
            <div>
                <h2>Discover the Latest Fashion Trends</h2>
                <p>Explore our collection of stylish and trendy clothing for all occasions.</p>
            </div>
        </section>
        <section id="about">
            <h2>About Us</h2>
            <p>Dress Map is your go-to destination for the latest fashion trends. We offer a wide range of clothing and accessories to suit every style and occasion.</p>
            <img src="images/about-image.jpg" alt="Fashion Collection">
        </section>
        <section id="services">
            <h2>Our Services</h2>
<h3>For Customers</h3>
<ul>
    <li><strong>Shop Locator:</strong> Customers can search for nearby shops based on their location.</li>
    <li><strong>Real-Time Stock Availability:</strong> View current stock of dresses available in each shop.</li>
    <li><strong>Dress Search Functionality:</strong> Search for specific dresses and find where they are available.</li>
    <li><strong>Detailed Dress Information:</strong> Comprehensive details including images, descriptions, sizes, colors, and prices.</li>
    <li><strong>Time-Saving Shopping Experience:</strong> Save time by accessing stock availability online.</li>
    <li><strong>User-Friendly Interface:</strong> An intuitive and easy-to-navigate platform for customers.</li>
</ul>

<h3>For Shop Owners</h3>
<ul>
    <li><strong>Account Creation and Management:</strong> Shop owners can sign up and manage their shop's online presence.</li>
    <li><strong>Profile Customization:</strong> Create a detailed profile for the shop, including name, address, and logo.</li>
    <li><strong>Stock Management:</strong> Easily enter, update, and delete stock details.</li>
    <li><strong>Sales Tracking:</strong> Track popular items and customer behavior for informed inventory decisions.</li>
    <li><strong>Increased Visibility:</strong> Reach a wider audience by listing stock on the website.</li>
    <li><strong>Promotional Opportunities:</strong> Highlight new arrivals or special discounts to drive sales.</li>
</ul>
        </section>
        <section id="brands">
            <h2>Popular Clothing Brands</h2>
            <div class="brands-container">
                <?php
                // You can dynamically generate brand items here using PHP.
                $brands = [
                    ["src" => "images/Trends.jpg", "name" => "Trends"],
                    ["src" => "images/Zudio.jpg", "name" => "Zudio"],
                    ["src" => "images/zara.jpg", "name" => "Zara"],
                    ["src" => "images/hm.jpg", "name" => "H&M"]
                ];
                foreach ($brands as $brand) {
                    echo "<div class='brand'>
                            <img src='{$brand['src']}' alt='{$brand['name']}'>
                            <p>{$brand['name']}</p>
                          </div>";
                }
                ?>
            </div>
        </section>
        <section id="contact">
    <h2>Contact Us</h2>
    <p>Feel free to reach out to us for any inquiries or assistance.</p>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if form fields are set
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
        $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) : '';
        $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
        
        if ($name && $email && $message) {
            // Here you can add code to handle form submission (e.g., save to a database or send an email).
            echo "<p>Thank you, $name. Your message has been received.</p>";
        } else {
            echo "<p>Please fill out all fields.</p>";
        }
    } else {
    ?>
    <form method="POST" action="#contact">
        <!-- Added name attributes to the form fields -->
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Send Message</button>
    </form>
    <?php
    }
    ?>
</section>

    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> Dress Map. All rights reserved.</p>
        <ul class="social-media">
            <li><a href="Facebook">Facebook</a></li>
            <li><a href="Instagram">Instagram</a></li>
            <li><a href="Twitter">Twitter</a></li>
        </ul>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const customerButton = document.getElementById('customerButton');
            const ownerButton = document.getElementById('ownerButton');

            customerButton.addEventListener('click', () => {
                window.location.href = 'customer.php'; 
            });

            ownerButton.addEventListener('click', () => {
                window.location.href = 'shopowner_int.php'; 
            });

            document.querySelectorAll('nav a').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
</body>
</html>
