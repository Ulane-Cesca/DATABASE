<?php
session_start();

// Check if the supplier data is available in the session
if (isset($_SESSION['supplier'])) {
    $supplier = $_SESSION['supplier'];
    $supplier_id = $supplier['supplier_id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the query
    $sql = "SELECT s.supplier_id, s.supplier_name, s.contact_person, s.contact_number, p.product_id, p.product_name, p.price
            FROM Supplier s
            JOIN Products p ON s.supplier_id = p.supplier_id
            WHERE s.supplier_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $supplier_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if supplier exists
    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
    } else {
        $row = [
            'supplier_id' => 'N/A',
            'supplier_name' => 'N/A',
            'contact_person' => 'N/A',
            'contact_number' => 'N/A',
            'product_id' => 'N/A',
            'product_name' => 'N/A',
            'price' => 'N/A',
        ];
    }

    $stmt->close();
    $conn->close();
} else {
    // If no supplier data in session, set default values
    $row = [
        'supplier_id' => 'N/A',
        'supplier_name' => 'N/A',
        'contact_person' => 'N/A',
        'contact_number' => 'N/A',
        'product_id' => 'N/A',
        'product_name' => 'N/A',
        'price' => 'N/A',
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="info.css">
    <title>Supplier Details</title>
    <style>
        .container {
            max-width: 700px;
            margin: auto;
           
            border-radius: 8px;
            margin-top: 100px;
            background: transparent;
        }
        h1 {
            text-align: center;
            color: white;
            font-size: 50px;
        }

        .info label {
            font-weight: bold;
            display: inline-block;
            width: 200px; 
            font-size: 16px;
            color: white;
            margin-left: 170px;
            padding-bottom: 10px;
        }
        .info p {
            display: inline-block;
            font-size: 16px;
            color: white;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <div class="nav-logo">
            <p><img src="l2.png" alt="Logo"><a href="#">SADE GROCERY</a></p>
            <div class="nav-menu" id="navMenu">
                <a href="index.php" class="link active">LOG OUT</a>
    </div>
    </div>
    <div class="container">
        <h1>Supplier Details</h1>
        <div class="info">
            <label>Supplier ID:</label>
            <p><?php echo htmlspecialchars($row['supplier_id']); ?></p>
        </div>
        <div class="info">
            <label>Supplier Name:</label>
            <p><?php echo htmlspecialchars($row['supplier_name']); ?></p>
        </div>
        <div class="info">
            <label>Contact Person:</label>
            <p><?php echo htmlspecialchars($row['contact_person']); ?></p>
        </div>
        <div class="info">
            <label>Contact Number:</label>
            <p><?php echo htmlspecialchars($row['contact_number']); ?></p>
        </div>
        <div class="info">
            <label>Product ID:</label>
            <p><?php echo htmlspecialchars($row['product_id']); ?></p>
        </div>
        <div class="info">
            <label>Product Name:</label>
            <p><?php echo htmlspecialchars($row['product_name']); ?></p>
        </div>
        <div class="info">
            <label>Price:</label>
            <p><?php echo htmlspecialchars($row['price']); ?></p>
        </div>
    </div>
    </div>
</body>
</html>
