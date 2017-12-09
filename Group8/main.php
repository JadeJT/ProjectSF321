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

$result = mysqli_query($con, "SELECT * FROM register WHERE Status != 'อนุมัติ'");
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
      <a class="nav">การเบิกจ่าย</a>
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

    <a href="main.php" class="navi">คำขอ</a>
  </div>
</div>
<!--End manu bar-->

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
              <th width="100px">สถานะ</th>
              <th width="100px">หมายเหตุ</th>
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
                <td><?php echo $row["Status"]; ?></td>
                <td><center><a href="request.php?id='<?php echo $row['id']?>'"><button>รายละเอียด</button></a></center></td>
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