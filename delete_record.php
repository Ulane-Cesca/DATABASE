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

// Check for dependencies before deletion
function hasDependencies($conn, $table, $id) {
    switch ($table) {
        case 'category':
            $query = "SELECT COUNT(*) AS count FROM products WHERE category_id = ?";
            break;
        case 'supplier':
            $query = "SELECT COUNT(*) AS count FROM products WHERE supplier_id = ?";
            break;
        default:
            return false;
    }
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    return $count > 0;
}

// Prepare and execute delete query
if (hasDependencies($conn, $table, $id)) {
    echo json_encode(['success' => false, 'message' => 'Cannot delete record because it is associated with other records.']);
    exit;
}

switch ($table) {
    case 'products':
        $query = "DELETE FROM products WHERE product_id = ?";
        break;
    case 'category':
        $query = "DELETE FROM category WHERE category_id = ?";
        break;
    case 'supplier':
        $query = "DELETE FROM supplier WHERE supplier_id = ?";
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid table']);
        exit;
}

$stmt = $conn->prepare($query);
$stmt->bind_param('s', $id); // Assuming ID is an integer

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Record deleted successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Cannot delete record because it is associated with other records.']);
}

$stmt->close();
$conn->close();
?>
