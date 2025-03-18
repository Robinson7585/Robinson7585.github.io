<?php
// Database connection (Replace these variables with your actual DB credentials)
$host = 'localhost';
$db = 'your_database';
$user = 'your_username';
$pass = 'your_password';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Add new book functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    // Insert new book into the database
    $sql = "INSERT INTO books (name, author, price) VALUES (:name, :author, :price)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'author' => $author, 'price' => $price]);
}

// Delete a book functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Delete book from the database
    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

// Modify book name and price functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modify'])) {
    $id = $_POST['id'];
    $newName = $_POST['newName'];
    $newPrice = $_POST['newPrice'];

    // Update book name and price
    $sql = "UPDATE books SET name = :newName, price = :newPrice WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['newName' => $newName, 'newPrice' => $newPrice, 'id' => $id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>

    <h1>Admin Book Management</h1>

    <!-- Add New Book Form -->
    <h2>Add a New Book</h2>
    <form method="POST">
        <label for="name">Book Name:</label>
        <input type="text" name="name" required><br>

        <label for="author">Author:</label>
        <input type="text" name="author" required><br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required><br>

        <button type="submit" name="add">Add Book</button>
    </form>

    <hr>

    <!-- Modify Book Form -->
    <h2>Modify an Existing Book</h2>
    <form method="POST">
        <label for="id">Book ID:</label>
        <input type="number" name="id" required><br>

        <label for="newName">New Name:</label>
        <input type="text" name="newName" required><br>

        <label for="newPrice">New Price:</label>
        <input type="number" name="newPrice" step="0.01" required><br>

        <button type="submit" name="modify">Modify Book</button>
    </form>

    <hr>

    <!-- Book List with Delete Options -->
    <h2>Existing Books</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <?php
        // Fetch and display books from the database
        $sql = "SELECT * FROM books";
        $stmt = $pdo->query($sql);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['price']}</td>
                    <td><a href='?delete={$row['id']}'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table>

</body>
</html>
