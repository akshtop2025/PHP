<?php
include("token.php");

// Check if token status is valid
if ($token_status) {
    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decode JSON data from request body
        $json_data = json_decode(file_get_contents('php://input'), true);

        // Check if the required fields are present in the request
        if (isset($json_data['name']) && isset($json_data['price']) && isset($json_data['description'])) {
            // Retrieve data from JSON request
            $name = $json_data['name'];
            $price = $json_data['price'];
            $description = $json_data['description'];

            // Prepare and execute the insert query using prepared statement
            $insertQuery = "INSERT INTO products (name, price, description) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("sds", $name, $price, $description);
            
            if ($insertStmt->execute()) {
                $msg = "Product added successfully.";
                $isSuccess = true;
            } else {
                $msg = "Error adding product.";
            }
        } else {
            $msg = "Missing required fields.";
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
        // Fetch all products from the database
        $selectQuery = "SELECT * FROM products";
        $result = $conn->query($selectQuery);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $msg = "Products fetched successfully.";
            $isSuccess = true;
        } else {
            $msg = "No products found.";
        }
    } else {
        $msg = "Invalid request method.";
    }
} else {
    $msg = "Invalid token.";
}

// Prepare response
$response = [
    'data' => $data ?? [],
    'status' => 200,
    'msg' => $msg,
    'isSuccess' => $isSuccess ?? false
];
echo json_encode($response);
?>
