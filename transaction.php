<?php
	session_start();
	include('connection.php');
	if(isset($_SESSION['id']) === FALSE)
	{
		header("location:admin_login.php?sess=exp");
	}
	$uid=$_REQUEST['uid'];
	$sql="SELECT status FROM `transaction` WHERE uid=$uid ORDER BY tid DESC LIMIT 1";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		if($row['status']==='CLOSED')
		{
			header("location:all_detailes.php?stat=closed");	
		}
		else
			cash_transaction($uid);
	}
	else
		echo $conn->error;
?>
<?php 
function cash_transaction($uid)
{
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<a href="deposit.php?uid=<?=$_REQUEST['uid']?>">Deposit Amount</a><br>
		<a href="withdrwal.php?uid=<?=$_REQUEST['uid']?>">Withdrwal Amount</a><br>
		<a href="mini_statement.php?uid=<?=$_REQUEST['uid']?>">Mini Statement</a><br>
	</center>
	<a href="all_detailes.php?id=<?=$_SESSION['id']?>">Back</a>
	<center>
		<form action="lgout.php" method="post">
			<input type="submit" name="submit" value="Log Out">
		</form>
	</center>
</body>
</html>
<?php 
}
?>