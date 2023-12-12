<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
    <link rel="stylesheet" href="../assets/astyle.css">
</head>
<body>
<?php
// Include the connection file
include '../assets/connection.php';
include '../assets/header.php';

// Fetch all products from the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Display products in a table
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["product_name"] . "</td>
                <td>" . $row["description"] . "</td>
                <td>" . $row["price"] . "</td>
                <td><img src='../uploads/" . $row["image_url"] . "' alt='Product Image' style='max-width: 100px;'></td>
                <td>
                    <a href='edit.php?id=" . $row["id"] . "'>Edit</a>
                    <a href='delete.php?id=" . $row["id"] . "' onclick=\"return confirm('Are you sure you want to delete this product?');\">Delete</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No products found.";
}

$conn->close();
?>
    
</body>
</html>
