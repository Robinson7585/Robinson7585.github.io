<?php include 'database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to Our Store</h1>

    <?php
    // Check if user is logged in as an admin
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '<a href="admin.php">Go to Admin Panel</a><br>';
    }
    ?>

    <h2>Items List</h2>
    <div id="items-container">
        <?php foreach ($items as $item) { ?>
            <div class="item">
                <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                <p><?php echo htmlspecialchars($item['description']); ?></p>
                <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
            </div>
        <?php } ?>
    </div>
</body>
</html>
