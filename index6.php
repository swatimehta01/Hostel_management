<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Room Availability</title>
    <link rel="stylesheet" href="style6.css">
</head>
<body>
    <div class="container">
        <h1>Check Room Availability</h1>
        <form method="POST" action="">
            <label for="room_type">Filter by Room Type:</label>
            <select name="room_type" id="room_type">
                <option value="">All</option>
                <option value="single">Single</option>
                <option value="double">Double</option>
            </select>
            <button type="submit">Check Availability</button>
        </form>

        <?php
        // Database connection parameters
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "Host_management";

        // Create a database connection
        $con = mysqli_connect($server, $username, $password, $database);

        // Check for connection success
        if (!$con) {
            die("Connection to the database failed due to: " . mysqli_connect_error());
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Initialize variables
            $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : "";

            // Construct the SQL query to fetch all rooms based on selected type
            if (!empty($room_type)) {
                $sql = "SELECT room_no FROM allocate_room WHERE room_type = '$room_type'";
                $result = mysqli_query($con, $sql);

                // Check for query execution success
                if (!$result) {
                    die("Error executing the query: " . mysqli_error($con));
                }

                // Check if there are any results
                if (mysqli_num_rows($result) > 0) {
                    // Display the room numbers
                    echo "<div class='result'>";
                    echo "<h2>All these " . ucfirst($room_type) . " rooms are not available</h2>";
                    echo "<ul>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>" . $row['room_no'] . "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<div class='result'>No $room_type rooms found</div>";
                }
            }
        }

        // Close the database connection
        mysqli_close($con);
        ?>

    </div>
</body>
</html>
