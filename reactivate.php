<?php
	session_start();
	include('connection.php');
	echo $_SESSION['id']."<br>".$_GET['uid']."<br>";
	$uid=$_GET['uid'];
	$sql_sel_tran="SELECT * FROM `transaction` WHERE uid=$uid";
	$result=$conn->query($sql_sel_tran);
	if($result->num_rows>0)
	{

		$sql_up_tran="UPDATE `transaction` SET `status`='OPEND' WHERE uid=$uid";
		$result_up_tran=$conn->query($sql_up_tran);
		if($result_up_tran===TRUE)
		{
			header("location:all_detailes.php?up=resuc&uid=".$uid);
		}
		else
		{
			echo $conn->error;
		}
	}
	else
	{
		echo "Not Ok";
	}
?>