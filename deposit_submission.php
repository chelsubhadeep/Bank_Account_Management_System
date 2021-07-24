<?php
	session_start();
	include('connection.php');
	echo $_SESSION['id']."<br>";
	$uid = $_REQUEST['uid'];
	echo $uid."<br>";
	$damt = $_REQUEST['damt'];
	$sql="INSERT INTO `deposit`(`uid`, `damt`, `status`) VALUES ($uid,$damt,'DEPOSITED')";
	if($conn->query($sql)== TRUE)
	{
		$sql_deposit="SELECT * FROM `deposit` WHERE uid='$uid' ORDER BY did DESC LIMIT 1";
		$did=$conn->query($sql_deposit)->fetch_assoc()['did'];
		echo $did."<br>";
		echo $uid."<br>";
		$sql_transaction="SELECT * FROM `transaction` WHERE uid=$uid ORDER BY tid DESC LIMIT 1";
		$bal=$conn->query($sql_transaction)->fetch_assoc()['bal'];
		echo $bal."<br>";
		$bal=$bal+$damt;
		echo $bal."<br>";
		$sql_transaction_insertion="INSERT INTO `transaction`(`uid`,`did`,`damt`,`bal`,`status`) VALUES ($uid,$did,$damt,$bal,'DEPOSITED')";
		if($conn->query($sql_transaction_insertion)== TRUE)
		{
			header("location:deposit.php?msg=depos&uid=".$uid);
		}
		else
		{
			echo "Problem Occur";
		}
	}
	else
	{
		echo "Not Ok";
	}
?>