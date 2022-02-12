<?php
session_start();
?>
<pre>
    <?= var_export($_REQUEST) ?>
    <?= var_export($_SESSION) ?>
</pre>
<?php

if (isset($_POST['Submit'])) {
    include_once("./form_connect.php");

    $mysqli = new phongsak;
    $sql = "SELECT * FROM tb_user WHERE username=? AND password=?";
    $user = $mysqli->__query($sql, array($_POST['txtUsername'], $_POST['txtPassword']));

    if (!$user) exit("ผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง [<a href=''>กลับ</a>]");
    $_SESSION['UID'] = $user['UID'];
    $_SESSION['status'] = $user['status'];
    session_write_close();
    name_chk($_SESSION['UID'], $_GET['token']);
    exit();
}

if (empty($_SESSION['UID'])) {
    include("./form_login.php");
    exit();
}

name_chk($_SESSION['UID'], $_GET['token']);

function name_chk(string $uid, string $eid): bool
{
    include_once("./form_connect.php");
    $binders = array($uid, $eid);
    $mysqli = new phongsak;
    $sql = "SELECT * FROM tb_useronevent WHERE UID=? AND EID=?";
    if (!count($mysqli->__query($sql, $binders))) {
        $sql = "INSERT INTO tb_useronevent(UID,EID)VALUES(?,?)";
        $mysqli->__query($sql, $binders);
    }

    header("location:../../school/console.php");

    return false;
}
