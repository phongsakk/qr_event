<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (empty($_SESSION['UID'])) header("loction:../../school/login.php");
include("../../school/conn/object_connect.php");
if (isset($_POST['submit'])) {

    $eventTitle = $_POST['event_title'];
    $eventOfYear = $_POST['event_of_year'];
    $eventCredit = $_POST['event_credit'];
    $eventType = $_POST['event_type'];

    $eventStart = explode("T", $_POST['event_start']);
    $start = $eventStart[0] . " " . $eventStart[1];

    $eventEnd = explode("T", $_POST['event_end']);
    $end = $eventEnd[0] . " " . $eventEnd[1];

    $sql = "INSERT INTO tb_event(eventTitle,eventOfYear,eventCredit,eventType,start,end)VALUES(?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("siisss", $eventTitle, $eventOfYear, $eventCredit, $eventType, $start, $end);
    if (!$stmt->execute()) exit("ผิดพลาดในการบันทึกข้อมูล [ <a href='#' onclick='history.go(-1)'>กลับ</a> ]");
    header("location:../");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>กิจกรรมใหม่</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container bg-light mt-5">
        <div class="col-10 mx-auto p-2 rounded">
            <h1 class="w-100 text-center pb-2 border-bottom border-3">เพิ่มกิจกรรมใหม่</h1>
            <div class="bg-white p-2 mb-2">
                <div class="col-10 mx-auto" style="max-width:450px">
                    <form method="post">
                        <div class="row mb-2">
                            <label for="event_title" class="col-sm-3 col-form-label">ชื่อกิจกรรม</label>
                            <div class="col-sm-9">
                                <input type="text" name="event_title" class="form-control" value="ชื่อกิจกรรม" onfocus="this.select()">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="event_of_year" class="col-sm-3 col-form-label">ปีการศึกษา</label>
                            <div class="col-sm-9">
                                <select title="ปีการศึกษา" name="event_of_year" class="form-select">
                                    <?php
                                    $year = date("Y") + 543;
                                    for ($i = $year - 2; $i < $year + 4; $i++) :
                                    ?>
                                        <option value="<?= $i ?>" <?= ($i === $year) ? "selected" : "" ?>><?= $i ?> | <?= $i - 543 ?></option>
                                    <?php
                                    endfor;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="event_credit" class="col-sm-3 col-form-label">หน่วยกิต</label>
                            <div class="col-sm-9">
                                <select title="หน่วยกิต" name="event_credit" class="form-select">
                                    <option>1</option>
                                    <option>2</option>
                                    <option selected>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="event_type" class="col-sm-3 col-form-label">ประเภท</label>
                            <div class="col-sm-9">
                                <select title="ประเภทกิจกรรม" name="event_type" class="form-select">
                                    <option>กิจกรรมบังคับ</option>
                                    <option>กิจกรรมบังคับเลือก</option>
                                    <option selected>กิจกรรมเลือก</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <?php
                            $date = date('Y-m-d') . "T08:00";
                            ?>
                            <label for="event_start_end" class="col-sm-3 col-form-label">วัน-เวลา</label>
                            <div class="col-sm-9">
                                <div class="input-group mb-2">
                                    <span class="input-group-text">เริ่ม</span>
                                    <input type="datetime-local" name="event_start" class="form-control" value="<?= $date ?>">
                                </div>
                                <div class="input-group mb-2">
                                    <span class=" input-group-text">จบ</span>
                                    <input type="datetime-local" name="event_end" class="form-control" value="<?= $date ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-auto ms-auto me-0">
                                <button type="submit" class="btn btn-primary" name="submit">
                                    <i class="fa fa-save me-1" aria-hidden="true"></i> บันทึก
                                </button>
                            </div>
                        </div>
                    </form>
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