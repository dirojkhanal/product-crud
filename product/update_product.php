<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diroj_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Validate input
    if (!is_numeric($id) || ($price !== "" && !is_numeric($price)) || ($quantity !== "" && !is_numeric($quantity))) {
        echo "Invalid input. Please check your data.";
    } else {
        $update_fields = [];

        if (!empty($name)) $update_fields[] = "name='$name'";
        if (!empty($description)) $update_fields[] = "description='$description'";
        if ($price !== "") $update_fields[] = "price=$price";
        if ($quantity !== "") $update_fields[] = "quantity=$quantity";

        if (!empty($update_fields)) {
            $update_query = "UPDATE Product SET " . implode(", ", $update_fields) . " WHERE id=$id";
            if ($conn->query($update_query) === TRUE) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product: " . $conn->error;
            }
        } else {
            echo "No fields to update.";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>
<body>
    <h1>Update Product</h1>
    <form action="update_product.php" method="post">
        <label for="id">Product ID:</label>
        <input type="number" id="id" name="id" required><br>

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name"><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01"><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity"><br>

        <input type="submit" value="Update Product">
    </form>
</body>
</html>
