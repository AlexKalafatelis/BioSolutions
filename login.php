<?php
$email = $pass ="";
$email = $_POST["email"];
$pass = $_POST["password"];
$pass .= "1337H@x0r$";
$finalpass = password_hash($pass, PASSWORD_DEFAULT);

// sign in to db
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "ALN";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM clients WHERE $email = email AND $finalpass = password";
$result = $conn->query($sql);

echo  $row["id"]. "<br>";

$conn->close();
?>
