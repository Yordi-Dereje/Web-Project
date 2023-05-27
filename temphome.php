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
  <link rel="stylesheet" href="temphome.css?version2" />
  <title>Home page</title>
</head>
<body>
  <div class="whole">
    <div class="sidebar">
      <div class="profile">
        <h2><?php echo $user_data['UserName']; ?></h2>
        <h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
        <ul>
          <li><a href="temphome.php">Home</span></a></li>
          <li><a href="newtask.php">New task</span></a></li>
          <!-- <li><a href="#">Upcoming</span></a></li>
          <li><a href="#">History</span></a></li> -->
          <li><a href="setting.html">Settings</span></a></li>
          <li><a href="manageacc.php">Manage Account</span></a></li>
          <li><a href="front.html">Log out</span></a></li>
        </ul>
      </div>
    </div>

    <div class="mainpart">
      
      
      <?php
          $id = $user_data['id'];
          ?>
          <!-- not working at the moment -->
          <div class="showstatus">
            <button class="allstatus" onclick="<?php $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' order by Priority desc"; 
            $run_query = mysqli_query($con, $query2);
            ?>">All</button>
            <button class="unstarted" onclick="<?php $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' and Status = '1' order by Priority desc"; 
            $run_query = mysqli_query($con, $query2);
            ?>">Unstarted</button>
            <button class="progress" onclick="<?php $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' and Status = '2' order by Priority desc";
            $run_query = mysqli_query($con, $query2);
            ?>">On progress</button>
            <button class="finished" onclick="<?php $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' and Status = '3' order by Priority desc";
            $run_query = mysqli_query($con, $query2);
            ?>">Done</button>
          </div>
          <?php
          $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' order by Priority desc";
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
