<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="home.css?version=1" />
  <link rel="stylesheet" href="darkmode.css">
  <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">
  <title>Document</title>
</head>

  <body class="light">
    <input type="checkbox" id="toggle">
    <label class="toggle" for="toggle">
        <i class="bx bxs-sun"></i>
        <i class="bx bx-moon"></i>
        <span class="ball"></span>
    </label>
  <div class="home_whole">
    <div class="home_sidebar">
      <div class="profile">
        <h2><?php echo $user_data['UserName']; ?></h2>
        <h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
        <ul>
          <li><a href="#">Home</span></a></li>
          <li><a href="#">Today</span></a></li>
          <li><a href="#">Upcoming</span></a></li>
          <li><a href="#">History</span></a></li>
          <li><a href="setting.html">Settings</span></a></li>
          <li><a href="manageacc.php">Manage Account</span></a></li>
          <li><a href="front.html">Log out</span></a></li>
        </ul>
      </div>
    </div>
    <div class="home_main">
     <button> <a href="newtask.php?id=<?= $user_data['id']; ?>">Add new</a></button> 
      
<br><br>
    <div class="mainpart">
      <table class="tasktable" border="1" width=80%>
        <thead>
          <tr>
            <th>Task</th>
            <th>Description</th>
            <th>Category</th>
            <th>Date</th>
            <th colspan=2>Time</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Action</th>
          </tr>
        </thead>  
        <tbody>
          <?php
          $id = $user_data['id']; 
          $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid  where UserID = '$id' ";
          $run_query = mysqli_query($con, $query2);
          if(mysqli_num_rows($run_query) > 0){
            foreach($run_query as $row){
              ?>
              <tr>
              <td><?= $row['Title']; ?></td>
              <td><?= $row['Description']; ?></td>
              <td><?= $row['Category']; ?></td>
              <td><?= $row['Date']; ?></td>
              <td><?= $row['Time_H']; ?></td>
              <td><?= $row['Time_M']; ?></td>
              <td><?= $row['Sdes']; ?></td>
              <td><?= $row['Pdes']; ?></td>
              <td>
                <button><a href="edittask.php?id=<?= $row['TaskID']; ?>">Edit</a></button>
                <button><a href="deletetask.php?id=<?= $row['TaskID']; ?>">Delete</a></button>
              </td>
            </tr>
            <?php
            }
          }
          else{
            echo "No tasks pending";
          }
          ?>
        </tbody>
      
      </table>
      
    </div>

    </div>
  </div>
</body>
</html>
<script src="darkmode.js"></script>
