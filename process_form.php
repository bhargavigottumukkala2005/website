<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data here
    $name = $_POST["name"];
    $email = $_POST["email"];
    $passwordgiven = $_POST["password"];

    // Example: Display the submitted data
    echo "Name  testadfasdfadfsadfasdf: $name<br>";
    echo "Email: $email";
    echo "password: $passwordgiven";

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

$sql = "SELECT * FROM userdata where username = '$name'";
$result = $conn->query($sql);
// Check if a matching user was found
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $passworddb= $row['password'];
    echo "ttttttttt: $passworddb";
    $hashedPassword = password_hash($passworddb, PASSWORD_BCRYPT);
    // Compare the entered password with the hashed password from the database
    if (password_verify($passwordgiven, $hashedPassword)) {
        echo "Login successfullll!";
        header("Location: /website/index.php"); // Change '/home.php' to the actual path of your home page

// Make sure that code below the header() function is not executed
exit;
    } else {
        echo "Incorrect password.dd";
        session_start();
        $_SESSION['login_error'] = "Invalid username or password. Please try again.";
    header("Location: /website/login.php"); // Redirect back to the login page
    exit;
    }
} else {
    echo "User not found.";
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