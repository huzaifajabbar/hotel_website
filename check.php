<?php
include_once('connection.php'); // Include your database connection file

function reg_in() {
    global $mysqli; // Make the $mysqli connection object available inside the function

    if (isset($_POST['submit'])) {
        $check_in = filter_var($_POST['in'], FILTER_SANITIZE_STRING); 
        $check_out = filter_var($_POST['out'], FILTER_SANITIZE_STRING);
        $room = filter_var($_POST['room'], FILTER_SANITIZE_STRING);
        $room_type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);

        // Use prepared statements to prevent SQL injection
        $stmt = $mysqli->prepare("INSERT INTO `check` (`check_in`, `check_out`, `room`, `room_type`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $check_in, $check_out, $room, $room_type);

        if ($stmt->execute()) {
            header('Location: thankyou.html');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

if (isset($_POST['submit'])) {
    reg_in();
    //echo ' succesfully inserted';
} else {
    echo 'Not cha';
}
?>