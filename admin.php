<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_item'])) {
    $item_id = $_POST['item_id'];
    // Deleting item from the database
    $query = "DELETE FROM items WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $item_id);
    $stmt->execute();
    header('Location: admin.php');
}

$query = "SELECT * FROM items";
$stmt = $pdo->query($query);
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <h2>Items List</h2>
    <form method="POST" action="admin.php">
        <label for="name">Item Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="description">Item Description:</label>
        <input type="text" name="description" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" required><br><br>

        <button type="submit" name="add_item">Add Item</button>
    </form>

    <h2>Existing Items</h2>
    <?php foreach ($items as $item) { ?>
        <div class="item">
            <h3><?php echo htmlspecialchars($item['name']); ?></h3>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
            <form method="POST" action="admin.php">
                <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                <button type="submit" name="delete_item">Delete Item</button>
            </form>
        </div>
    <?php } ?>
</body>
</html>
