<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$table = $_GET['table'];
$id = $_GET['id'];

switch ($table) {
    case 'products':
        $query = "SELECT * FROM products WHERE product_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        break;
    case 'category':
        $query = "SELECT * FROM category WHERE category_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id); // Corrected to 's' for VARCHAR
        break;
    case 'supplier':
        $query = "SELECT * FROM supplier WHERE supplier_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid table']);
        exit;
}

$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    echo json_encode(['success' => true, 'record' => $result->fetch_assoc()]);
} else {
    echo json_encode(['success' => false, 'message' => 'Record not found']);
}

$stmt->close();
$conn->close();
?>
