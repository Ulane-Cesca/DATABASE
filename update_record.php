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

$data = json_decode(file_get_contents('php://input'), true);
$table = $data['table'];
$id = $data['id'];
$updatedData = $data['data'];

$valid_tables = ['products', 'category', 'supplier'];
if (!in_array($table, $valid_tables)) {
    die(json_encode(['success' => false, 'message' => 'Invalid table']));
}

$setParts = [];
$values = [];
foreach ($updatedData as $key => $value) {
    $setParts[] = "$key = ?";
    $values[] = $value;
}
$values[] = $id;

$setString = implode(', ', $setParts);
$id_column = ($table == 'products') ? 'product_id' : ($table == 'category' ? 'category_id' : 'supplier_id');
$query = "UPDATE $table SET $setString WHERE $id_column = ?";
$stmt = $conn->prepare($query);

$types = str_repeat('s', count($values) - 1) . 's';
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Update failed']);
}

$stmt->close();
$conn->close();
?>
