<?php
session_start(); // Start the session

$host = "localhost";
$username = "root";
$password = "";
$database = "conection";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Failed to connect to the database.";
} else {
    // Check if the user is logged in
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        // Fetch shop name corresponding to the logged-in user
        $fetchShopQuery = "SELECT name FROM users WHERE id = '$userId'";
        $resultShop = $conn->query($fetchShopQuery);

        if ($resultShop) {
            $rowShop = $resultShop->fetch_assoc();
            $shop = $rowShop['name'];
            echo "Welcome, $shop!";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $itemName = mysqli_real_escape_string($conn, $_POST['name']);
                $itemAmount = mysqli_real_escape_string($conn, $_POST['Amount']);
            
                $sql = "SELECT item FROM $shop WHERE item = '$itemName'";
            
                $result = $conn->query($sql);
            
                // Check if the query was successful
                if ($result) {
                    if ($result->num_rows > 0) {
                        // If there is a match, update the amount of items in stock
                        $sqlUpdate = "UPDATE $shop SET quantity = quantity + $itemAmount WHERE item = '$itemName'";
                        $conn->query($sqlUpdate);

                        if ($itemAmount == 0) {
                            // If item amount is 0, delete the item
                            $deleteItem = "DELETE from $shop where item='$itemName'";
                            $conn->query($deleteItem);
                        }

                        echo "Item amount updated successfully.";
                    } else {
                        // If no match, insert new data
                        $query = "INSERT INTO $shop (item, quantity) VALUES ('$itemName', '$itemAmount')";

                        if (mysqli_query($conn, $query)) {
                            echo "Data inserted";
                        } else {
                            echo "Failed to insert data: " . mysqli_error($conn);
                        }
                    }
                } else {
                    echo "Query failed: " . mysqli_error($conn);
                }
            }

        } else {
            echo "Failed to fetch shop information: " . $conn->error;
        }
    } else {
        echo "User not logged in.";
    }

    mysqli_close($conn);
}
?>
