<?php
// define variables and set to empty values
$nameErr = $surnameErr = $emailErr = $genderErr = $creditcardErr = $passwordErr = "";
$name = $surname = $email = $gender = $creditcard = $password = $finalpass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["surname"])) {
    $surnameErr = "Name is required";
  } else {
    $surname = test_input($_POST["surname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
      $surnameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "A strong password is required";
  } else {
    $password = test_input($_POST["password"]);
    if (!preg_match("^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$",$password)) {
      $passwordErr = "Password must be a minimum of eight characters, at least one letter, one number and one special character.";
    }
  }

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["creditcard"])) {
    $creditcard = "";
  } else {
    $creditcard = test_input($_POST["creditcard"]);
    // check if card type is valid
    if (!preg_match("^(?:4[0-9]{12}(?:[0-9]{3})?|[25][1-7][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$",$creditcard)) {
      $creditcardErr = "Invalid card type";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } elseif ($_POST["gender"] == "undefined") {
    $genderErr = "We don't sell shit to apache helicopters and stuff...";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

$password .= "1337H@x0r$";
$finalpass = password_hash($password, PASSWORD_DEFAULT);

// sign up to db
$servername = "localhost";
$username = "root";
$dbpassword = "";
$db = "biosolutions";

// Create connection
$conn = new mysqli($servername, $username, $dbpassword, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO clients (name, surname, passwd, email, creditcard, gender) VALUES ($name, $surname, $finalpass, $email, $creditcard, $gender);";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
