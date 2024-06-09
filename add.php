<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE-edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Form</title>
  <script defer src="app.js"></script>
  <style>
    @import url('https:/fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');
   body {
      background-color: #a1c398;
   }
    .wrapper {
      --input-focus: #FFA2B9;
      --font-color: #323232;
      --font-color-sub: #666;
      --bg-color: #FFA2B9;
      --bg-color-alt: #666;
      --main-color: #323232;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .switch {
      transform: translateY(0);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 30px;
      width: 50px;
      height: 20px;
    }

    .card-side::before {
      position: absolute;
      content: 'Product';
      left: -70px;
      top: 0;
      width: 100px;
      text-decoration: underline;
      color: var(--font-color);
      font-weight: 600;
    }

    .card-side::after {
      position: absolute;
      content: 'Supplier';
      left: 70px;
      top: 0;
      width: 100px;
      text-decoration: none;
      color: var(--font-color);
      font-weight: 600;
    }

    .toggle {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      box-sizing: border-box;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      box-shadow: 4px 4px var(--main-color);
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: var(--bg-color);
      transition: 0.3s;
    }

    .slider:before {
      box-sizing: border-box;
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      border: 2px solid var(--main-color);
      border-radius: 5px;
      left: -2px;
      bottom: 2px;
      background-color: var(--bg-color);
      box-shadow: 0 3px 0 var(--main-color);
      transition: 0.3s;
    }

    .toggle:checked + .slider {
      background-color: var(--input-focus);
    }

    .toggle:checked + .slider:before {
      transform: translateX(30px);
    }

    .toggle:checked ~ .card-side:before {
      text-decoration: none;
    }

    .toggle:checked ~ .card-side:after {
      text-decoration: underline;
    }

    .flip-card__inner {
      width: 300px;
      height: 350px;
      position: relative;
      background-color: transparent;
      perspective: 1000px;
      text-align: center;
      transition: transform 0.8s;
      transform-style: preserve-3d;
    }

    .toggle:checked ~ .flip-card__inner {
      transform: rotateY(180deg);
    }

    .toggle:checked ~ .flip-card__front {
      box-shadow: none;
    }

    .flip-card__front, .flip-card__back {
      padding: 20px;
      position: absolute;
      display: flex;
      flex-direction: column;
      justify-content: center;
      -webkit-backface-visibility: hidden;
      backface-visibility: hidden;
      background: lightgrey;
      gap: 20px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      box-shadow: 4px 4px var(--main-color);
    }

    .flip-card__back {
      width: 100%;
      transform: rotateY(180deg);
    }

    .flip-card__form {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    .title {
      margin: 20px 0 20px 0;
      font-size: 25px;
      font-weight: 900;
      text-align: center;
      color: var(--main-color);
    }

    .flip-card__input {
      width: 250px;
      height: 40px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      background-color: var(--bg-color);
      box-shadow: 4px 4px var(--main-color);
      font-size: 15px;
      font-weight: 600;
      color: var(--font-color);
      padding: 5px 10px;
      outline: none;
    }

    .flip-card__input::placeholder {
      color: var(--font-color-sub);
      opacity: 0.8;
    }

    .flip-card__input:focus {
      border: 2px solid var(--input-focus);
    }

    .flip-card__btn:active, .button-confirm:active {
      box-shadow: 0px 0px var(--main-color);
      transform: translate(3px, 3px);
    }

    .flip-card__btn {
      margin: 20px 0 20px 0;
      width: 120px;
      height: 40px;
      border-radius: 5px;
      border: 2px solid var(--main-color);
      background-color: var(--bg-color);
      box-shadow: 4px 4px var(--main-color);
      font-size: 17px;
      font-weight: 600;
      color: var(--font-color);
      cursor: pointer;
    }

.header {
    padding: 3px;
    display: flex;
    align-items: flex-start;
}
.header p {
    margin-bottom: 0;
    margin-top: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 20px;
    font-weight: bold;
    text-indent: -110px;
    position: left;
}
.header p img  {
    margin-top: auto;
    margin-bottom: 10px;
    margin-right: 100px;
    height: 70px;
    width: 70px;
    position: left;
}

.header a{
    font-style: normal;
    font-family: 'Poppins', sans-serif;
    color: black;
    text-decoration: none;
    margin-top: 12px;
}
  </style>
</head>
<body>
<div class= "header">
    <p><img src="l2.png" alt="Logo"><a href="testing.php">SADE GROCERY</a></p>
  </div>
  <div class="wrapper">
    <div class="card-switch">
      <label class="switch">
        <input type="checkbox" class="toggle">
        <span class="slider"></span>
        <span class="card-side"></span>
        <div class="flip-card__inner">
          <div class="flip-card__front">
            <div class="title">Product & Category</div>
            <form class="flip-card__form" method="POST" action="">
              <input class="flip-card__input" name="category_id" placeholder="Category ID" type="text" step="any">
              <input class="flip-card__input" name="category_name" placeholder="Category Name" type="text">
              <input class="flip-card__input" name="product_id" placeholder="Product ID" type="text">
              <input class="flip-card__input" name="product_name" placeholder="Product Name" type="text">
              <input class="flip-card__input" name="price" placeholder="Price" type="number" step="any">
              <input class="flip-card__input" name="supplier_id" placeholder="Supplier ID" type="text"> <!-- New input field for supplier ID -->
              <button class="flip-card__btn" name="submit_product">ADD</button>
            </form>
          </div>
          <div class="flip-card__back">
            <div class="title">Supplier</div>
            <form class="flip-card__form" method="POST" action="">
              <input class="flip-card__input" name="supplier_id" placeholder="Supplier ID" type="text">
              <input class="flip-card__input" name="supplier_name" placeholder="Supplier Name" type="text">
              <input class="flip-card__input" name="contact_person" placeholder="Contact Person" type="text">
              <input class="flip-card__input" name="contact_number" placeholder="Contact Number" type="tel">
              <button class="flip-card__btn" name="submit_supplier">ADD</button>
            </form>
          </div>
        </div>
      </label>
    </div>   
  </div>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    if (isset($_POST['submit_product'])) {
        // Get form data for products
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name'];
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $supplier_id = $_POST['supplier_id']; // New field

        // Check if category_id exists
        $check_category_sql = "SELECT * FROM category WHERE category_id = '$category_id'";
        $check_category_result = $conn->query($check_category_sql);

        if ($check_category_result->num_rows == 0) {
            // Category ID doesn't exist, alert and halt
            echo '<script>alert("Category ID does not exist.");</script>';
        } else {
            // Category ID exists, check category name spelling
            $category_row = $check_category_result->fetch_assoc();
            if ($category_row['category_name'] != $category_name) {
                // Wrong spelling in category name, alert and halt
                echo '<script>alert("Wrong spelling in category name.");</script>';
            } else {
                // Check if product_id already exists in the category
                $check_product_sql = "SELECT * FROM products WHERE product_id = '$product_id' AND category_id = '$category_id'";
                $check_product_result = $conn->query($check_product_sql);

                if ($check_product_result->num_rows > 0) {
                    // Product already exists in the category, alert and halt
                    echo '<script>alert("Product already exists in the category.");</script>';
                } else {
                    // Insert product into the database
                    $sql = "INSERT INTO products (product_id, product_name, category_id, price, supplier_id) VALUES ('$product_id', '$product_name', '$category_id', '$price', '$supplier_id')"; // Updated SQL query

                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Product Added Successfully.");</script>';
                    } else {
                        echo '<script>alert("Error: ' . $conn->error . '");</script>';
                    }
                }
            }
        }
    }

    if (isset($_POST['submit_supplier'])) {
        // Get form data for suppliers
        $supplier_id = $_POST['supplier_id'];
        $supplier_name = $_POST['supplier_name'];
        $contact_person = $_POST['contact_person'];
        $contact_number = $_POST['contact_number'];
        $password = $supplier_name;

        // Check if supplier_id already exists
        $check_supplier_sql = "SELECT * FROM supplier WHERE supplier_id = '$supplier_id'";
        $check_supplier_result = $conn->query($check_supplier_sql);

        if ($check_supplier_result->num_rows > 0) {
            echo '<script>alert("Supplier ID already exists.");</script>';
        } else {
            // Insert supplier into the database
            $sql = "INSERT INTO supplier (supplier_id, supplier_name, contact_person, contact_number, password) VALUES ('$supplier_id', '$supplier_name', '$contact_person', '$contact_number', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Supplier Added Successfully.");</script>';
            } else {
                echo '<script>alert("Error: ' . $conn->error . '");</script>';
            }
        }
    }

    $conn->close();
}
?>



</body>
</html>