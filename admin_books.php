<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add a new book
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $publication_year = $_POST['publication_year'];

    $sql = "INSERT INTO Books (title, author, genre, price, publication_year)
            VALUES ('$title', '$author', '$genre', '$price', '$publication_year')";

    if ($conn->query($sql) === TRUE) {
        echo "New book added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete a book
if (isset($_POST['delete'])) {
    $book_id = $_POST['book_id'];

    $sql = "DELETE FROM Books WHERE book_id = '$book_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Book deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Modify book details
if (isset($_POST['modify'])) {
    $book_id = $_POST['book_id'];
    $new_title = $_POST['new_title'];
    $new_price = $_POST['new_price'];

    $sql = "UPDATE Books SET title = '$new_title', price = '$new_price' WHERE book_id = '$book_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Book updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Book Management</title>
</head>
<body>
    <h1>Admin Book Management</h1>

    <!-- Form to add a new book -->
    <h2>Add a New Book</h2>
    <form action="admin_books.php" method="POST">
        <label for="title">Title: </label><input type="text" name="title" required><br>
        <label for="author">Author: </label><input type="text" name="author"><br>
        <label for="genre">Genre: </label><input type="text" name="genre"><br>
        <label for="price">Price: </label><input type="number" name="price" step="0.01"><br>
        <label for="publication_year">Publication Year: </label><input type="number" name="publication_year" min="1000" max="9999"><br>
        <button type="submit" name="add">Add Book</button>
    </form>

    <!-- Form to delete a book -->
    <h2>Delete a Book</h2>
    <form action="admin_books.php" method="POST">
        <label for="book_id">Book ID: </label><input type="number" name="book_id" required><br>
        <button type="submit" name="delete">Delete Book</button>
    </form>

    <!-- Form to modify book details -->
    <h2>Modify Book Details</h2>
    <form action="admin_books.php" method="POST">
        <label for="book_id">Book ID: </label><input type="number" name="book_id" required><br>
        <label for="new_title">New Title: </label><input type="text" name="new_title"><br>
        <label for="new_price">New Price: </label><input type="number" name="new_price" step="0.01"><br>
        <button type="submit" name="modify">Modify Book</button>
    </form>
</body>
</html>
