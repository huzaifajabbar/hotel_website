<?php
include_once('connection.php'); // Include your database connection file

function reg_in() {
    global $mysqli; // Make the $mysqli connection available inside the function

    if (isset($_POST['submit'])) {
        $feedback = filter_var($_POST['feedback'], FILTER_SANITIZE_STRING); // Sanitize input

        // Use prepared statements to prevent SQL injection
        $stmt = $mysqli->prepare("INSERT INTO `feedback` (`feedback`) VALUES (?)");
        $stmt->bind_param("s", $feedback); // "s" indicates a string parameter

        if ($stmt->execute()) {
            header('Location: thankyou.html'); // Redirect to a success page
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

if (isset($_POST['submit'])) {
    reg_in();
    echo 'Successfully inserted';
} else {
    echo 'Submit form not received';
}
?>