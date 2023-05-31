<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($user_name) && !empty($password)){
		$query = "select * from Users where UserName = '$user_name' limit 1";
		$result = mysqli_query($con, $query);

		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			if($user_data['Password'] === $password){
				$_SESSION['id'] = $user_data['id'];
				header("Location: temphome.php");
				die;
			}
      else{?>
        <script>alert('Wrong username or password')</script>
       <?php
			}
		}
		else{
			echo "Please enter some valid information!";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/login.css">
  <title>Document</title>
</head>
<body class="login_body">
  <header class="login_header">
    <nav>
      <h2>TASKMATE</h2>
      <ul>
        <li><a href="front.html">Home</a></li>
        <li><a href="signup.php">Sign up</a></li>
      </ul>
    </nav>
  </header>
<div class="wrapper">
  <div class="form-box">
   <h2>Login</h2>
   <form method="post">
    <div class="input-box">
    <input type="text" required name="user_name" value="">
    <label for="userName">UserName</label>
    </div>
    <div class="input-box">
    <input type="password" required name="password" value="">
    <label for="pwd">Password</label>
</div>
<button class="btn" type="submit" class="btn">Login</button>
</div>

    
   </form>
</div>
</div>
      <!-- <a href="home.html">Login</a> -->
    

</body>
</html>
