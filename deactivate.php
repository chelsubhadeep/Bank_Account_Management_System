<?php
	session_start();
	include('connection.php');
	echo $_SESSION['id']."<br>".$_GET['uid']."<br>";
	$uid=$_GET['uid'];
	$sql_sel_tran="SELECT * FROM `transaction` WHERE uid=$uid ORDER BY tid DESC LIMIT 1";
	$result=$conn->query($sql_sel_tran);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		$status=$row['status'];
		print_r($row);
		if($status==='CLOSED')
		{
			header("location:all_detailes.php?status=closed&uid=".$uid);
		}
		else
		{
			if($row['bal']==0)
			{
				$sql_up_tran="UPDATE `transaction` SET `status`='CLOSED' WHERE uid=$uid";
				$result_up_tran=$conn->query($sql_up_tran);
				if($result_up_tran===TRUE)
				{
					header("location:all_detailes.php?up=suc&uid=".$uid);
				}
				else
				{
					echo $conn->error;
				}
			}
			else
			{
				echo "<center><h2>The amount ".$row['bal']." must be withdrwaled</h2><br>";
				echo "<a href='withdrwal.php?uid=$uid&flag=close&bal=".$row['bal']."'>Withdrwal Amount</a></center><br>";
				echo "<a href='all_detailes.php'>Back</a></center><br>";
			}
		}
	}
	else
	{
		echo "Not Ok";
	}
?>