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

$valid_tables = ['products', 'category', 'supplier'];
if (!in_array($table, $valid_tables)) {
    die(json_encode(['success' => false, 'message' => 'Invalid table']));
}

$id_column = ($table == 'products') ? 'product_id' : ($table == 'category' ? 'category_id' : 'supplier_id');

$stmt = $conn->prepare("SELECT * FROM $table WHERE $id_column = ?");
$stmt->bind_param('s', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $record = $result->fetch_assoc();
    echo json_encode(['success' => true, 'record' => $record]);
} else {
    echo json_encode(['success' => false, 'message' => 'Record not found']);
}

$stmt->close();
$conn->close();
?>
