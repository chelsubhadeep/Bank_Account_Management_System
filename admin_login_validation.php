<?php
	session_start();
	include('connection.php');
	$admin_id=$_REQUEST['admin_id'];
	$psw=$_REQUEST['psw'];
	$sql="SELECT * FROM `admin_info` WHERE admin_id='$admin_id' AND password='$psw'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$_SESSION['id']=$row['id'];
		echo $_SESSION['id'];
		header("location:all_detailes.php?id=".$_SESSION['id']);
	}
	else
	{
		header("location:admin_login.php?pwd=no");
	}
	$conn->close();
?>
