<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | Pastimes</title>
    <link rel="stylesheet" href="styles.css">
    
    <!-- This internal style will run ONLY if the external styles.css fails -->
    <style>
        body { background-color: #f4f4f4; color: #333; font-family: sans-serif; padding: 50px; }
        .cart-box { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-width: 600px; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="cart-box">
    <h1>Shopping Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is currently empty.</p>
        <a href="products.php">Go back to shop</a>
    <?php else: ?>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Qty</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>R<?php echo $item['price']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="products.php" style="color: red;">Continue Shopping</a>
    <?php endif; ?>
</div>

</body>
</html>