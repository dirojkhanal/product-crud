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

    // Validate input
    if (!is_numeric($id)) {
        echo "Invalid input. Please check your data.";
    } else {
        $delete_query = "DELETE FROM Product WHERE id=$id";

        if ($conn->query($delete_query) === TRUE) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . $conn->error;
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
    <title>Delete Product</title>
</head>
<body>
    <h1>Delete Product</h1>
    <form action="delete_product.php" method="post">
        <label for="id">Product ID:</label>
        <input type="number" id="id" name="id" required><br>

        <input type="submit" value="Delete Product">
    </form>
</body>
</html>
