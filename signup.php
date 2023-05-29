<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
  $phone = $_POST['phone'];
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($user_name) && !empty($password)){
		$query = "insert into Users (FirstName, LastName, Email, Phone, UserName, Password) values ('$first_name', '$last_name', '$email', '$phone', '$user_name', '$password')";
	  mysqli_query($con, $query);
		header("Location: login.php");
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
  <link rel="stylesheet" href="styles/signup.css">
  <title>Document</title>
</head>
<body>
  <header>
    <nav>
      <h2>TASKMATE</h2>
      <ul>
        <li><a href="front.html">Home</a></li>
        <li><a href="login.php">SignIn</a></li>
      </ul>
    </nav>
  </header>
  <div class="wrapper">
    <div class="form-box">
      <h2>Register</h2>
        <form method="post">
          <div class="input-box">
            <input  type="text" required name="first_name" value="">
            <label for="firstName">First Name</label>
          </div>
          <div class="input-box">
            <input  type="text" required name="last_name" value="">
            <label for="lastName">Last Name</label>
          </div>
          <div class="input-box">
            <input  type="email" required name="email" value="">
            <label for="email">Email</label>
          </div>
          <div class="input-box">
            <input placeholder="+251" type="tel" maxlength="13" name="phone" id="phone" pattern="[+][0-9]{12}"  value="">
            <label for="phoneNumber">Phone Number</label>
          </div>
          <div class="input-box">
            <input  type="text" required name="user_name" value="">
            <label for="userName">User Name</label>
          </div>
          <div class="input-box">
            <input  type="password" required name="password" value="">
            <label for="pwd">Password</label>
          </div>
          <button class="btn" type="submit" class="btn">Register</button>
        </form>
    </div>
  </div>
</body>
</html>

