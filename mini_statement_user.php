<?php
	session_start();
	$uid=$_SESSION['uid'];
	if(isset($_SESSION['uid']) === FALSE)
	{
		header("location:user_login.php?sess=exp");
	}
	include('connection.php');
	$sql_transaction="SELECT * FROM `transaction` WHERE uid=$uid AND status<>'OPEND' AND status<>'CLOSED'";
	$result=$conn->query($sql_transaction);
	if($result->num_rows>0)
	{

?>
<!DOCTYPE html>
<html>
<head>
	<h1><center>TRANSACTION DETAILES</center></h1>
	<title></title>
</head>
<body>
	<center>
	 <table border="1">
	 	<?php
	 			$sql_user_detailes="SELECT * FROM `user_detail` WHERE uid=$uid";
	 			$result_user_detailes=$conn->query($sql_user_detailes);
	 			$row_user_detailes=$result_user_detailes->fetch_assoc();
	 	?>
	 	<tr>
	 		<td>Name</td>
	 		<td><input type="text" name="name" value="<?=$row_user_detailes['name']?>" readonly></td>
	 	</tr>
	 	<tr>
	 		<td>Account_Number</td>
	 		<td><input type="text" name="ac_no" value="<?=$row_user_detailes['ac_no']?>" readonly></td>
	 	</tr>
	 </table>
	 <table border="1">
	 	<tr>
	 		<td>Withdrwal Amount</td>
	 		<td>Deposit Amount</td>
	 		<td>Balance</td>
	 	</tr>
<?php
		while($row=$result->fetch_assoc())
		{
?>
		<tr>
	 		<td><?php if($row['wamt']==0)echo "";else echo $row['wamt'] ?></td>
	 		<td><?php if($row['damt']==0)echo "";else echo $row['damt'] ?></td>
	 		<td><?php if($row['bal']==0)echo "";else echo $row['bal'] ?></td>
	 	</tr>
<?php
		}
	}
	else
	{
		$sql="SELECT * FROM `transaction` WHERE uid=$uid ORDER BY tid DESC LIMIT 1";
		$result=$conn->query($sql);
		$row=$result->fetch_assoc();
		print_r($row);
		if($row['status']==='CLOSED')
			echo "<h1><center>Account Deactivated</center></h1>";	
		else
			echo "<h1><center>No Transaction Till Now</center></h1>";

	}
?>
		</table>
		</center>
</body>
<center>
	<form action="logout.php" method="post">
		<input type="submit" name="submit" value="Log Out">
	</form>
</center>
</html>