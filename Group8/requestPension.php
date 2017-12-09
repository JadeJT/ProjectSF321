<?php
session_start();
require_once("connect.php");

if(!isset($_SESSION['UserID']))
{
  echo "Please Login!";
  exit();
  echo "<meta http-equiv='refresh' content='2;url=logInAdmin.php'>";
}

  //*** Update Last Stay in Login System
$sql = "UPDATE memberAdmin SET LastUpdate = NOW() WHERE UserID = '".$_SESSION["UserID"]."' ";
$query = mysqli_query($con,$sql);

  //*** Get User Login
$strSQL = "SELECT * FROM memberAdmin WHERE UserID = '".$_SESSION['UserID']."' ";
$objQuery = mysqli_query($con,$strSQL);
$objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);

$result = mysqli_query($con, "SELECT * FROM register");
?>

<!DOCTYPE html>
<html>
		<head>
			<?php
				$id = $_GET["id"];
				$sql = "select * from register where id =".$id."";
				$result = mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($result);
			?>
		</head>

		<body>
			<H1>ข้อมูลส่วนตัว</H1>
			<div style="margin: 10px; padding: 10px; border: ridge;">
				<form action="approvePension.php" method="POST">
					<p>ชื่อ</p>
					<input type="text" name="Name" value="<?php echo $row["Name"]  ?>" class="form-control"><br>
					<p>นามสกุล</p>
					<input type="text" name="Surname" value="<?php echo $row["Surname"]  ?>"><br>
					<p>รหัสบัตรประชาชน</p>
					<input type="text" name="IDcard" value="<?php echo $row["IDcard"] ?>"><br>
					<p>วันเกิด</p>
					<input type="date" name="Birthday" value="<?php echo $row["Birthday"] ?>"><br>
					<p>ที่อยู่</p>
					<input type="text" name="Address" align="justify" value="<?php echo $row["Address"] ?>" style="height: 60px; width: 300px;"><br>
					<p>เบอร์โทรศัพท์</p>
					<input type="text" name="Telephone" value="<?php echo $row["Telephone"] ?>"><br>
					<p>อีเมล์</p>
					<input type="text" name="Email" value="<?php echo $row["Email"] ?>"><br>
					<p>ธนาคาร</p>
					<input type="text" name="Bank" value="<?php echo $row["Bank"] ?>"><br>
					<p>เลขบัญชี</p>
					<input type="text" name="Accountnumber" value="<?php echo $row["Accountnumber"] ?>"><br>
					<p>อาชีพ</p>
					<input type="text" name="Career" value="<?php echo $row["Career"] ?>"><br>
					<p>เงินเดือนเดือนสุดท้าย</p>
					<input type="text" name="Salary" value="<?php echo $row["Salary"] ?>" id="salary"><br>
					<p>วันที่เข้ารับราชการ</p>
					<input type="date" name="Official" value="<?php echo $row["Official"] ?>"><br>
					<p>วันที่เกษียณ</p>
					<input type="date" name="Retire" value="<?php echo $row["Retire"] ?>"><br>
					<p>อายุราชการ</p>
					<input type="text" name="Bureauerucy" value="<?php echo $row["Bureauerucy"] ?>" id="bureauerucy"><br>
					<p>ประเภทการของบำเน็จบำนาญ</p>
					<input type="text" name="Type" value="<?php echo $row["Type"] ?>" id="type"><br>
					<p>เงินที่ควรได้</p>
					<input type="text" name="Moneyrecieve" id="Moneyrecieve" value=""><br><br>
					<input type="submit" name="submit" value="ไม่อนุมัติ">
					<input type="submit" name="submit" value="อนุมัติ">
				</form>
				<br>
				<a href="mainPension.php"><button>ย้อนกลับ</button></a>
			</div>
			<div style="margin: 10px; padding: 10px; border: ridge;">
				<h3>คำนวณเงิน</h3>
				<p id='demo'></p>
				<button onclick="document.getElementById('demo').innerHTML=calculateFunction()">คำนวณ</button><br>
			</div>
		
		<script>
			function calculateFunction(){
				var type = document.getElementById('type').value;
				var bureauerucy = document.getElementById('bureauerucy').value;
				var salary = document.getElementById('salary').value;
				var result = 0;
				var calculate = "";
				if(type=="บำเหน็จ"){
					result = salary * bureauerucy;
					calculate = type + "<br>" + "เงินเดือนเดือนสุดท้าย x ปีที่รับราชการ<br>" + salary + " x " + bureauerucy + " จะได้ " + result + " บาท";
				}else if(type=="บำนาญ"){
					result = (salary * bureauerucy) / 50;
					var temp = salary * 7 / 10;
					if (result > temp) {
						result = temp;
						calculate = type + "<br>เกิน 70 % ของเงินเดือน เฉลี่ยน 60 เดือนสุดท้าย <br> ซึ่งเท่ากับ" + temp + "<br>";
					}
					calculate += "เงินเดือนเดือนสุดท้าย x ปีที่รับราชการ / 50<br>" + salary + " x " + bureauerucy + " / 50 จะได้ " + result + " บาท";
				}
				document.getElementById('Moneyrecieve').value=result;
				return calculate;
			}
		</script>
		</body>
</html>
<?
mysqli_close($con);
?>