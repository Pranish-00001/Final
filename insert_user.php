<?php
$host = 'localhost';
$username = "root";
$password = "";
$database = "conection";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Failed";
} else {
    $shopname = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $userQuery = "INSERT INTO users (name, email, pw) VALUES ('$shopname', '$email', '$hashedPassword')";

    if (mysqli_query($conn, $userQuery)) {
        echo "User registered successfully";

        // Create a table for the user with shop name
        $createTableQuery = "CREATE TABLE $shopname (
            id INT PRIMARY KEY AUTO_INCREMENT,
            item VARCHAR(255) NOT NULL,
            quantity INT NOT NULL
        )";

        if (mysqli_query($conn, $createTableQuery)) {
            echo "Table for shop created successfully";
        } else {
            echo "Error creating shop table: " . mysqli_error($conn);
        }

    } else {
        echo "Error registering user: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    header('Location: login.php');
}
?>
