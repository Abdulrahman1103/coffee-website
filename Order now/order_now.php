<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "login";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Initialize the cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Adding items to the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $itemName = $_POST['item_name'];
    $itemPrice = $_POST['item_price'];
    $_SESSION['cart'][] = ['name' => $itemName, 'price' => $itemPrice];
}

// Removing items from the cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_item'])) {
    $index = $_POST['item_index'];
    array_splice($_SESSION['cart'], $index, 1);
}

// Confirm order
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_order'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        $itemName = $cartItem['name'];
        $itemPrice = $cartItem['price'];

        // Insert each cart item into the database
        $sql = "INSERT INTO deilvery_info (item_name, item_price) VALUES ('$itemName', '$itemPrice')";
        if (!$conn->query($sql)) {
            die("Error: " . $conn->error);
        }
    }

    // Clear the cart after confirming the order
    $_SESSION['cart'] = [];
}

// Calculate total price
$totalPrice = array_reduce($_SESSION['cart'], function ($total, $item) {
    return $total + $item['price'];
}, 0);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list with cart</title>
    <link rel="stylesheet" href="styleO.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

<header>
        <nav class="navbar">
        
        <div class="logo">
            <img src="images/logo.png" alt="Logo"> 
        </div>

        
        <ul class="nav-links" id="nav-links"> 
        <li><a href="../LogIn-Regster/homepage.php" class="active">Home</a></li> 
                <li><a href="../Story/story.html">Story</a></li>
                <li><a href="../Meun/index.html">Menu</a></li>
                <li><a href="../Delivery/index.html">Delivery</a></li>
                <li><a href="../Contact/contact.html">Contact</a></li>
                <li><a href="../LogIn-Regster/logout.php" class="btn Login-in"> Log-out</a></li>
        </ul>

    </nav>
    </header>

    
    <div class="All-item">
        <?php
        $menuItems = [
            ['name' => 'Caramel', 'desc' => 'Caramel Mocha Delight', 'price' => 6.50, 'image' => 'images/menu1.png'],
            ['name' => 'Vanilla', 'desc' => 'Vanilla Hazelnut Dream', 'price' => 7.00, 'image' => 'images/menu2.png'],
            ['name' => 'Cinnamon', 'desc' => 'Cinnamon Honey Latte', 'price' => 8.00, 'image' => 'images/menu3.png'],
            ['name' => 'Chocolate', 'desc' => 'Chocolate Almond Bliss', 'price' => 5.50, 'image' => 'images/menu4.png'],
            ['name' => 'Maple', 'desc' => 'Maple Spice Brew', 'price' => 4.00, 'image' => 'images/menu5.png'],
            ['name' => 'Berry', 'desc' => 'Berry Latte Fusion', 'price' => 5.00, 'image' => 'images/menu6.png'],
        ];

        foreach ($menuItems as $item) {
            echo "
            <div class='item'>
                <img src='{$item['image']}' alt='' loading='lazy'>
                <form action='' method='POST'>
                    <input type='hidden' name='item_name' value='{$item['name']}'>
                    <input type='hidden' name='item_price' value='{$item['price']}'>
                    <button class='Add' type='submit' name='add_to_cart'><i class='fa-solid fa-cart-shopping'></i> Add to Cart</button>
                </form>
                <h4>{$item['name']}</h4>
                <h3>{$item['desc']}</h3>
                <h3 class='Mony'>\${$item['price']}</h3>
            </div>";
        }
        ?>
    </div>

    <div class="Cart">
        <h2>Your Cart (<?php echo count($_SESSION['cart']); ?> items)</h2>
        <ul>
            <?php
            foreach ($_SESSION['cart'] as $index => $cartItem) {
                echo "<li>
                        {$cartItem['name']} - \${$cartItem['price']}
                        <form action='' method='POST' style='display:inline;'>
                            <input type='hidden' name='item_index' value='{$index}'>
                            <button class='removeItem' type='submit' name='remove_item'><i class='fa-solid fa-circle-minus'></i></button>
                        </form>
                      </li>";
            }
            ?>
        </ul>
        <h3>Order Total: $<?php echo number_format($totalPrice, 2); ?></h3>
        <form action="" method="POST">
            <button id="confirmButton" type="submit" name="confirm_order">Confirm</button>
        </form>
    </div>
</body>
</html>
