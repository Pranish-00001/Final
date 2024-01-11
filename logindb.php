<?php
session_start(); // Start the session

$host = "localhost";
$username = "root";
$password = "";
$database = "conection";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Failed";
} else {
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Verify the password
                $storedPassword = $row['pw'];

                if (password_verify($password, $storedPassword)) {
                    // Password is correct, login successful
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_email'] = $row['email'];

                    mysqli_free_result($result); // Free the result set

                    // Redirect to item form handling page
                    header('Location: http://localhost:3000/Form.php');
                    exit();
                } else {
                    // Incorrect password
                    echo "Incorrect password!";
                }
            } else {
                // Email not found
                echo "Email not found!";
            }
        } else {
            // Query failed
            echo "Query failed: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>