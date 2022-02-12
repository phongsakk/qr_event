<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION['status'])) header("location:./console.php");
if (isset($_POST['Submit'])) {
  include("./conn/object_connect.php");
  $sql = "SELECT * FROM tb_user WHERE username=? AND password=?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param("ss", $_POST['txtUsername'], $_POST['txtPassword']);
  $stmt->execute();
  $user  = $stmt->get_result()->fetch_assoc();
  if (!$user) exit("ผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง [<a href=''>กลับ</a>]");
  $_SESSION['UID'] = $user['UID'];
  $_SESSION['status'] = $user['status'];
  session_write_close();
  header("location:./console.php");
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>เข้าสู่ระบบ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
</head>

<body>
  <div class="container mt-2">
    <h1 class="w-100 text-center mt-5 mb-2">เข้าสู่ระบบ</h1>
    <div class="p-2 bg-light mb-2 rounded">
      <div class="col-6 mx-auto mt-3">
        <form name="form1" method="post">
          <div class="mb-3 row">
            <label for="txtUsername" class="col-sm-2 col-form-label">Username</label>
            <div class="col-sm-10">
              <input class="form-control" name="txtUsername" type="text" id="txtUsername" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="txtPassword" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input class="form-control" name="txtPassword" type="password" id="txtPassword" required>
            </div>
          </div>
          <div class="mb-3 text-center">
            <input class="btn btn-info" type="submit" name="Submit" value="เข้าสู่ระบบ">
          </div>
          <div class="mb-3 text-center">
            หรือ <a href="./register.php">สมัครสมาชิก</a>
          </div>
          <div class="mb-3 text-center">
            <div class="row">
              <div class="col-auto mx-auto">
                <div class="btn-group">
                  <button type="button" onclick="history.go(-1)" class="btn btn-outline-secondary" role="button">เพจก่อนหน้า</button>
                  <a href="../index.php" class="btn btn-outline-secondary" role="button">ไปหน้าหลัก</a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
</body>

</html>