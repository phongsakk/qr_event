<?php
$db_host = "localhost";
$db_user = "root";
$db_pswd = "";
$db_name = "db_event";

date_default_timezone_set("Asia/Bangkok");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli($db_host, $db_user, $db_pswd, $db_name);
    $mysqli->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    exit();
}
