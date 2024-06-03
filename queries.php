<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>h2 {text-indent: 75px;}</style>
    <link rel="stylesheet" type="text/css" href="queries.css">
    <title>QUERIES</title>
</head>

<body>
  <div class= "header">
    <p><img src="l2.png" alt="Logo"><a href="home.php">SADE GROCERY</a></p>
    </div>
    
    <div class="container">
    <h2></h2>
    <div class="container_2">
        <div>
            <label for="selection">Query Type:</label>
            <select id="selection">
                <option value="prod_cat">Product and Category</option>
                <option value="prod_sup">Product and Supplier</option>
            </select>
            <label for="search_term">Search:</label>
            <input type="text" id="search_term" name="search_term">
            <input type="button" id="search_button" value="Search">
        </div>
    </div>


    <div id="prod_cat">
        <h2>Product and Category</h2>
        <table id="pcTable">
        <thead>
            <tr>
                <th>PRODUCT ID</th>
                <th>PRODUCT NAME</th>
                <th>CATEGORY ID</th>
                <th>CATEGORY NAME</th>
                <th>PRICE</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "project";

            // Create connection
            $conn = mysqli_connect($servername, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // SQL query to fetch data for product and category
            $sql = "SELECT p.product_id, p.product_name, c.category_id, c.category_name, p.price
                    FROM Products p
                    JOIN Category c ON p.category_id = c.category_id";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["product_id"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["category_name"] . "</td>";
                    echo "<td>" . $row["price"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No data found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
        </table>
    </div>

    <div id="prod_sup" style="display:none;">
        <h2>Product and Supplier</h2>
        <table id="psTable">
            <thead>
                <tr>
                    <th>PRODUCT ID</th>
                    <th>PRODUCT NAME</th>
                    <th>PRICE</th>
                    <th>SUPPLIER ID</th>
                    <th>SUPPLIER NAME</th>
                    <th>CONTACT PERSON</th>
                    <th>CONTACT NUMBER</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                   
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT p.product_id, p.product_name, p.price, s.supplier_id, s.supplier_name, s.contact_person, s.contact_number
                        FROM Products p
                        JOIN Supplier s ON p.supplier_id = s.supplier_id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["product_id"] . "</td>";
                        echo "<td>" . $row["product_name"] . "</td>";
                        echo "<td>" . $row["price"] . "</td>";
                        echo "<td>" . $row["supplier_id"] . "</td>";
                        echo "<td>" . $row["supplier_name"] . "</td>";
                        echo "<td>" . $row["contact_person"] . "</td>";
                        echo "<td>" . $row["contact_number"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("selection").addEventListener("change", function() {
            var selectedOption = this.value;
            document.getElementById("prod_cat").style.display = (selectedOption === "prod_cat") ? "block" : "none";
            document.getElementById("prod_sup").style.display = (selectedOption === "prod_sup") ? "block" : "none";
        });

        document.getElementById("search_button").addEventListener("click", function() {
            var searchTerm = document.getElementById("search_term").value.toLowerCase();
            var selectedOption = document.getElementById("selection").value;

            function filterTable(tableId, columns) {
                var table, tr, td, i, txtValue, shouldDisplay;
                table = document.getElementById(tableId);
                tr = table.getElementsByTagName("tr");
                for (i = 1; i < tr.length; i++) {
                    shouldDisplay = false;
                    for (var j = 0; j < columns.length; j++) {
                        td = tr[i].getElementsByTagName("td")[columns[j]];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toLowerCase().indexOf(searchTerm) > -1) {
                                shouldDisplay = true;
                                break;
                            }
                        }
                    }
                    tr[i].style.display = shouldDisplay ? "" : "none";
                }
            }
            if (selectedOption === "prod_cat") {
                filterTable("pcTable", [0, 2, 4]); 
            } else if (selectedOption === "prod_sup") {
                filterTable("psTable", [0]); 
            } 
        });
        document.getElementById("search_button").addEventListener("click", function() {
    var searchTerm = document.getElementById("search_term").value.toLowerCase();
    var selectedOption = document.getElementById("selection").value;

    function filterTable(tableId, columns) {
        var table, tr, td, i, txtValue, shouldDisplay;
        table = document.getElementById(tableId);
        tr = table.getElementsByTagName("tr");
        for (i = 1; i < tr.length; i++) {
            shouldDisplay = false;
            for (var j = 0; j < columns.length; j++) {
                td = tr[i].getElementsByTagName("td")[columns[j]];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(searchTerm) > -1) {
                        shouldDisplay = true;
                        break;
                    }
                }
            }
            tr[i].style.display = shouldDisplay ? "" : "none";
        }
    }

    if (selectedOption === "prod_cat") {
        filterTable("pcTable", [0, 2, 4]); 
    } else if (selectedOption === "prod_sup") {
        filterTable("psTable", [0]); 
    } 

    document.getElementById("search_term").value = "";
});

    </script>

</body>
</html>