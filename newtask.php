<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);
if($_SERVER['REQUEST_METHOD'] == "POST"){

  $id = $user_data['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $date = $_POST['date'];
  $status = 1;
  $priority = (int)$_POST['priority'];

    if(!empty($title) && !empty($description)){
        $query = "insert into Tasks (UserID, Title, Description, Category, Date, Status, Priority) values ('$id', '$title', '$description', '$category', '$date', '$status', '$priority')";
        mysqli_query($con, $query);
        header("Location: main.php");
        die;
    }
    else{?>
    <script> alert('Please enter valid info') </script>
    <?php
	}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/newTask.css?version5" />
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
    
    <label> Category </label> <br> <select name="category" id="category" required>
        <option value="reading">Reading</option>
        <option value="sports">Sports</option>
        <option value="nutrition">Nutrition</option>
        <option value="entertainment">Entertainment</option>
        <option value="home">Home</option>
        <option value="finance">Finance</option>
        <option value="social">Social</option>
        <option value="outdoor">Outdoor</option>
        <option value="health">Health</option>
        <option value="art">Art</option>
        <option value="meditation">Meditation</option>
        <option value="study">Study</option>
     </select><br><br>
    <label> Date </label> <input type="date" name="date" class="date" value = "<?php echo date('Y-m-d') ?>"><br><br>
    <label> Priority </label> 
    <select required name="priority" id="priority" value="<?php echo $task_data['Priority']; ?>">
      <option value="1"> Low</option>
      <option value="2"> Mid</option>
      <option value="3"> High</option>
    </select> 
    <br><br>
	  <button class="btn" type="submit" class="btn">Register</button> 
  </div> 
  </div>
  </form>
  </body>
</html>
