<?php
	include('connection.php');
	session_start();
	echo $_SESSION['id'];

	$name=$_REQUEST['name'];
	$mail_id=$_REQUEST['mail_id'];
	$gender=$_REQUEST['gender'];
	$mobile_num=$_REQUEST['mobile_num'];
	$add=$_REQUEST['add'];
	$state=$_REQUEST['state'];
	$city=$_REQUEST['city'];
	$bank=$_REQUEST['bank'];
	$brunch=$_REQUEST['brunch'];
	$ifsc=$_REQUEST['ifsc'];
	$ac_no=$_REQUEST['ac_no'];
	$pwd=$_REQUEST['pwd'];
	$pwd1=$_REQUEST['pwd1'];

	if($pwd==$pwd1)
	{
		$sql="INSERT INTO `user_detail`(`name`, `mail_id`, `gender`, `mobile_num`, `add`, `state`, `city`, `bank`, `brunch`, `ifsc`, `pwd`,`ac_no`) VALUES ('$name','$mail_id','$gender','$mobile_num','$add','$state','$city','$bank','$brunch','$ifsc','$pwd','$ac_no')";
		$result=$conn->query($sql);
		if($result === TRUE)
		{
			$sql_select_user_detail="SELECT * FROM `user_detail` ORDER BY uid DESC LIMIT 1";
			if($conn->query($sql_select_user_detail)->num_rows>0)
			{
				$uid=$conn->query($sql_select_user_detail)->fetch_assoc()['uid'];
				$sql_inserted_tran="INSERT INTO `transaction`(`uid`,`status`) VALUES ('$uid','START')";
				if($conn->query($sql_inserted_tran) === TRUE)
				{
					header("location:create_account.php?msg=in");
				}
				else
				{
					echo "Not Inserted";
				}
			}
			else
			{
				echo "Not Done";
			}
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $conn->error;	
		}
	}
	else
	{
		header("location:create_account.php?pass=nm");
	}

?>
