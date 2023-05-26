<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $id = $user_data['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $date = $_POST['date'];
  $timeH = (int)$_POST['time_h'];
  $status = 1;
  $priority = (int)$_POST['priority'];

    if(!empty($title) && !empty($description)){
        $query = "insert into Tasks (UserID, Title, Description, Category, Date, Time_H, Time_M, Status, Priority) values ('$id', '$title', '$description', '$category', '$date', '$timeH', '$timeM', '$status', '$priority')";
        mysqli_query($con, $query);
        header("Location: home.html");
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
    <link rel="stylesheet" href="newTask.css">
    <title>My website</title>
</head>
<body>
  <div class="wrapper">
    <div class="form-box">
      <h2> Add task </h2>
      <form method="post">
        <div class="input-box">
          <input  type="text" required name="title" value="">
          <label for="title">Title</label>
        </div>
        <div class="input-box">
          <input  type="text" required name="description" value="">
          <label for="description">Description</label>
        </div>
    
    Category: <br> <input type="radio" name="category" value="reading"> Reading <input type="radio" name="category" value="sports"> Sports <input type="radio" name="category" value="Nutrition"> Nutrition <br>
      <input type="radio" name="category" value="entertainment"> Entertainment <input type="radio" name="category" value="home"> Home <input type="radio" name="category" value="finance"> Finance <br>
      <input type="radio" name="category" value="social"> Social <input type="radio" name="category" value="outdoor"> Outdoor <input type="radio" name="category" value="health"> Health <br>
<input type="radio" name="category" value="art"> Art <input type="radio" name="category" value="meditation"> Meditation <input type="radio" name="category" value="study"> Study <br><br>
    Date: <input type="date" name="date"><br><br>
    Time: <input type="time" name="time_h"> <br><br>
    Priority: <br> <input type="radio" name="priority" value="1"> Low  <input type="radio" name="priority" value="2"> Mid <input type="radio" name="priority" value="3"> High <br><br>
	  <button class="btn" type="submit" class="btn">Register</button> 
  </div>
  <!-- <button class="btn" type="submit" class="btn">Register</button> -->
  </div>
  </form>
  </body>
</html>