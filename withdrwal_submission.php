<?php
	session_start();
	include('connection.php');
	$wamt=$_REQUEST['wamt'];
	$uid=$_REQUEST['uid'];
	$flag=$_POST['flag'];
	echo "$flag";
	echo "uid=".$uid."<br>";
	$sql_transaction="SELECT * FROM `transaction` WHERE uid=$uid ORDER BY tid DESC LIMIT 1";
	if($conn->query($sql_transaction)->num_rows===0)
	{
		echo "Account Deactivated";
	}
	else
	{
		$bal=$conn->query($sql_transaction)->fetch_assoc()['bal'];
		$bal=$bal-$wamt;
		echo $bal;
		if($bal>=0)
		{
			$sql_withdrwal="INSERT INTO `withdrwal`(`uid`, `wamt`,`status`) VALUES ($uid,$wamt,'WITHDRAWLED')";
			if($conn->query($sql_withdrwal)===TRUE)
			{
				$sql_withdrwal_selection="SELECT * FROM `withdrwal`";
				if($conn->query($sql_withdrwal_selection)->num_rows>0)
				{
					$wid=$conn->query($sql_withdrwal_selection)->fetch_assoc()['wid'];
					$sql_transaction_insertion="INSERT INTO `transaction`(`uid`,`wid`, `wamt`,`bal`, `status`) VALUES ($uid,$wid,$wamt,$bal,'WITHDRAWLED')";
					if($conn->query($sql_transaction_insertion)===TRUE)
					{
						if($flag=='close')
						{
							echo "close";
							header("location:withdrwal.php?amt=success&flag=ok&uid=".$uid."&bal=".$bal);
						}
						else
						{
							echo "not close";
							header("location:withdrwal.php?amt=success&uid=".$uid);
						}
					}
				}
			}
			else
			{
				echo "No Table There";
			}

		}
		else
		{
			header("location:withdrwal.php?amt=fail&uid=".$uid);
		}
	}
?>