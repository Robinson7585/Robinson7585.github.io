<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('database.php');
    
    $name = $_POST['name'];
    $address = $_POST['address'];
    $credit_card = $_POST['credit_card'];
    $items = json_encode($_SESSION['cart']);
    
    $sql = "INSERT INTO purchases (name, address, credit_card, items) VALUES ('$name', '$address', '$credit_card', '$items')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Thank you for your purchase!";
        unset($_SESSION['cart']);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form method="POST" action="purchase.php">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="text" name="credit_card" placeholder="Credit Card" required>
    <button type="submit">Complete Purchase</button>
</form>
