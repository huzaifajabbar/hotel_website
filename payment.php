<?php
include_once('connection.php'); // Include the connection file

function reg_in() {
    if (isset($_POST['submit'])) {
        // Sanitize user input to prevent SQL injection
        $card_type = mysqli_real_escape_string($conn, $_POST['type']);
        $month = mysqli_real_escape_string($conn, $_POST['month']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $card_no = mysqli_real_escape_string($conn, $_POST['num']);
        $card_name = mysqli_real_escape_string($conn, $_POST['name']);
        $cvv = mysqli_real_escape_string($conn, $_POST['cvv']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        // Prepare and execute the SQL query
        $sql = "INSERT INTO `payment` (`card_type`, `month`, `year`, `card_no`, `card_name`, `cvv`, `pass`) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $card_type, $month, $year, $card_no, $card_name, $cvv, $pass);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the success page
            header('Location: payment.html');
            exit; // Stop further execution
        } else {
            echo "Error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($stmt);
    }
}

// Call the registration function if the form is submitted
if (isset($_POST['submit'])) {
    reg_in();
} else {
    echo "Not submitted";
}

// Close the database connection
mysqli_close($conn);
?>