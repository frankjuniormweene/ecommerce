<?php
session_start();
include 'header.php';

// Example cart array if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Example products for testing (you should fetch these from a database)
$products = [
    1 => ['name' => 'Elegant Handbag', 'price' => 29.99, 'image' => 'img/1.jpg'],
    2 => ['name' => 'Modern Tote', 'price' => 49.99, 'image' => 'img/2.jpg'],
    3 => ['name' => 'Classic Satchel', 'price' => 39.99, 'image' => 'img/3.jpg'],
];

// Handle remove item
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header('Location: cart.php');
    exit;
}
?>
<head>
    <meta charset="UTF-8">
    <title>Nipa | Home</title>
    <link rel="stylesheet" href="cart.css">
</head>
<section class="cart">
    <h2 class="section-title">Your Shopping Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-cart">Your cart is currently empty.</p>
    <?php else: ?>
        <div class="cart-items">
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $productId => $quantity):
                $product = $products[$productId];
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
            ?>
            <div class="cart-item">
                <img src="<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
                <div class="cart-details">
                    <h3><?= $product['name']; ?></h3>
                    <p>Price: $<?= number_format($product['price'], 2); ?></p>
                    <p>Quantity: <?= $quantity; ?></p>
                    <p>Subtotal: $<?= number_format($subtotal, 2); ?></p>
                    <a href="cart.php?remove=<?= $productId; ?>" class="btn remove-btn">Remove</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-summary">
            <h3>Total: $<?= number_format($total, 2); ?></h3>
            <a href="checkout.php" class="btn checkout-btn">Proceed to Checkout</a>
        </div>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
