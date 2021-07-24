<?php
	session_start();
	include('connection.php');
	echo $_SESSION['id'];
	echo $_REQUEST['uid'];
	if(isset($_SESSION['id']) === FALSE)
	{
		header("location:admin_login.php?sess=exp");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<center>
		<form action="deposit_submission.php" method="post">
			<h3>Enter The Deposit Amount</h3>
			<table>
				<input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>">
				<tr>
					<td>
						<input type="text" name="damt" id="damt">
					</td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Deposit">
		</form>
	</center>
	<a href="transaction.php?uid=<?=$_REQUEST['uid']?>">Back</a>
</body>
<?php
	if(isset($_GET['msg']) && $_GET['msg']=='depos')
	{
		echo "<h3><center>Amount Deposited Sucessfully</center</h3>";
	}
?>
<center>
	<form action="lgout.php" method="post">
		<input type="submit" name="submit" value="Log Out">
	</form>
</center>
</html>