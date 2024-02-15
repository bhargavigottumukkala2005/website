<?php
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "mysql";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection (optional, as PDO closes the connection automatically when the script ends)
$conn = null;
?>