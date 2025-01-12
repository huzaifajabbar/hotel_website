<?php
include_once('connection.php');

function reg_in()
{
    if (isset($_POST['submit'])) {
        $rnum = $_POST['rnumber'];
        $ridd = $_POST['rid'];
        $cancel = $_POST['cancel'];

        // Get the mysqli connection object from the included connection.php file
        global $mysqli;

        $query = "INSERT INTO `login` (`room_number`, `room_id`, `cancel`) VALUES ('$rnum', '$ridd', '$cancel')";

        if (mysqli_query($mysqli, $query)) {
            // Redirect to the login.html page using a relative URL
            header('Location: index.html');
            exit();
        } else {
            echo mysqli_error($mysqli);
        }
    }
}

if (isset($_POST['submit'])) {
    reg_in();
    echo 'Successfully inserted';
} else {
    echo 'Submit form not received';
}
?>


