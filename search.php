<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
     // Retrieve the value of the dropdown
     $selectedOption = $_POST["dropdown"];
     // Use the selected value as needed
     echo "Selected option: " . $selectedOption;

    
    $servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "mysql";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM searchstates where statecode = '$selectedOption'";
$result = $conn->query($sql);
// Check if a matching user was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $description= $row['description'];
    $state= $row['state'];
    echo "ttttttttt: $description";
    // Compare the entered password with the hashed password from the database
        echo "Login successfullll!";
        header("Location: /website/$state.html"); // Change '/home.php' to the actual path of your home page

// Make sure that code below the header() function is not executed
exit;
    
} else {
    echo "state data not found.";
}



// // SELECT statement
// $sql = "SELECT username, email FROM userdata where username = '$name'";
// $result = $conn->query($sql);

// // Check if the SELECT statement was successful
// if ($result) {
//     // Fetch data and output
//     while ($row = $result->fetch_assoc()) {
//         echo "userfname: " . $row["username"] . ", email: " . $row["email"] . "<br>";

//     }
// } else {
//     echo "Error executing SELECT statement: " . $conn->error;
// }

// Close the connection
$conn->close();
}
?>