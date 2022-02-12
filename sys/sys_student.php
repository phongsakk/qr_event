<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการระบบเช็กชื่อกิจกรรม</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container bg-light mt-5">
        <div class="col-10 mx-auto p-2 rounded">
            <h1 class="w-100 text-center pb-2 border-bottom border-3">ระบบเช็กชื่อกิจกรรม</h1>
            <div class="bg-white p-2 mb-2">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>กิจกรรม</th>
                            <th>ปีการศึกษา</th>
                            <th>หน่วยกิต</th>
                            <th>ประเภท</th>
                            <th>เวลา</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        <?php
                        include("../school/conn/object_connect.php");

                        $dateFormat = "F dS,Y H:i:s";

                        $recordCount = 25;
                        $page = isset($_GET['page']) ? ($_GET['page'] - 1) : 0;
                        $startRecord = $page * $recordCount;

                        $sql = "SELECT * FROM tb_useronevent u 
                                INNER JOIN tb_event e 
                                ON u.EID=e.EID WHERE u.UID=? 
                                ORDER BY e.eventType,
                                    u.timestamp DESC 
                                LIMIT ?,?";
                        $stmt = $mysqli->prepare($sql);
                        $stmt->bind_param("iii", $_SESSION['UID'], $startRecord, $recordCount);
                        $stmt->execute();
                        $events = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        $stmt->close();

                        $eventTypes = ["กิจกรรมบังคับ", "กิจกรรมบังคับเลือก", "กิจกรรมเลือก"];

                        foreach ($events as $event) :
                            $eventCode = substr($event['eventOfYear'] - 543, 2) . (array_search($event['eventType'], $eventTypes) + 1) . "-" . str_pad($event['EID'], 3, "0", false);
                        ?>
                            <tr>
                                <td><?= $eventCode ?></td>
                                <td class="text-start"><?= $event['eventTitle'] ?></td>
                                <td><?= $event['eventOfYear'] ?></td>
                                <td><?= $event['eventCredit'] ?></td>
                                <td><?= $event['eventType'] ?></td>
                                <td><?= date_format(date_create($event['timestamp']), $dateFormat) ?></td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js"></script>

</body>

</html>