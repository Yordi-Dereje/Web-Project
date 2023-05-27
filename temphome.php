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
  <link rel="stylesheet" href="temphome.css" />
  <title>Home page</title>
</head>
<body>
  <div class="whole">
    <div class="sidebar">
      <div class="profile">
        <h2><?php echo $user_data['UserName']; ?></h2>
        <h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
        <ul>
          <li><a href="temphome.php">Today</span></a></li>
          <li><a href="newtask.php">New task</span></a></li>
          <li><a href="#">Upcoming</span></a></li>
          <li><a href="#">History</span></a></li>
          <li><a href="setting.html">Settings</span></a></li>
          <li><a href="manageacc.php">Manage Account</span></a></li>
          <li><a href="front.html">Log out</span></a></li>
        </ul>
      </div>
    </div>

    <div class="mainpart">
      <p> This is the main display part </p>
<!-- compare date to todays date and display only that and also arrange using priority -->
      <?php
          $id = $user_data['id']; 
          $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid  where UserID = '$id' ";
          $run_query = mysqli_query($con, $query2);
          if(mysqli_num_rows($run_query) > 0){?>
          <table class="tasktable" border="1" width=80%>
            <thead>
              <tr>
                <th>Task</th>
                <th>Description</th>
                <th>Category</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Action</th>
              </tr>
            </thead>  
          <tbody>

                    <?php
            foreach($run_query as $row){
              ?>
              <tr>
              <td><?= $row['Title']; ?></td>
              <td><?= $row['Description']; ?></td>
              <td><?= $row['Category']; ?></td>
              <td><?= $row['Date']; ?></td>
              <td><?= $row['Time_H']; ?></td>
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
</body>
</html>
