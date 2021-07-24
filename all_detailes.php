<?php
	session_start();
	if(isset($_SESSION['id']) === FALSE)
	{
		header("location:admin_login.php?sess=exp");
	}
	include('connection.php');
	$sql="CALL ALL_DETAILES()";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		detail_information($result);
	}
	else
	{
		echo "<h2><center><font color='red'>No Information Entered Yet</font></center></h2>";
	}
?>
<!DOCTYPE html>
<html>
<?php function detail_information($result)
		{
?>
<head>
	<h1><center>CUSTOMER DETAILES</center></h1>
	<title></title>
</head>
<body>
	<table border="1">

		<tr>
			<td><b>Name</b></td>
			<td><b>Mail ID</b></td>
			<td><b>Gender</b></td>
			<td><b>Phone Number</b></td>
			<td><b>Address</b></td>
			<td><b>State</b></td>
			<td><b>City</b></td>
			<td><b>Bank</b></td>
			<td><b>Brunch</b></td>
			<td><b>Account Number</b></td>
			<td><b>Deposit Amounts</b></td>
			<td><b>Withdrwal Amounts</b></td>
			<td><b>Balance</b></td>
			<td><B>Money Transaction</b></td>
			<td><b>Edit Transaction</b></td>
			<td><b>Account Status</b></td>
			<td><b>Acitivity</b></td>
		</b>
		</tr>
			<?php
				if($result->num_rows==0){echo "No data";}
				else
				{
					while($row=$result->fetch_assoc())
					{
			?>
					<tr>
							<td><?=$row['NAME']?></td>
							<td><?=$row['mail_id']?></td>
							<td><?=$row['gender']?></td>
							<td><?=$row['mobile_num']?></td>
							<td><?=$row['add']?></td>
							<td><?=$row['state']?></td>
							<td><?=$row['city']?></td>
							<td><?=$row['bank']?></td>
							<td><?=$row['brunch']?></td>
							<td><?=$row['ac_no']?></td>
							<td><?=$row['damt']?></td>
							<td><?=$row['wamt']?></td>
							<td><?=$row['bal']?></td>
						<td><a href="transaction.php?uid=<?=$row['uid']?>">Click</a></td>
						<td><a href="edit_transaction.php?uid=<?=$row['uid']?>"><font color='blue'>Click</font></a></td>
						
						<td>
						<?php 
							if($row['status']==='CLOSED'){
						?>	<b><font color='red'>Inactive</font></b>
						<?php
							}
							else{
						?>
							<b><font color='green'>Active</font></b> 	
						<?php }?>	

						</td>


						<td><a href="deactivate.php?uid=<?=$row['uid']?>">
						<?php 
							if($row['status']==='CLOSED'){
						?>	Reactivate
						<?php
							}
							else{
						?>
							Deactivate
						<?php }?>
					</a></td>
					 </tr>  
			<?php
					}
				}
			}
			?>
	</table>
	<br>
		<center>
			<a href="create_account.php?id=<?=$_SESSION['id']?>">CREATE ACCOUNT</a><br>
			<form action="lgout.php" method="post">
				<input type="submit" name="submit" value="Log Out">
			</form>
		</center>
</body>
</html>
<?php

	
?>
<?php
if(isset($_GET['up']) && $_GET['up']==='suc')
{
	echo "<h1><center>Account Deactivated</center></h1>";
}
if(isset($_GET['up']) && $_GET['up']==='resuc')
{
	echo "<h1><center>Account Reactivated</center></h1>";
}
if(isset($_GET['status']) && $_GET['status']==='closed')
{
	echo "<center><h1>Account Already Deactivated</h1>";
	echo "<h2>Do you want to reactivate?</h2>";
	$uid=$_GET['uid'];
	echo "<a href='reactivate.php?status=closed&uid=$uid'>Yes</a>&nbsp&nbsp&nbsp&nbsp";
	echo "<a href='all_detailes.php'>No</a></center>";
}
if(isset($_REQUEST['stat']) && $_REQUEST['stat']=='closed')
{
	echo "<h3><center><font color='red'>Account Closed Transaction Impossible</font></center></h3>";
}
?>