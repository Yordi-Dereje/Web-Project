<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET["id"])){
      header("Location: temphome.php");
      die;
    }

    $tid = $_GET["id"];
    $query0 = "select * from Tasks where TaskID='$tid' limit 1";
    $result0 = mysqli_query($con, $query0);

    if($result0 && mysqli_num_rows($result0) > 0){
      $task_data = mysqli_fetch_assoc($result0);
    }

}


if($_SERVER['REQUEST_METHOD'] == "POST"){
    $tid = $_GET["id"];
    $title = $_POST['title'];
    $description = $_POST['description']; 
    $category = $_POST['category'];
    $date = $_POST['date'];
    $status = (int)$_POST['status'];
    $priority = (int)$_POST['priority'];
  
      if(!empty($title)){
          $query = "update Tasks set Title='$title', Description='$description', Category='$category', Date='$date', Status='$status', Priority='$priority' where TaskID='$tid'";
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
    <link rel="stylesheet" href="newTask.css">
    <title>My website</title>
</head>
<body>
  <div class="wrapper">
    <div class="form-box">
      <h2> Details </h2>
      <form method="post">
        <div class="input-box">
          <input  type="text" required name="title" value="<?php echo $task_data['Title']; ?>">
          <label for="title">Title</label>
        </div>
        <div class="input-box">
          <input  type="text" required name="description" value="<?php echo $task_data['Description']; ?>">
          <label for="description">Description</label>
        </div>

	    Category: 
      <select name="category" id="category" required>
        <option value="reading" <?php if ($task_data['Category'] == 'reading') echo 'selected="selected"'?> >Reading</option>
        <option value="sports" <?php if ($task_data['Category'] == 'sports') echo 'selected="selected"'?> >Sports</option>
        <option value="nutrition" <?php if ($task_data['Category'] == 'nutrition') echo 'selected="selected"'?> >Nutrition</option>
        <option value="entertainment" <?php if ($task_data['Category'] == 'entertainment') echo 'selected="selected"'?> >Entertainment</option>
        <option value="home" <?php if ($task_data['Category'] == 'home') echo 'selected="selected"'?> >Home</option>
        <option value="finance" <?php if ($task_data['Category'] == 'finance') echo 'selected="selected"'?> >Finance</option>
        <option value="social" <?php if ($task_data['Category'] == 'social') echo 'selected="selected"'?> >Social</option>
        <option value="outdoor" <?php if ($task_data['Category'] == 'outdoor') echo 'selected="selected"'?> >Outdoor</option>
        <option value="health" <?php if ($task_data['Category'] == 'health') echo 'selected="selected"'?> >Health</option>
        <option value="art" <?php if ($task_data['Category'] == 'art') echo 'selected="selected"'?> >Art</option>
        <option value="meditation" <?php if ($task_data['Category'] == 'meditation') echo 'selected="selected"'?> >Meditation</option>
        <option value="study" <?php if ($task_data['Category'] == 'study') echo 'selected="selected"'?> >Study</option>
     </select>
    <br><br>
    Date: <input required type="date" name="date" value="<?php echo $task_data['Date']; ?>"><br><br>
    Status: 
      <select required name="status" id="status" value="<?php echo $task_data['Status']; ?>">
        <option value="1" <?php if ($task_data['Status'] == 1) echo 'selected="selected"'?> >not started</option>
        <option value="2" <?php if ($task_data['Status'] == 2) echo 'selected="selected"'?> >on progress</option>
        <option value="3" <?php if ($task_data['Status'] == 3) echo 'selected="selected"'?> >completed</option> 
      </select>
    <br><br> 
    Priority: 
      <select required name="priority" id="priority" value="<?php echo $task_data['Priority']; ?>">
        <option value="1" <?php if ($task_data['Priority'] == 1) echo 'selected="selected"'?> >Low</option>
        <option value="2" <?php if ($task_data['Priority'] == 2) echo 'selected="selected"'?> >Mid</option>
        <option value="3" <?php if ($task_data['Priority'] == 3) echo 'selected="selected"'?> >High</option>
      </select>
    <br><br>
	 <button class="btn" type="submit">Update</button>
  </form>
  </div>
  </div>
  </body>
</html>
