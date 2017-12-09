<?php
	session_start();

	require_once("connect.php");
	
	$strUsername = mysqli_real_escape_string($con,$_POST['txtUsername']);
	$strPassword = mysqli_real_escape_string($con,$_POST['txtPassword']);

	$strSQL = "SELECT * FROM memberAdmin WHERE Username = '".$strUsername."' and Password = '".$strPassword."'";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if(!$objResult)
	{
		echo "Username and Password Incorrect!";
		exit();
		echo "<meta http-equiv='refresh' content='2;url=logInAdmin.php'>";
	}
	else
	{
		if($objResult["LoginStatus"] == "1")
		{
			echo "'".$strUsername."' Exists login!";
			exit();
			echo "<meta http-equiv='refresh' content='2;url=logInAdmin.php'>";
		}
		else
		{
			//*** Update Status Login
			$sql = "UPDATE memberAdmin SET LoginStatus = '1' , LastUpdate = NOW() WHERE UserID = '".$objResult["UserID"]."' ";
			$query = mysqli_query($con,$sql);

			//*** Session
			$_SESSION["UserID"] = $objResult["UserID"];
			session_write_close();

			//*** Go to Main page
			header("location:main.php");
		}
			
	}
	mysqli_close($con);
?>