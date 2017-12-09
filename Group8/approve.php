<?php
	require 'connect.php';

	$IDcard = $_POST['IDcard'];
	$Name = $_POST['Name'];
	$Surname = $_POST['Surname'];
	$Birthday = $_POST['Birthday'];
	$Bank = $_POST['Bank'];
	$Accountnumber = $_POST['Accountnumber'];
	$Address = $_POST['Address'];
	$Telephone = $_POST['Telephone'];
	$Email = $_POST['Email'];
	$Career = $_POST['Career'];
	$Salary = $_POST['Salary'];
	$Official = $_POST['Official'];
	$Retire = $_POST['Retire'];
	$Bureauerucy = $_POST['Bureauerucy'];
	$Moneyrecieve = $_POST['Moneyrecieve'];
	$Status = $_POST['submit'];
	$Type = $_POST['Type'];

	$sql = "update register set IDcard='".$IDcard."', Name='".$Name."', Surname='".$Surname."', Birthday='".$Birthday."', Bank='".$Bank."', Accountnumber='".$Accountnumber."', Address='".$Address."', Telephone='".$Telephone."', Email='".$Email."', Career='".$Career."', Salary='".$Salary."', Official='".$Official."', Retire='".$Retire."', Bureauerucy='".$Bureauerucy."', Moneyrecieve='".$Moneyrecieve."', Status='".$Status."', Type='".$Type."' where IDcard='".$IDcard."' ";
	$result = mysqli_query($con,$sql);

	if ($result) {
		echo "<script> window.alert('Approve Success');</script>";
		echo "<script> window.location.assign('main.php');</script>";	
	}else{
		echo "<script> window.alert('Approve unsuccess');</script>";
		echo "<script> window.location.assign('request.php?IDcard='".$IDcard."'');</script>";
	}
?>