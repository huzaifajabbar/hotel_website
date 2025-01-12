<?php
include('connection.php'); // Include your database connection file

function reg_in() {
    global $mysqli; // Make the $mysqli connection object available inside the function

    if (isset($_POST['submit'])) {
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $mob = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT); // Sanitize mobile number
        $check_in = filter_var($_POST['in'], FILTER_SANITIZE_STRING);
        $check_out = filter_var($_POST['out'], FILTER_SANITIZE_STRING);
        $rm = filter_var($_POST['room'], FILTER_SANITIZE_STRING);
        $room_type = filter_var($_POST['type'], FILTER_SANITIZE_STRING);

        // Use prepared statements to prevent SQL injection
        $stmt = $mysqli->prepare("INSERT INTO `book` (`name`, `email`, `mobile_no`, `check_in`, `check_out`, `room`, `room_type`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $name, $email, $mob, $check_in, $check_out, $rm, $room_type);

        if ($stmt->execute()) {
            header('Location: payment.html');
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
    echo 'Not book';
}
?>