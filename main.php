<?php
session_start();

include("db/connection.php");
include("db/functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/main.css?version5" />
  <title>Home page</title>
</head>
<body>
  <div class="whole">
    <div class="sidebar">
      <div class="profile" id="sticky">
      <div class="namepart">
        <h2><?php echo $user_data['UserName']; ?></h2>
        <h4><?php echo $user_data['FirstName'].' '.$user_data['LastName']; ?></h4>
      </div>
      <ul>
          <li><a href="main.php" onclick="toggle()">Home</a></li>
          <li><a href="newtask.php" onclick="toggle()">New task</a></li>
          <li><a href="report.php" onclick="toggle()">Progress report</a></li> 
          <li><a href="manageacc.php" onclick="toggle()">Manage Account</a></li>
          <li><a href="front.html" onclick="toggle()">Log out</a></li>
        </ul>
        <div class="toggle" onclick="toggle()"></div>
    </div>

    <div class="mainpart">
      
      
      <?php
          $id = $user_data['id'];

          $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid where UserID = '$id' and (Status = 1 or Status = 2) order by Status, Priority desc";
          $run_query = mysqli_query($con, $query2);
          if(mysqli_num_rows($run_query) > 0){
            foreach($run_query as $row){
              ?>
              <div class="disp" onclick="location.href='edittask.php?id=<?= $row['TaskID']; ?>';">
                <div class="leftdiv">
                  <div class="datediv"><?= $row['Date']; ?></div>
                  <div class="titlediv"><?= $row['Title']; ?></div>
                  <div class="categorydiv">Category: <?= $row['Category']; ?></div>
 
                </div>
                <div class="rightdiv">
                  <div class="prioritydiv"><?= $row['Pdes']; ?></div>
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
<script src="scripts/stylemain.js"></script>
