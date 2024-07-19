<?php
$check=false;

if(isset($_POST['name'])){

    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "Host_management"; // your database name

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database);

    // Check for connection success
    if(!$con){
        die("Connection to the database failed due to: " . mysqli_connect_error());
    }

    // Collect post variables
    $username = $_POST['name']; // change to 'name' to match the input name
    $password = $_POST['password'];

    // Secure the input
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    // Prepare SQL query to fetch user details
    $sql = "SELECT * FROM warden WHERE username='$username' AND password='$password'";
    $result = mysqli_query($con, $sql);

    // Check if user exists
    if(mysqli_num_rows($result) > 0){
        // User found, redirect to dashboard or whatever page you want
        header("Location: index3.php"); // Redirect to dashboard page
        exit();
    } else {
        // User not found, set $check to true to display error message
        $check = true;
    }

    // Close the database connection
    mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Warden Login</h2>
        <!-- Display error message only when $check is true -->
        <?php if($check): ?>
            <div class="error-message">Incorrect username or password!</div>
        <?php endif; ?>
        <form action="" method="post"> <!-- Change action to current page -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="name" name="name" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit">Login</button>
        </form>
      
    </div>
    <script src="login.js"></script>
</body>
</html>
