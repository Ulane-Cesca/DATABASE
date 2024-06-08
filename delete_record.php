<?php
header('Content-Type: application/json');

// Validate input parameters
$data = json_decode(file_get_contents('php://input'), true); // Get JSON data from the request body

$table = $data['table'] ?? null;
$id = $data['id'] ?? null;

if (!$table || !$id) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Prepare and execute delete query
switch ($table) {
    case 'products':
        $query = "DELETE FROM products WHERE product_id=?";
        break;
    case 'category':
        $query = "DELETE FROM category WHERE category_id=?";
        break;
    case 'supplier':
        $query = "DELETE FROM supplier WHERE supplier_id=?";
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid table']);
        exit;
}

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $id); // Assuming ID is a string, use 's'

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Record deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete record']);
}

$stmt->close();
$conn->close();
?>
