<?php
include("../../school/conn/object_connect.php");
$EID = $_GET['id'];
$stmtUser = $mysqli->prepare("DELETE FROM tb_useronevent WHERE EID=?");
$stmtEvent = $mysqli->prepare("DELETE FROM tb_event WHERE EID=?");
$stmtUser->bind_param("i", $EID);
$stmtEvent->bind_param("i", $EID);
$stmtUser->execute();
$stmtEvent->execute();

header("location:../");
