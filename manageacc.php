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
		header("Location: temphome.php");
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
    <link rel="stylesheet" href="signup.css">
    <title>Manage account</title>
</head>
<body>  
  <div class="wrapper">
  <div class="form-box">
    <h2>Account details</h2>
    <form method="post">
      <div class="input-box">
<input  type="text" required name="first_name" value="<?php echo $user_data['FirstName']; ?>">
        <label for="firstName">First Name</label>
      </div>
      <div class="input-box">
        <input  type="text" required name="last_name" value="<?php echo $user_data['LastName']; ?>">
        <label for="lastName">Last Name</label>
      </div>
      <div class="input-box">
        <input  type="email" required name="email" value="<?php echo $user_data['Email']; ?>">
        <label for="email">Email</label>
      </div>
      <div class="input-box">
        <input placeholder="+251" type="tel" maxlength="13" name="phone" id="phone" pattern="[+][0-9]{12}"  value="<?php echo $user_data['Phone']; ?>">
        <label for="phoneNumber">Phone Number</label>
      </div>
      <div class="input-box">
        <input  type="text" required name="user_name" value="<?php echo $user_data['UserName']; ?>">
        <label for="userName">User Name</label>
      </div>
      <div class="input-box">
        <input  type="text" required name="password" value="<?php echo $user_data['Password']; ?>">
        <label for="pwd">Password</label>
      </div>
      <button class="btn" type="submit" class="btn">Update</button>
    </form>
  </div>
  </div>

</body>
</html>
