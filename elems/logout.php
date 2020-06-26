<?php
	session_start();
	session_destroy();
	include '../elems/init.php';
	$query = "UPDATE registration SET status_active = '0'";
	mysqli_query($link, $query) or die(mysqli_error($link));
	
	$query = "DELETE FROM table_time";
	mysqli_query($link, $query) or die(mysqli_error($link));
	
	header("Location: ../index.php");	
	exit;
?>
