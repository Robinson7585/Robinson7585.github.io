<?php
// Database connection settings
$serverName = "YAHWEH7\SQLEXPRESS"; // Your SQL Server instance name
$connectionOptions = array(
    "Database" => "your_database_name", // Replace with your actual database name
    "Uid" => "your_username", // Your SQL username
    "PWD" => "your_password" // Your SQL password
);

// Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Add new book functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $price = $_POST['price'];

    $sql = "INSERT INTO Books (name, author, price) VALUES (?, ?, ?)";
    $params = array($name, $author, $price);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Delete a book functionality
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM Books WHERE id = ?";
    $stmt = sqlsrv_query($conn, $sql, array($id));

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Modify book name and price functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['modify'])) {
    $id = $_POST['id'];
    $newName = $_POST['newName'];
    $newPrice = $_POST['newPrice'];

    $sql = "UPDATE Books SET name = ?, price = ? WHERE id = ?";
    $stmt = sqlsrv_query($conn, $sql, array($newName, $newPrice, $id));

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }
}

// Fetch all books
$sql = "SELECT * FROM Books";
$query = sqlsrv_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Book Management</title>
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

    <!-- Existing Books List -->
    <h2>Existing Books</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Author</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>

        <?php
        while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
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

<?php
// Close the database connection
sqlsrv_close($conn);
?>
