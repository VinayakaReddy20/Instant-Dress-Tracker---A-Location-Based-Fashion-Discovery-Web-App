<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Owner Interface</title>
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
            padding: 20px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            margin-bottom: 20px;
            color: #e1b382;
        }
        header h1 {
            font-size: 36px;
            margin: 0;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(18, 52, 59, 0.3);
        }
        header p {
            margin: 10px 0 20px 0;
            font-size: 18px;
        }
        button {
            padding: 16px 32px;
            font-size: 18px;
            color: #e1b382;
            background: linear-gradient(90deg, #2d545e, #12343b);
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin: 10px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(18, 52, 59, 0.4);
        }
        button:hover {
            background: linear-gradient(90deg, #c89666, #e1b382);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(18, 52, 59, 0.5);
        }
        #shopOwnerOptions {
            display: none;
            flex-direction: column;
            align-items: center;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(18, 52, 59, 0.1);
            margin-top: 20px;
            width: 100%;
            max-width: 500px;
        }
        #shopOwnerOptions p {
            font-size: 20px;
            color: #2d545e;
            margin-bottom: 30px;
            font-weight: bold;
        }
        #shopOwnerOptions button {
            padding: 14px 28px;
            font-size: 16px;
            background: linear-gradient(90deg, #b08c5a, #d3b892);
            color: #fff;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
            margin: 10px;
        }
        #shopOwnerOptions button:hover {
            background: linear-gradient(90deg, #d3b892, #f0e6d1);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome Shop Owners!</h1>
        <p>Take control of your shop and grow your business</p>
        <div class="buttons">
            <form method="post" action="">
                <button type="submit" name="showOptions">Shop Owner Options</button>
                <button type="submit" name="goBack">Go Back</button>
            </form>
        </div>
        
        <!-- Shop Owner Options -->
        <?php if (isset($_POST['showOptions'])): ?>
            <div id="shopOwnerOptions" style="display: flex;">
                <p>Select an option to get started:</p>
                <form method="post" action="">
                    <button type="submit" name="existingShop">Existing Shop</button>
                    <button type="submit" name="newShop">New Shop</button>
                </form>
            </div>
        <?php endif; ?>
    </header>

    <?php
    if (isset($_POST['existingShop'])) {
        header('Location: login.php');
        exit();
    }

    if (isset($_POST['newShop'])) {
        header('Location: signup.php');
        exit();
    }

    if (isset($_POST['goBack'])) {
        header('Location: MainIndex.php');
        exit();
    }
    ?>
</body>
</html>
