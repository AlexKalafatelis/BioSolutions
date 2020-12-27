<?php
if(!empty($_POST["send"])) {
	$Name = $_POST["Name"];
	$Email = $_POST["Email"];
	$Message = $_POST["Message"];
	$content = $_POST["content"];

	$toEmail = "admin@phppot_samples.com";
	$mailHeaders = "From: " . $name . "<". $email .">\r\n";
	if(mail($toEmail, $subject, $content, $mailHeaders)) {
	    $message = "Your contact information is received successfully.";
	    $type = "success";
	}
}
require_once "contact-view.php";
?>


<?php
$conn = mysqli_connect("localhost", "root", "biosolution", "Mail") or die("Connection Error: " . mysqli_error($conn));
mysqli_query($conn, "INSERT INTO tblMail (Name, Email,Message) VALUES ('" . $Name. "', '" . $Email. "','" . $Message. "',)");
$insert_id = mysqli_insert_id($conn);
if(!empty($insert_id)) {
$message = "Your contact information is saved successfully";
?>
