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
            $_SESSION['shop_name'] = $shop; // Store shop name in session

            echo "Welcome, $shop!";

            // Fetch all data from the shop's table
            $fetchDataQuery = "SELECT * FROM $shop";
            $resultData = $conn->query($fetchDataQuery);

            if ($resultData) {
                echo "<h2>Shop Data</h2>";
                echo "<table border='1'>";
                echo "<tr><th>ID</th><th>Item</th><th>Quantity</th></tr>";

                while ($rowData = $resultData->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $rowData['id'] . "</td>";
                    echo "<td>" . $rowData['item'] . "</td>";
                    echo "<td>" . $rowData['quantity'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "Failed to fetch shop data: " . $conn->error;
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
