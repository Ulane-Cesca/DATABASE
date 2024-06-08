<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Validate and sanitize input
$table = isset($_GET['table']) ? $_GET['table'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Validate table name
$valid_tables = ['products', 'category', 'supplier'];
if (!in_array($table, $valid_tables)) {
    die(json_encode(['success' => false, 'message' => 'Invalid table']));
}

// Prepare and execute query
$query = "";
switch ($table) {
    case 'products':
        $query = "SELECT * FROM products WHERE product_id=?";
        break;
    case 'category':
        $query = "SELECT * FROM category WHERE category_id=?";
        break;
    case 'supplier':
        $query = "SELECT * FROM supplier WHERE supplier_id=?";
        break;
}

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if record exists
if ($result->num_rows > 0) {
    echo json_encode(['success' => true, 'record' => $result->fetch_assoc()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Record not found']);
}

// Close connections
$stmt->close();
$conn->close();
?>
