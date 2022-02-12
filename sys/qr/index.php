<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION['UID'])) header("location:../../school/login.php");
if (empty($_GET['id'])) header("location:../../school/login.php");
$link = "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/act/sys/chk/?token={$_GET['id']}";
include("../../school/conn/object_connect.php");
$sql = "SELECT * FROM tb_event WHERE EID = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$res = $stmt->get_result();
$e = $res->fetch_assoc();
$dateFormat = "FdS,Y h:i a";

$eventTypes = ["กิจกรรมบังคับ", "กิจกรรมบังคับเลือก", "กิจกรรมเลือก"];
$eventCode = substr($e['eventOfYear'] - 543, 2) . (array_search($e['eventType'], $eventTypes) + 1) . "-" . str_pad($e['EID'], 3, "0", false);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code กิจกรรม</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container bg-light mt-5">
        <div class="col-10 mx-auto p-2 rounded">
            <h1 class="w-100 text-center pb-2 border-bottom border-3">QR Code กิจกรรม</h1>
            <div class="bg-white p-2 mb-2">
                <div class="col-10 mx-auto" style="max-width:450px">
                    <div class="row">
                        <div class="col-auto mx-auto">
                            <img class="mt-3 mb-2 img-thumbnail" width="210" height="210" src="<?= "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$link" ?>" alt="QR CODE">
                        </div>
                    </div>
                    <table class="table table-borderless">
                        <tr>
                            <th>ชื่อกิจกรรม</th>
                            <td><?= $e['eventTitle'] ?> [<?= $eventCode ?>]</td>
                        </tr>
                        <tr>
                            <th>เริ่ม</th>
                            <td><?= date_format(date_create($e['start']), $dateFormat) ?></td>
                        </tr>
                        <tr>
                            <th>สิ้นสุด</th>
                            <td><?= date_format(date_create($e['end']), $dateFormat) ?></td>
                        </tr>
                        <tr>
                            <th>ปีการศึกษา <?= $e['eventOfYear'] ?></th>
                            <th><?= $e['eventCredit'] ?> หน่วยกิต</th>
                        </tr>
                    </table>
                    <div class="row mb-2">
                        <div class="col-auto ms-auto me-0">
                            <a href="#" class="btn btn-primary" onclick="history.go(-1)">
                                <i class="fa fa-backward me-1" aria-hidden="true"></i> กลับ
                            </a>
                            <a href="../conf/?id=<?= $_GET['id'] ?>" class="btn btn-warning">
                                <i class="fa fa-tasks me-1" aria-hidden="true"></i> จัดการ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-3">
                <div class="col text-end">
                    <a role="button" href="../../school/console.php" class="btn btn-primary">
                        <i class="fa fa-tachometer-alt me-1" aria-hidden="true"></i>
                        กลับหน้าควบคุม
                    </a>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

</body>

</html>