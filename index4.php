<?php
// $insert = false;
if(isset($_POST['name'])){
    // Set connection variables
    $server = "localhost";
    $username = "root";
    $password = "";

    // Create a database connection
    $con = mysqli_connect($server, $username, $password);

    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";
    

    // Collect post variables
    $enrollment_no = $_POST['enrollment_no'];
    $enrollment_year = $_POST['enrollment_year'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room_no = $_POST['room_no'];
    $room_type = $_POST['room_type'];
    
    $sql = "INSERT INTO `Host_management`.`allocate_room` (`enrollment_no`,`enrollment_year`, `name`,`email`, `phone`, `room_no`,`room_type`) VALUES ('$enrollment_no', '$enrollment_year', '$name', '$email', '$phone','$room_no','$room_type');";
    //database table name
    // echo $sql;

    // Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        // Flag for successful insertion
        // $insert = true;
        header("Location: index3.php");
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warden Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Enter the deails of student to allocate room</h2>
        <form action="index4.php" method="post">
            <div class="form-group">
                <label for="username">Enrollment No:</label>
                <input type="text" id="enrollment_no" name="enrollment_no" required>
            </div>
            <div class="form-group">
                <label for="username">Enrollment Year:</label>
                <input type="text" id="enrollment_year" name="enrollment_year" required>
            </div>
            <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Email:</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">Phone no:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="username">Room no:</label>
                <input type="text" id="room_no" name="room_no" required>
            </div>
            <div class="form-group">
                <label for="username">Room Type:</label>
                <input type="text" id="room_type" name="room_type" required>
            </div>
            
            <button type="submit">Add Student</button>
        </form>
    
    </div>
    <script src="login.js"></script>
</body>
</html>
