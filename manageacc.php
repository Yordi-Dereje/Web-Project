<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST"){
$id = $user_data['id']; 
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$user_name = $_POST['user_name'];
$password = $_POST['password'];
if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone) && !empty($user_name) && !empty($password)){
		$query = "update Users set FirstName='$first_name', LastName='$last_name', Email='$email', Phone='$phone', UserName='$user_name', Password='$password' where id='$id';";
	  mysqli_query($con, $query);
		header("Location: index.php");
		die;
	}
	else{
		echo "Please enter valid info";
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage account</title>
</head>
<body>
    <div id="box">
	<form method="post">
    <div style="font-size: 20px;margin: 10px;">Manage your account</div>
    First name: <input type="text" name="first_name" value="<?php echo $user_data['FirstName']; ?>"><br><br>
    Last name: <input type="text" name="last_name" value="<?php echo $user_data['LastName']; ?>" ><br><br>
    Email: <input type="text" name="email" value="<?php echo $user_data['Email']; ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $user_data['Phone']; ?>"><br><br>
		User name: <input type="text" name="user_name" value="<?php echo $user_data['UserName']; ?>"><br><br>
		Password: <input type="text" name="password" value="<?php echo $user_data['Password']; ?>"><br><br>
		<input type="submit" value="Confirm"><br><br>
		<a href="index.php">Back</a>
    
</body>
</html>
