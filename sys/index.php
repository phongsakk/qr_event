<?php
session_start();
if (empty($_SESSION['UID'])) header('Location: ../school/login.php');
if ($_SESSION["status"] === "USER") include_once './sys_student.php';
if ($_SESSION["status"] === "ADMIN") include_once './sys_teacher.php';
