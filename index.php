<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "project";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from form and sanitize inputs
    $username_input = $conn->real_escape_string($_POST['username']);
    $password_input = $conn->real_escape_string($_POST['password']);

    // Check if username and password match admin credentials
    if ($username_input === "admin" && $password_input === "password") {
        // Redirect to main page for admin
        header("Location: home.php");
        exit();
    }

    // SQL query to fetch supplier data from database
    $sql = "SELECT supplier_id, password, supplier_name, contact_person, contact_number
            FROM Supplier
            WHERE supplier_id = '$username_input' AND password = '$password_input'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful for supplier
        $supplier = $result->fetch_assoc();

        // Store supplier data in session
        $_SESSION['supplier'] = $supplier;

        // Redirect to supplier main page
        header("Location: info.php");
        exit();
    } else {
        // Login failed, set a flag to trigger an alert
        $login_failed = true;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p><img src="l2.png" alt="Logo"><a href="#">SADE GROCERY</a></p>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav> 
    <div class="form-box">
        <div class="login-container" id="login">
            <div class="top">
                <header>Login</header>
            </div>
            <form method="POST" action="">
                <div class="input-box">
                    <input type="text" class="input-field" name="username" placeholder="Supplier ID" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password" required>
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Log In">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="login-check">
                        <label for="login-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Forgot password?</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   

<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script>

<script>

    var a = document.getElementById("loginBtn");
    var x = document.getElementById("login");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

</script>

</body>
</html>