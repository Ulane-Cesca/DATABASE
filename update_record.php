<?php
$servername = "localhost";
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
$record_data = $data['data'];

$update_fields = [];
foreach ($record_data as $key => $value) {
    $update_fields[] = "$key = '$value'";
}

$update_query = "UPDATE $table SET " . implode(', ', $update_fields) . " WHERE id = $id";
if ($conn->query($update_query) === TRUE) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $conn->error]);
}

$conn->close();
?>
