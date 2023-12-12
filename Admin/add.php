<?php
// Include the connection file
include '../assets/connection.php';

$inserted = false; // Initialize the insertion status

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $productName = $_POST["product_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // File upload handling
    $targetDirectory = "../uploads/"; // Directory where uploaded files will be stored
    $targetFile = $targetDirectory . basename($_FILES["image_url"]["name"]); // Path of the uploaded file
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION)); // Get the file extension

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image_url"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit();
    }

    // Check file size (you can set your own limit here)
    if ($_FILES["image_url"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        exit();
    }

    // Allow certain file formats (you can set your own formats here)
    if ($imageFileType !== "jpg" && $imageFileType !== "png" && $imageFileType !== "jpeg") {
        echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
        exit();
    }

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES["image_url"]["tmp_name"], $targetFile)) {
        // File uploaded successfully, now insert data into the database
        $imageUrl = $targetFile;

        // Create connection using MySQLi
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute SQL statement to insert data into the products table
        $sql = "INSERT INTO products (product_name, description, price, image_url) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssds", $productName, $description, $price, $imageUrl);
        $stmt->execute();

        // Set inserted to true after successful insertion
        $inserted = true;
    } else {
        echo "Sorry, there was an error uploading your file.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <h2>Add Product</h2>
    <!-- Display a success message if the insertion was successful -->
    <?php if ($inserted): ?>
        <p>Data added successfully!</p>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
        <!-- Form fields for product information -->
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name"><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br>
        
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>
        
        <!-- Input field for file upload -->
        <label for="image_url">Image Upload:</label><br>
        <input type="file" id="image_url" name="image_url"><br>
        
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
