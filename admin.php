<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}
?>

<!-- Admin Interface -->
<form action="add_item.php" method="POST">
    <input type="text" name="item_name" placeholder="Item Name" required>
    <input type="number" name="price" placeholder="Price" required>
    <button type="submit">Add Item</button>
</form>

<h3>Item List</h3>
<?php
include('database.php');

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='item'>
                <p>" . $row["item_name"] . "</p>
                <p>$" . $row["price"] . "</p>
                <a href='remove_item.php?id=" . $row["id"] . "'>Remove Item</a>
              </div>";
    }
}

$conn->close();
?>

?>
