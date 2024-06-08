<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$table = $data['table'];
$id = $data['id'];
$updateData = $data['data'];

switch ($table) {
    case 'products':
        $query = "UPDATE product SET product_id=?, location=? WHERE product_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssss',$updateData['product_id'], $updateData['product_name'],$updateData['supplier_id'],$updateData['category_id'],$updateData['price'], $id);
        break;
    case 'category':
        $query = "UPDATE category SET category_id=?, location=? WHERE category_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $updateData['category_id'], $updateData['category_name'], $id);
        break;
    case 'supplier':
        $query = "UPDATE supplier SET supplier_id=?, location=? WHERE supplier_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $updateData['supplier_id'], $updateData['supplier_name'],$updateData['contact_person'],$updateData['category_id'],$updateData['contact_number'], $id);
        break;
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid table']);
        exit;
}

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Update failed']);
}

$conn->close();
?>