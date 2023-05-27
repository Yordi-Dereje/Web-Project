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
  <link rel="stylesheet" href="temphome.css?version1" />
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
          if(mysqli_num_rows($run_query) > 0){
            foreach($run_query as $row){
              ?>
              <div class="disp" onclick="location.href='edittask.php?id=<?= $row['TaskID']; ?>';">
                <div class="leftdiv">
                  <div class="datediv"><?= $row['Date']; ?></div>
                  <div class="titlediv"><?= $row['Title']; ?></div>
                  <div class="categorydiv"><?= $row['Category']; ?></div>
                </div>
                <div class="rightdiv">
                  <div class="prioritydiv"><?= $row['Pdes']; ?> priority</div>
                  <div class="statusdiv"><?= $row['Sdes']; ?></div>
                </div>
              </div>
        <?php
            }
          }
          else{
            echo "No tasks pending";
          }
          ?>


  </div>
</body>
</html>
