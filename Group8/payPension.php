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

if (empty($_POST["Month"]) || empty($_POST["Year"])) {
  $month = "1";
  $year = "2559";
}else{
  $month = $_POST["Month"];
  $year = $_POST["Year"];
}

$result = mysqli_query($con, "SELECT register.*, bonus.Status FROM register LEFT JOIN bonus ON register.IDcard = bonus.IDcard WHERE register.Career = 'ครู' AND register.Type = 'บำเหน็จ' AND bonus.Month = $month AND bonus.Year = $year ");
?>

<!DOCTYPE html>
<html>

<head>
 
  <title>ระบบสารสนเทสและฐานข้อมูล</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" > 
  <link rel="stylesheet" href="main.css" type="text/css">
</head>

<body>
  <!--manu bar-->
  <div class="tavi">
    <div class="logo">
      <a href="main.php">
        <br><img src="image/logo1.png" style="width: 70px;height: 70px;">
      </a>
      <div class="logout">
        ยูสเซอร์ : <?php echo $objResult["Username"];?><br>
        ชื่อ : <?php echo $objResult["Name"];?>
        <a href="logout.php">
          <img src="image/logout.ico" style="width: 40px;height: 30px;">
        </a>
      </div>
    </div>
    <h6>ระบบสนเทศและฐานข้อมูล</h6>
    <p class="ma">
      เพื่อสนับสนุนการปฏิบัติงานของสำนักงาน<br>
      กองทุนบําเหน็จบํานาญข้าราชการส่วนท้องถิ่น
    </p>

    <a href="#" class="selected">รายงาน</a>

    <li class="dropdown">
      <a class="nav">ภาระการจ่าย</a>
      <div class="dropdown-content" >
        <a href="payPensionGeneral.php" >บำเหน็จ</a>
        <a href="payBonusGeneral.php" >บำนาญ</a>
      </div>
    </li>

    <li class="dropdown">
      <a class="navi">การเบิกจ่าย</a>
      <div class="dropdown-content" >
        <a href="payPension.php" >บำเหน็จ</a>
        <a href="payBonus.php" >บำนาญ</a>
      </div>
    </li>

    <li class="dropdown">
      <a class="nav">สถานะผู้รับ</a>
      <div class="dropdown-content" >
        <a href="mainPension.php" >บำเหน็จ</a>
        <a href="mainBonus.php" >บำนาญ</a>
      </div>
    </li>

    <a href="main.php" class="nav">คำขอ</a>
  </div>
</div>
<!--End manu bar-->

<center>
  <br><br>
  <form action="payPension.php" method="post">
    <select name="Month">
      <option value="1"<?php if($month == '1'){ echo ' selected="selected"'; } ?>>มกราคม</option>
      <option value="2"<?php if($month == '2'){ echo ' selected="selected"'; } ?>>กุมภาพันธ์</option>
      <option value="3"<?php if($month == '3'){ echo ' selected="selected"'; } ?>>มีนาคม</option>
      <option value="4"<?php if($month == '4'){ echo ' selected="selected"'; } ?>>เมษายน</option>
      <option value="5"<?php if($month == '5'){ echo ' selected="selected"'; } ?>>พฤษภาคม</option>
      <option value="6"<?php if($month == '6'){ echo ' selected="selected"'; } ?>>มิถุนายน</option>
      <option value="7"<?php if($month == '7'){ echo ' selected="selected"'; } ?>>กรกฎาคม</option>
      <option value="8"<?php if($month == '8'){ echo ' selected="selected"'; } ?>>สิงหาคม</option>
      <option value="9"<?php if($month == '9'){ echo ' selected="selected"'; } ?>>กันยายน</option>
      <option value="10"<?php if($month == '10'){ echo ' selected="selected"'; } ?>>ตุลาคม</option>
      <option value="11"<?php if($month == '11'){ echo ' selected="selected"'; } ?>>พฤศจิกายน</option>
      <option value="12"<?php if($month == '12'){ echo ' selected="selected"'; } ?>>ธันวาคม</option>
    </select>
    <select name="Year">
      <option value="2559"<?php if($year == '2559'){ echo ' selected="selected"'; } ?>>2559</option>
      <option value="2560"<?php if($year == '2560'){ echo ' selected="selected"'; } ?>>2560</option>
    </select>
    <input type="submit">
  </form>
</center>

<!--List-->
<div class='ui1'>
  <div class='ui1_box'>
    <div class='ui1_box__inner'>
      <center>
        <table border="1" style="table-layout: fixed;">
          <thead>
            <tr>
              <th width="150px">ชื่อ</th>
              <th width="150px">นามสกุล</th>
              <th width="150px">ตำแหน่ง</th>
              <th width="150px">ประเถท</th>
              <th width="150px">จำนวนเงิน</th>
              <th width="150px">สถานะ</th>
            </tr>
          </thead>
          <tbody>
            <!--Use a while loop to make a table row for every DB row-->
            <?php while($row = mysqli_fetch_array($result)) : ?>
              <tr>
                <!--Each table column is echoed in to a td cell-->
                <td><?php echo $row["Name"]; ?></td>
                <td><?php echo $row["Surname"]; ?></td>
                <td><?php echo $row["Career"]; ?></td>
                <td><?php echo $row["Type"]; ?></td>
                <td><?php echo $row["Moneyrecieve"]?></td>
                <td><?php echo $row["Status"]; ?></td>
              </tr>
            <?php endwhile ?>
          </tbody>
        </table>
      </center>
    </div>
  </div>
</div>
</body>
</html>
<?
mysqli_close($con);
?>