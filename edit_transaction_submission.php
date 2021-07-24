<!DOCTYPE html>
<html>
<head>
	<h1><center>EDIT TRANSACTION DETAILES</center></h1>
	<title></title>
</head>
<body>
<a href="edit_transaction.php">Back</a>
</body>
</html>
<?php
	session_start();
	include('connection.php');
	$tid=$_GET['tid'];
	$uid=$_GET['uid'];
	$sql="SELECT * FROM `transaction` WHERE tid=$tid ";
	$result=$conn->query($sql);
	if($result->num_rows>0)
	{
		$row=$result->fetch_assoc();
		if($row['status']=='DEPOSITED')
		{
			edit_deposit($row);
		}
		else if($row['status']=='WITHDRAWLED')
		{
			edit_withdrwal($row);
		}
		else
		{
			echo "<h3><center>Re-Transaction Impossible</center></h3>";
		}

	}
	function edit_deposit($row)
	{
?>
	<!DOCTYPE html>
	<html>
	<head>
		<h3><center>ENTER THE CORRECT DEPOSIT AMOUNT</center></h3>
		<title></title>
	</head>
	<body>

			<center>
				<form action="edit_transaction_submission.php" method="get">
					<input type="hidden" name="tid" value=<?=$row['tid']?>>
					<input type="hidden" name="uid" value=<?=$row['uid']?>>
					<input type="text" name="damt" id="damt">
					<input type="submit" name="submit" value="Submit">
				</form>
			</center>
	</body>
	</html>
<?php
		include('connection.php');
		$damt=$_GET['damt'];
		$tid=$row['tid'];
		$bal=$row['bal'];
		$damt_prev=$row['damt'];
		$bal=$bal-$damt_prev+$damt;
		$sql_re_deposit="UPDATE `transaction` SET `damt`=$damt,`bal`=$bal,`status`='REDEPOSITED' WHERE `tid`=$tid";
		$result_re_deposit=$conn->query($sql_re_deposit);
		if($result_re_deposit === TRUE)
		{
			echo "<h3><center>Transition Updated Sucessfully</center></h3>";
		}
		else
		{
			echo "<h3><center>Transition ID Not Found</center></h3>";	
		}


	}
	function edit_withdrwal($row)
	{
		print_r($row);
?>
		<!DOCTYPE html>
	<html>
	<head>
		<h3><center>ENTER THE CORRECT WITHDRWAL AMOUNT</center></h3>
		<title></title>
	</head>
	<body>

			<center>
				<form action="edit_withdrwal_submission.php" method="get">
					<input type="hidden" name="wid" value=<?=$row['wid']?>>
					<input type="hidden" name="uid" value=<?=$row['uid']?>>
					<input type="text" name="wamt" id="wamt">
					<input type="submit" name="submit" value="submit">
				</form>
			</center>
	</body>
	</html>
<?php
		include('connection.php');
		if(isset('submit')!=''){
		$wamt=$_GET['wamt'];
		$tid=$row['tid'];
		$wid=$row['wid'];
		$bal=$row['bal'];
		$wamt_prev=$row['wamt'];
		$bal=$bal+$wamt_prev-$wamt;
		$sql_re_deposit="UPDATE `transaction` SET `wamt`=$wamt,`bal`=$bal,`status`='REWITHDRWAL' WHERE `tid`=$tid";
		$result_re_withdrwal=$conn->query($sql_re_withdrwal);
		if($result_re_withdrwal === TRUE)
		{
			echo "<h3><center>Transition Updated Sucessfully</center></h3>";
		}
		else
		{
			echo "<h3><center>Transition ID Not Found</center></h3>";	
		}
	}
	}
?>