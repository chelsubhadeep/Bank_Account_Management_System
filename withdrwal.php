<?php
	session_start();
	include('connection.php');
	echo $_SESSION['id'];
	echo $_REQUEST['uid'];
	$uid=$_REQUEST['uid'];
	if(isset($_SESSION['id']) === FALSE)
	{
		header("location:admin_login.php?sess=exp");
	}
	echo var_dump(isset($_GET['bal']));
	$bal=$_GET['bal'];
	if(isset($_GET['bal'])=== FALSE)
	{
		withdrwal_amount();
	}
	else
	{
		withdrwal_amount_close();	
	}
?>
<?php
	function withdrwal_amount()
	{
?>		
		<!DOCTYPE html>
		<html>
		<head>
		<title></title>
		</head>
		<body>
			<center>
				<form action="withdrwal_submission.php" method="post">
					<h3>Enter The Withdrwal Amount</h3>
					<table>
						<input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>">
						<tr>
							<td>
								<input type="text" name="wamt" id="wamt">
							</td>
						</tr>
					</table>
					<input type="submit" name="submit" value="Withdrwal">
				</form>
			</center>
			<a href="transaction.php?uid=<?=$_REQUEST['uid']?>">Back</a>
		</body>
		<?php
			if(isset($_GET['amt']) && $_GET['amt']=='success')
			{
				echo "<h3><center>Amount Withdrawled Sucessfully</center</h3>";
			}
			if(isset($_GET['amt']) && $_GET['amt']=='fail')
			{
				echo "<h3><center>Bank Balance is not sufficent for withdrwal</center</h3>";	
			}
		?>
		<center>
			<form action="lgout.php" method="post">
				<input type="submit" name="submit" value="Log Out">
			</form>
		</center>
		</html>
<?php
	}
?>
<?php
	function withdrwal_amount_close()
	{
?>		
		<!DOCTYPE html>
		<html>
		<head>
		<title></title>
		</head>
		<body>
			<center>
				<form action="withdrwal_submission.php" method="post">
					<input type="text" name="flag" id="flag" value="<?=$_GET['flag']?>">
					<h3>Enter The Withdrwal Amount</h3>
					<table>
						<input type="hidden" name="uid" value="<?=$_REQUEST['uid']?>">
						<tr>
							<td>
								<input type="text" name="wamt" id="wamt" value="<?=$_REQUEST['bal']?>" readonly>
							</td>
						</tr>
					</table>
					<input type="submit" name="submit" value="Withdrwal">
				</form>
			</center>
			<a href="deactivate.php?uid=<?=$_REQUEST['uid']?>">Back</a>
		</body>
		<?php
			if(isset($_GET['amt']) && $_GET['amt']=='success')
			{
				echo "<h3><center>Amount Withdrawled Sucessfully</center> </h3>";
			}
			if(isset($_GET['amt']) && $_GET['amt']=='fail')
			{
				echo "<h3><center>Bank Balance is not sufficent for withdrwal</center</h3>";	
			}
		?>
		<center>
			<form action="lgout.php" method="post">
				<input type="submit" name="submit" value="Log Out">
			</form>
		</center>
		</html>
<?php
	}
?>