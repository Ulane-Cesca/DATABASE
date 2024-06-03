<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible"content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">

</head>

<body>
  <div class= "header">
    <p><img src="l2.png" alt="Logo"><a href="home.php">SADE GROCERY</a></p>
  </div>

  <div class="values">
      <div class="val-box">
        <i class="fas fa-users"> </i>
          <div>
            <h3>8,267</h3>
            <span>New Users</span>
          </div>
      </div>
      <div class="val-box">
        <i class="fas fa-shopping-cart"> </i>
          <div>
            <h3>200,521</h3>
            <span>Total Orders</span>
          </div>
      </div>
      <div class="val-box">
        <i class="fas fa-acorn"> </i>
          <div>
            <h3>215,542</h3>
            <span>Products Sell</span>
          </div>
      </div>
      <div class="val-box">
        <i class="fas fa-dollar-sign"> </i>
          <div>
            <h3>$677.89</h3>
            <span>This Month</span>
          </div>
      </div>
    </div>

    <div class="container">
        <h2>Dashboard</h2>
        <div class="container_2">
            <div>
                <label for="selection">Information Type:</label>
                <select id="selection">
                    <option value="all" selected>All</option>
                <option value="categories">Categories</option>
                <option value="products">Products</option>
                <option value="suppliers">Suppliers</option>
                </select>
            </div>
           
        </div>
    </div>


    <div id="all">
        <table id="allTable">
        <tr>
                <th>CATEGORY ID</th>
                <th>CATEGORY NAME</th>
                <th>SUPPLIER ID</th>
                <th>SUPPLIER NAME</th>
                <th>CONTACT PERSON</th>
                <th>CONTACT NUMBER</th>
                <th>PRODUCT ID</th>
                <th>PRODUCT NAME</th>
                <th>PRICE</th>
            </tr>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "project";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT c.category_id, c.category_name, p.supplier_id, s.supplier_name, s.contact_person, s.contact_number,  p.product_id, p.product_name, p.price
                            FROM Category c 
                            JOIN Products p ON c.category_id = p.category_id 
                            JOIN Supplier s ON p.supplier_id = s.supplier_id";
                    $result = $conn->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["category_id"] . "</td>";
                            echo "<td>" . $row["category_name"] . "</td>";
                            echo "<td>" . $row["supplier_id"] . "</td>";
                            echo "<td>" . $row["supplier_name"] . "</td>";
                            echo "<td>" . $row["contact_person"] . "</td>";
                            echo "<td>" . $row["contact_number"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["product_name"] . "</td>";
                            echo "<td>" . $row["price"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data found</td></tr>";
                    }
                    $conn->close();
                ?>
        </table>
    </div>

    <div id="categories" style="display:none;">
        
        <table id="categoryTable">
                <tr>
                    <th>CATEGORY ID</th>
                    <th>CATEGORY NAME</th>
                    <th>ACTIONS</th>
                </tr>
                <?php
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "project";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT category_id, category_name FROM Category";
                    $category_result = $conn->query($sql);
                    if ($category_result->num_rows > 0) {
                        while($category_row = $category_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$category_row["category_id"]."</td>";
                            echo "<td>".$category_row["category_name"]."</td>";
                            echo "<td>".
                              "<button>Edit</button>" 
                              ."<button>Delete</button>".
                            "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>No categories found</td></tr>";
                    }
                    $conn->close();
                ?>
        </table>
    </div>

    <div id="products" style="display:none;">
        
        <table id="productTable">
                <tr>
                    <th>PRODUCT ID</th>
                    <th>PRODUCT NAME</th>
                    <th>SUPPLIER ID</th>
                    <th>CATEGORY ID</th>
                    <th>PRICE</th>
                    <th>ACTIONS</th>
                </tr>
                <?php
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "project";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT product_id, product_name, supplier_id, category_id, price FROM Products";
                    $product_result = $conn->query($sql);
                    if ($product_result->num_rows > 0) {
                        while($product_row = $product_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$product_row["product_id"]."</td>";
                            echo "<td>".$product_row["product_name"]."</td>";
                            echo "<td>".$product_row["supplier_id"]."</td>";
                            echo "<td>".$product_row["category_id"]."</td>";
                            echo "<td>".$product_row["price"]."</td>";
                            echo "<td>".
                              "<button>Edit</button>" 
                              ."<button>Delete</button>".
                            "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No products found</td></tr>";
                    }
                    $conn->close();
                ?>
        </table>
    </div>

    <div id="suppliers" style="display:none;">
       
        <table id="supplierTable">
                <tr>
                    <th>SUPPLIER ID</th>
                    <th>SUPPLIER NAME</th>
                    <th>CONTACT PERSON</th>
                    <th>CONTACT NUMBER</th>
                    <th>ACTIONS</th>
                </tr>
                <?php
                    $servername = "127.0.0.1";
                    $username = "root";
                    $password = "";
                    $dbname = "project";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT supplier_id, supplier_name, contact_person, contact_number FROM Supplier";
                    $supplier_result = $conn->query($sql);
                    if ($supplier_result->num_rows > 0) {
                        while($supplier_row = $supplier_result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>".$supplier_row["supplier_id"]."</td>";
                            echo "<td>".$supplier_row["supplier_name"]."</td>";
                            echo "<td>".$supplier_row["contact_person"]."</td>";
                            echo "<td>".$supplier_row["contact_number"]."</td>";
                            echo "<td>".
                              "<button>Edit</button>" 
                              ."<button>Delete</button>".
                            "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No suppliers found</td></tr>";
                    }
                    $conn->close();
                ?>

        </table>
    </div>
</d>

    <script>
        document.getElementById("selection").addEventListener("change", function() {
            var selectedOption = this.value;
            document.getElementById("all").style.display = (selectedOption === "all") ? "block" : "none";
            document.getElementById("categories").style.display = (selectedOption === "categories") ? "block" : "none";
            document.getElementById("products").style.display = (selectedOption === "products") ? "block" : "none";
            document.getElementById("suppliers").style.display = (selectedOption === "suppliers") ? "block" : "none";
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

            if (selectedOption === "all") {
                filterTable("allTable", [0, 2, 4]); // Filter by Category ID, Product ID, Supplier ID in "All" table
            } else if (selectedOption === "categories") {
                filterTable("categoryTable", [0]); // Filter by Category ID in "Categories" table
            } else if (selectedOption === "products") {
                filterTable("productTable", [0]); // Filter by Product ID in "Products" table
            } else if (selectedOption === "suppliers") {
                filterTable("supplierTable", [0]); // Filter by Supplier ID in "Suppliers" table
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
    if (selectedOption === "all") {
        filterTable("allTable", [0, 2, 4]); 
    } else if (selectedOption === "categories") {
        filterTable("categoryTable", [0]); 
    } else if (selectedOption === "products") {
        filterTable("productTable", [0]); 
    } else if (selectedOption === "suppliers") {
        filterTable("supplierTable", [0]); 
    }
    document.getElementById("search_term").value = "";
});

    </script>

</body>
</html>
