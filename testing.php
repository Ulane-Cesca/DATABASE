<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .title {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-controls div {
            margin: 10px 0;
        }

        .pagination-container {
            text-align: center;
            margin-top: 20px;
        }

        .pagination-container a {
            margin: 0 5px;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #000;
        }

        .pagination-container a.active {
            background-color: #4CAF50;
            color: white;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
        <script>
    function changePage(table, page) {
        document.querySelector(`input[name="${table}_page"]`).value = page;
        document.getElementById('tableForm').submit();
    }

    function editRecord(table, id) {
        fetch(`fetch_record.php?table=${table}&id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const form = document.getElementById('editForm');
                    form.innerHTML = '';

                    Object.keys(data.record).forEach(key => {
                        const value = data.record[key];
                        const input = document.createElement('input');
                        input.type = 'text';
                        input.name = key;
                        input.value = value;
                        input.placeholder = key;
                        form.appendChild(input);
                    });

                    const submitButton = document.createElement('button');
                    submitButton.type = 'submit';
                    submitButton.textContent = 'Save Changes';
                    form.appendChild(submitButton);

                    document.getElementById('editModal').style.display = 'block';
                } else {
                    alert(data.message);
                }
            });
    }

    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
    function editRecord(table, id) {
    fetch(`fetch_record.php?table=${table}&id=${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const record = data.record;
                const form = document.getElementById('editForm');
                form.innerHTML = '';

                for (const [key, value] of Object.entries(record)) {
                    const container = document.createElement('div');
                    container.classList.add('input-container');
                    const label = document.createElement('label');
                    label.textContent = key;
                    label.classList.add('small-label');
                    const input = document.createElement('input');
                    input.type = 'text';
                    input.name = key;
                    input.value = value;
                    container.appendChild(label);
                    container.appendChild(input);
                    form.appendChild(container);
                }

                const submitButton = document.createElement('button');
                submitButton.type = 'submit';
                submitButton.textContent = 'Save';
                form.appendChild(submitButton);

                form.dataset.table = table;
                form.dataset.id = id;

                document.getElementById('editModal').style.display = 'block';
            } else {
                console.error('Error fetching record:', data.error);
            }
        })
        .catch(error => console.error('Error fetching record:', error));
}

    function submitEditForm(event) {
            event.preventDefault();

            const form = event.target;
            const table = form.dataset.table;
            const id = form.dataset.id;
            const formData = new FormData(form);

            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch('update_record.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ table, id, data })
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Record updated successfully.');
                    closeModal();
                    submitForm();
                } else {
                    alert('Failed to update record: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating the record.');
            });
        }
    async function deleteRecord(table, id) {
    if (confirm("Are you sure you want to delete this record?")) {
        try {
            const response = await fetch('delete_record.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ table, id }) // Sending table and id as JSON data
            });
            const result = await response.json();
            if (result.success) {
                alert('Record deleted successfully.');
                changePage(table, 1); // Reload the page or update the table after deletion
            } else {
                alert('Failed to delete record: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while deleting the record.');
        }
    }
}

</script>

