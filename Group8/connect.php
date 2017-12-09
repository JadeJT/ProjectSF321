<?php
	
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName	  = "localhost";
	$userName	  = "ppn";
	$userPassword	= "1q1q";
	$dbName	  = "test";

	$con = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	if (mysqli_connect_errno())
	{
		echo "Database Connect Failed : " . mysqli_connect_error();
		exit();
	}

	//*** Reject user not online
	$intRejectTime = 5; // Minute
	$sql = "UPDATE memberAdmin SET LoginStatus = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
	$query = mysqli_query($con,$sql);

?>