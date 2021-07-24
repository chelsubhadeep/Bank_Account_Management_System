<?php
	session_start();
	if(isset($_GET['sess']) && $_GET['sess']=='exp')
	{
		echo "<h3><center><font color='red'>Please Log In First</font></center></h3>";
	}
	if(isset($_SESSION['id']) && $_SESSION['id']!='')
	{
		header("location:all_detailes.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<h1><center>ADMINISTRATOR LOG IN</center></h1>
	<title></title>
</head>
<body>
	<center>
		<form action="admin_login_validation.php" method="post">
			<table border=1>
					<tr>
						<td>Admin ID</td> 
						<td><input type="text" name="admin_id" id="admin_id" required></td>
					</tr>
					<tr>
						<td>Password</td> 
						<td><input type="password" name="psw" id="psw" required></td>
					</tr>
			</table>
			<br>
			<input type="submit" name="submit" value="Log In">
		</form>
	</center>
	<a href="index.php">Back</a>
</body>
<?php
if(isset($_REQUEST['pwd']) && $_REQUEST['pwd']=='no')
{
	echo "<h3><center><font color='red'>LogIn ID or/and Password do not match</font></center></h3>";
}	
?>
</html>