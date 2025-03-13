<?php
// Database connection
$conn = new mysqli('localhost', 'root', '09[8BlRZTZ]1sb.7', 'shopplatform');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming shop_id is stored in session after the shop owner logs in
session_start();
$shop_id = $_SESSION['shop_id'];  // Retrieve shop_id from session or another method

// Handle form submission for adding stock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $sizes = trim($_POST['sizes']);
    $colors = trim($_POST['colors']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (empty($name) || empty($description) || empty($sizes) || empty($colors) || empty($price) || empty($quantity)) {
        echo "<div class='error-message'>All fields are required.</div>";
    } elseif (!is_numeric($price) || $price < 1) {
        echo "<div class='error-message'>Price must be at least ₹1.</div>";
    } elseif (!is_numeric($quantity) || $quantity < 1) {
        echo "<div class='error-message'>Quantity must be a positive number.</div>";
    } else {
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {
            $photo = file_get_contents($_FILES['photo']['tmp_name']);

            $stmt = $conn->prepare("INSERT INTO Stock (photo, name, description, sizes, colors, price, quantity, shop_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("ssssssii", $photo, $name, $description, $sizes, $colors, $price, $quantity, $shop_id);

                if ($stmt->execute()) {
                    echo "<div class='success-message'>Stock added successfully!</div>";
                } else {
                    echo "<div class='error-message'>Error adding stock: " . $stmt->error . "</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='error-message'>Error preparing statement: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='error-message'>Please upload a valid photo.</div>";
        }
    }
}

// Handle delete stock
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM Stock WHERE id = ? AND shop_id = ?");
    $stmt->bind_param("ii", $id, $shop_id);
    if ($stmt->execute()) {
        echo "<div class='success-message'>Stock deleted successfully!</div>";
    } else {
        echo "<div class='error-message'>Error deleting stock: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Handle edit stock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $sizes = trim($_POST['sizes']);
    $colors = trim($_POST['colors']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("UPDATE Stock SET name = ?, description = ?, sizes = ?, colors = ?, price = ?, quantity = ? WHERE id = ? AND shop_id = ?");
    $stmt->bind_param("sssssiii", $name, $description, $sizes, $colors, $price, $quantity, $id, $shop_id);
    if ($stmt->execute()) {
        echo "<div class='success-message'>Stock updated successfully!</div>";
    } else {
        echo "<div class='error-message'>Error updating stock: " . $stmt->error . "</div>";
    }
    $stmt->close();
}

// Fetch stock only for the current shop owner
$stmt = $conn->prepare("SELECT * FROM Stock WHERE shop_id = ?");
$stmt->bind_param("i", $shop_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Management</title>
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
            background-color: #2d545e;
            padding: 20px;
            text-align: center;
            border-radius: 12px;
            color: #e1b382;
            margin-bottom: 20px;
        }

        form, table {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.1);
            width: 90%;
            max-width: 1000px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #2d545e;
            color: #ffffff;
        }

        table td img {
            max-width: 80px;
            border-radius: 5px;
        }

        form label, form button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            text-align: left;
            font-weight: bold;
            color: #2d545e;
        }

        form input, form button {
            padding: 10px;
            border: 2px solid #2d545e;
            border-radius: 8px;
            width: calc(100% - 20px);
        }

        form button {
            background-color: #c89666;
            color: white;
            cursor: pointer;
        }

        .success-message, .error-message {
            text-align: center;
            font-size: 16px;
            padding: 10px;
            margin: 10px;
            border-radius: 8px;
            color: #fff;
        }

        .success-message {
            background-color:rgb(29, 81, 65);
        }

        .error-message {
            background-color: #f44336;
        }

        .edit-btn, .delete-btn {
            padding: 6px 12px;
            font-size: 14px;
            color: white;
            background-color: #2d545e;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .edit-btn:hover, .delete-btn:hover {
            background-color: #c89666;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .edit-form {
            display: none;
            margin-top: 10px;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .edit-form input {
            margin-bottom: 10px;
        }
        .go-back {
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

        .go-back:hover {
            background: #c89666;
            transform: translateY(-3px);
        }
        /* CSS code remains unchanged */
    </style>
</head>
<body>
<header>
    <button class="go-back" id="goBackButton">Go Back</button>
    <h1>Stock Management</h1>
</header>
<main>
<form method="POST" enctype="multipart/form-data">
    <h2>Add Stock</h2>
    <input type="file" name="photo" accept="image/*" required>
    <input type="text" name="name" placeholder="Dress Name" required>
    <input type="text" name="description" placeholder="Description" required>
    <input type="text" name="sizes" placeholder="Sizes (comma-separated)" required>
    <input type="text" name="colors" placeholder="Colors (comma-separated)" required>
    <input type="number" name="price" placeholder="Price (₹)" min="1" required>
    <input type="number" name="quantity" placeholder="Quantity" min="1" required>
    <button type="submit" name="submit">Add Stock</button>
</form>

<table>
    <thead>
        <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price (₹)</th>
            <th>Sizes</th>
            <th>Colors</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['photo']); ?>" alt="Dress Photo"></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>₹<?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['sizes']); ?></td>
                <td><?php echo htmlspecialchars($row['colors']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td>
                    <div class="actions">
                        <button class="edit-btn" onclick="showEditForm(<?php echo $row['id']; ?>)">Edit</button>
                        <a href="?delete=<?php echo $row['id']; ?>" style="text-decoration: none;"><button class="delete-btn">Delete</button></a>
                    </div>
                    <form method="POST" class="edit-form" id="edit-form-<?php echo $row['id']; ?>">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                        <input type="text" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" required>
                        <input type="text" name="sizes" value="<?php echo htmlspecialchars($row['sizes']); ?>" required>
                        <input type="text" name="colors" value="<?php echo htmlspecialchars($row['colors']); ?>" required>
                        <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
                        <input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" required>
                        <button type="submit" name="edit">Save Changes</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</main>
<script>
    function showEditForm(id) {
        const form = document.getElementById(`edit-form-${id}`);
        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
    }

    const goBackButton = document.getElementById("goBackButton");
    goBackButton.addEventListener("click", function () {
        window.location.href = "dashboard.php"; // Change to the correct dashboard page
    });
</script>
</body>
</html>

