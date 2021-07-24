<?php
	session_start();
	if(isset($_SESSION['id']) === FALSE)
	{
		header("location:admin_login.php?sess=exp");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<h1><center>ACCOUNT OPENING FORM</center></h1>
	<title></title>
</head>
<body>
	 <form action="create_account_submission.php">
	 		<center>
	 			<table border="1">
	 				<tr>
	 					<td>Name</td>
	 					<td><input type="text" name="name" id="name" required></td>
	 					<td>Email ID</td>
	 					<td><input type="text" name="mail_id" id="mail_id" required></td>
	 				</tr>
	 				<tr>
	 					<td>Gender</td>
	 					<td>
	 						Male<input type="radio" name="gender" id="gender" value="Male" required>
	 						Female<input type="radio" name="gender" id="gender" value="Female" required> 
	 						Other<input type="radio" name="gender" id="gender" value="Other" required>
	 					</td>
	 					<td>Mobile</td>
	 					<td><input type="text" name="mobile_num" id="mobile_num" pattern=[0-9]{10} required></td>
	 				</tr>
	 				<tr>
	 					<td>Address</td>
	 					<td><textarea id="add" value="add" name="add"></textarea></td>
	 				</tr>
	 				<tr>
	 					<td>State</td>
	 					<td>
	 						<select name="state" id="state">
	 							<option name="" value="">Select State</option>
	 							<option value="West Bengal">West Bengal</option>
	 						</select>
	 					</td>
	 					<td>City</td>
	 					<td>
	 						<select name="city" id="city">
	 							<option>Select City</option>
	 							<option 1value="Kolkata">Kolkata</option>
	 						</select>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td>Bank</td>
	 					<td>
	 						<select name="bank" id="bank">
	 							<option>Select Bank</option>
	 							<option value="SBI">State Bank Of India</option>
	 							<option value="BOI">Bank Of India</option>
	 						</select>
	 					</td>
	 					<td>Brunch</td>
	 					<td>
	 						<select name="brunch" id="brunch">
	 							<option>Select City</option>
	 							<option value="cit">CIT ROAD</option>
	 						</select>
	 					</td>
	 				</tr>
	 				<tr>
	 					<td>IFSC Code</td>
	 					<td><input type="text" name="ifsc" value="111" readonly></td>
	 					<td>Account Number</td>
	 					<td><input type="text" name="ac_no" ></td>
	 				</tr>
	 				<tr>
	 					<td>Password</td>
	 					<td><input type="password" name="pwd" id="pwd"></td>
	 				</tr>
	 				<tr>
	 					<td>Retype Password</td>
	 					<td><input type="password" name="pwd1" id="pwd1"></td>
	 				</tr>
	 			</table>
	 			<input type="submit" name="submit" value="Submit">
	 		</center>
	 </form>
	 <a href="all_detailes.php">Back</a>
</body>
<?php
	if(isset($_REQUEST['msg']) && $_REQUEST['msg']=='in')
	{
		echo "<h2><center><font color='blue'>Account Created Sucessfully</font></center></h2>";
	}
	if(isset($_REQUEST['pass']) && $_REQUEST['pass']=='nm')
	{
		echo "<h2><center><font color='red'>Password Does Not Matched</font></center></h2>";
	}
?>
</html>