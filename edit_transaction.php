<?php
	session_start();
	$uid=$_GET['uid'];
	include('connection.php');
	$sql="SELECT * FROM `transaction` WHERE uid=$uid AND status<>'START' AND status<>'OPEND'  AND status<>'CLOSED'";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
?>
		<!DOCTYPE html>
			<html>
				<head>
					<title></title>
				</head>
				<body>
					<center>
						<table border="1">
						<tr>
							<td>TRANSACTION ID</td>
							<td>WITHDRWLED AMOUNT</td>
							<td>DEPOSIT AMOUNT</td>
							<td>BALANCE</td>
							<td>STATUS</td>
							<td>ACTION</td>
						</tr>
					
<?php
		while($row=$result->fetch_assoc())
		{  
?>
						<tr>
							<td><?=$row['tid']?></td>
							<td><?php if($row['wamt']>0) echo $row['wamt']; else echo "";?></td>
							<td><?php if($row['damt']>0) echo $row['damt']; else echo "";?></td>
							<td><?=$row['bal']?></td>
							<td><?=$row['status']?></td>
							<td><?php 
								if($row['status'] =='DEPOSITED') 
									echo "<a href='edit_transaction_submission.php?uid=".$row['uid']."&tid=".$row['tid']."'>Edit Deposit Amount</a>"; 
								else if($row['status'] =='WITHDRAWLED') echo "<a href='edit_transaction_submission.php?uid=".$row['uid']."&tid=".$row['tid']."'>Edit Withdrawled Amount</a>";
								else 
									echo "Can't be Edited";
								?></td></td>
						</tr>
<?php			
		}
?>
					</table>
				</center>
				</body>
			</html>
<?php
	}
	else
	{
		echo "<center>NO TRANSACTION TILL NOW</center>";
		echo $conn->error;
	}
?>