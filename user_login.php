<?php
	session_start();
	//echo $_SESSION['uid'];
	if(isset($_SESSION['uid']) && $_SESSION['uid']!='')
	{
		header("location:mini_statement_user.php?uid=".$_SESSION['uid']);
	}
	if(isset($_REQUEST['submit']))
	{
		include('connection.php');
		$ac_no=$_REQUEST['ac_no'];
		$pwd=$_REQUEST['pwd'];
		$sql="SELECT * FROM `user_detail` WHERE `ac_no`=$ac_no AND `pwd`='$pwd'";
		$result=$conn->query($sql);
		error_reporting(0);
		if($result->num_rows>0)
		{
			$_SESSION['uid']=$conn->query($sql)->fetch_assoc()['uid'];
			echo $_SESSION['uid'];
			header("location:mini_statement_user.php?uid=".$_SESSION['uid']);
		}
		else
		{
			echo "<h2><center><font color='red'>Account No./Password Number Did Not Match</font></center></h2>";
		}
	}
	else
	{
		echo "<h2><center><font color='#ffffff'>Enter The Valid Account Number And Password</font></center></h2>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<center>
		<h1>
			USER LOGIN SYSTEM
		</h1>
	</center>
	<title></title>
</head>
<body>
	<center>
		<form method="post" action="user_login.php">
			<table border="1">
				<tr>
					<td>Account Number</td>
					<td><input type="text" name="ac_no"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="pwd"></td>
				</tr>
			</table>
			<input type="submit" name="submit" value="Log In">
		</form>
	</center>
	<a href="index.php">Back</a>
</body>
<?php
if(isset($_GET['sess']) && $_GET['sess']=='exp')
{
	echo "<h3><center><font color='red'>Please Log In First</font></center></h3>";
}
?>
</html>