</head>
<body>
    <div class="container">
        <h1 class="title">Inventory Management</h1>
        <form id="tableForm" method="POST" action="">
            <div class="form-controls">
                <div class="buttons">
                    <div>
                        <input type="text" name="searchID" placeholder="Search by ID" value="<?= htmlspecialchars($_POST['searchID'] ?? '') ?>" onkeydown="if (event.key === 'Enter') { this.form.submit(); return false; }">
                    </div>
                </div>
                <select id="tableSelect" name="tableSelect" onchange="this.form.submit()">
                    <option value="products" <?= isset($_POST['tableSelect']) && $_POST['tableSelect'] == 'products' ? 'selected' : '' ?>>Products</option>
                    <option value="category" <?= isset($_POST['tableSelect']) && $_POST['tableSelect'] == 'category' ? 'selected' : '' ?>>Category</option>
                    <option value="supplier" <?= isset($_POST['tableSelect']) && $_POST['tableSelect'] == 'supplier' ? 'selected' : '' ?>>Suppliers</option>
                </select>
            </div>
            <input type="hidden" name="products_page" value="<?= $_POST['products_page'] ?? 1 ?>">
            <input type="hidden" name="category_page" value="<?= $_POST['category_page'] ?? 1 ?>">
            <input type="hidden" name="supplier_page" value="<?= $_POST['supplier_page'] ?? 1 ?>">
        </form>

        <?php
        $conn = new mysqli("127.0.0.1", "root", "", "project");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $selectedTable = $_POST['tableSelect'] ?? 'products';
        $searchID = $_POST['searchID'] ?? '';

        $limit = 10;
        $products_page = $_POST['products_page'] ?? 1;
        $category_page = $_POST['category_page'] ?? 1;
        $supplier_page = $_POST['supplier_page'] ?? 1;

        switch ($selectedTable) {
            case 'products':
                $page = $products_page;
                break;
            case 'category':
                $page = $category_page;
                break;
            case 'supplier':
                $page = $supplier_page;
                break;
            default:
                $page = 1;
                break;
        }

        $offset = ($page - 1) * $limit;

        switch ($selectedTable) {
            case 'products':
                $sql = "SELECT * FROM products WHERE product_id LIKE '%$searchID%' LIMIT $limit OFFSET $offset";
                $countSql = "SELECT COUNT(*) AS count FROM products WHERE product_id LIKE '%$searchID%'";
                break;
            case 'category':
                $sql = "SELECT * FROM category WHERE category_id LIKE '%$searchID%' LIMIT $limit OFFSET $offset";
                $countSql = "SELECT COUNT(*) AS count FROM category WHERE category_id LIKE '%$searchID%'";
                break;
            case 'supplier':
                $sql = "SELECT * FROM supplier WHERE supplier_id LIKE '%$searchID%' LIMIT $limit OFFSET $offset";
                $countSql = "SELECT COUNT(*) AS count FROM supplier WHERE supplier_id LIKE '%$searchID%'";
                break;
            default:
                $sql = "SELECT * FROM products LIMIT $limit OFFSET $offset";
                $countSql = "SELECT COUNT(*) AS count FROM products";
                break;
        }

        $result = $conn->query($sql);
        $countResult = $conn->query($countSql);
        $rowCount = $countResult->fetch_assoc()['count'];

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr>";

            switch ($selectedTable) {
                case 'products':
                    echo "<th>Product ID</th><th>Product Name</th><th>Supplier ID</th><th>Category ID</th><th>Price</th><th>Actions</th>";
                    break;
                case 'category':
                    echo "<th>Category ID</th><th>Category Name</th><th>Actions</th>";
                    break;
                case 'supplier':
                    echo "<th>Supplier ID</th><th>Supplier Name</th><th>Contact Person</th><th>Contact Number</th><th>Actions</th>";
                    break;
            }

            echo "</tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                $idKey = '';
            
                switch ($selectedTable) {
                    case 'products':
                        $idKey = 'product_id';
                        echo "<td>{$row['product_id']}</td><td>{$row['product_name']}</td><td>{$row['supplier_id']}</td><td>{$row['category_id']}</td><td>{$row['price']}</td>";
                        break;
                    case 'category':
                        $idKey = 'category_id';
                        echo "<td>{$row['category_id']}</td><td>{$row['category_name']}</td>";
                        break;
                    case 'supplier':
                        $idKey = 'supplier_id';
                        echo "<td>{$row['supplier_id']}</td><td>{$row['supplier_name']}</td><td>{$row['contact_person']}</td><td>{$row['contact_number']}</td>";
                        break;
                }
            
                echo "<td class='action-buttons'>
                <button onclick=\"editRecord('$selectedTable', '{$row[$idKey]}')\">Edit</button>
                        <button onclick=\"deleteRecord('$selectedTable', '{$row[$idKey]}')\">Delete</button>
                      </td>";
    
                echo "</tr>";
            }
            

            echo "</table>";
        } else {
            echo '<div style="text-align: center; color: black; font-size: 16px; margin-top:50px;">No records found.</div>';
        }

        $totalPages = ceil($rowCount / $limit);

        if ($totalPages > 1) {
            echo "<div class='pagination-container'>";
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i == $page) ? 'active' : '';
                echo "<a href='javascript:void(0)' class='$activeClass' onclick=\"changePage('$selectedTable', $i)\">$i</a>";
            }
            echo "</div>";
        }

        $conn->close();
        ?>

        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Edit Record</h2>
                <form id="editForm" onsubmit="submitEditForm(event)">
                    <!-- Form fields will be dynamically inserted here -->
                </form>
            </div>
        </div>
    </div>

</body>
</html>
