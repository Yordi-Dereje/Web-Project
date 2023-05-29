<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="report.css?version1" />
  </head>
  <body>
    <div class="mainpart">
      <h2> Completed tasks </h2>
      <?php
          $id = $user_data['id'];
          $query2 = "select * from Tasks join Status_table on Tasks.Status=Status_table.Sid join Priority_table on Tasks.Priority=Priority_table.Pid  where UserID = '$id' and Status = 3 order by Date desc";
          $run_query = mysqli_query($con, $query2);
          if(mysqli_num_rows($run_query) > 0){
            foreach($run_query as $row){
              ?>
              <div class="disp">
                <div class="ldisp">
                  <div class="datediv"><?= $row['Date']; ?></div>
                  <div class="titlediv"><?= $row['Title']; ?>: <?= $row['Description']; ?></div>
                </div>
                <div class="rdisp">
                  <div class="categorydiv">Category: <?= $row['Category']; ?></div>
                  <div class="prioritydiv"><?= $row['Pdes']; ?> priority</div>
                </div>
              </div>
        <?php
            }
          }
          else{
            echo "No completed task yet";
          }
          ?>
  </div>


  
  </body>
</html>
