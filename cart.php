<?php
session_start();
$total = 0;
?>

<h3>Your Shopping Cart</h3>
<table>
    <tr>
        <th>Item</th>
        <th>Price</th>
    </tr>
    <?php
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            echo "<tr>
                    <td>" . $item['item_name'] . "</td>
                    <td>$" . $item['price'] . "</td>
                  </tr>";
            $total += $item['price'];
        }
    }
    ?>
</table>

<p>Total: $<?php echo $total; ?></p>
<a href="purchase.php">Proceed to Checkout</a>
