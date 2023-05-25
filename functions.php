<?php

function check_login($con){
	if(isset($_SESSION['id'])){
		$id = $_SESSION['id'];
		$query = "select * from Users where id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0){
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	header("Location: login.php");
	die;
}

function task_list($con){
	if(isset($_SESSION['TaskID'])){
		$tid = $_SESSION['TaskID'];
		$query2 = "select * from Tasks where TaskID = '$tid' limit 1";
		$result2 = mysqli_query($con,$query2);
		if($result2 && mysqli_num_rows($result2) > 0){
			$task_data = mysqli_fetch_assoc($result2);
			return $task_data;
		}
	}
}
