<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION['UID'])) header("location:./login.php");
include_once "./conn/object_connect.php";
$sql = "SELECT * FROM tb_user WHERE UID=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $_SESSION['UID']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$mysqli->close();
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <title>ระบบเช็กชื่อกิจกรรม</title>
</head>

<body>
    <div class="container bg-light mt-5">
        <div class="col-10 mx-auto p-2 rounded">
            <h1 class="w-100 text-center pb-2 border-bottom border-3">ระบบเช็กชื่อกิจกรรม</h1>
            <div class="p-2 mb-2">
                <div class="row">
                    <div class="col-sm-3">UID</div>
                    <div class="col-sm-3"><?= str_pad($user['UID'], 3, "0", STR_PAD_LEFT) ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3">ชื่อ</div>
                    <div class="col-sm-3"><?= $user['name'] ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-3">สถานะ</div>
                    <div class="col-sm-3"><?= $user['status'] ?></div>
                </div>
            </div>
            <div class="p-2 mb-2">
                <div class="row">
                    <div class="col-auto mx-auto">
                        <div class="btn-group">
                            <a href="../index.php" class="btn btn-outline-primary">
                                <i class="fa fa-home me-1" aria-hidden="true"></i>
                                หน้าหลัก
                            </a>
                            <a href="../sys/" class="btn btn-outline-primary">
                                <i class="fa fa-calendar me-1" aria-hidden="true"></i>
                                ระบบกิจกรรม
                            </a>
                            <a href="./profile.php" type="button" class="btn btn-outline-primary">
                                <i class="fa fa-edit me-1" aria-hidden="true"></i>
                                แก้ไขโปรไฟล์
                            </a>
                            <a href="./logout.php" type="button" class="btn btn-outline-primary">
                                <i class="fa fa-sign-out-alt me-1" aria-hidden="true"></i>
                                ออกจากระบบ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

</body>

</html>