<?php
include('database.php');

$sql = "SELECT * FROM items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='item'>
                <p>" . $row["item_name"] . "</p>
                <p>$" . $row["price"] . "</p>
                <a href='add_to_cart.php?id=" . $row["id"] . "'>Add Item</a>
              </div>";
    }
} else {
    echo "No items found";
}

$conn->close();
?>

