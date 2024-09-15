<?php
session_start();
if ($_SESSION['id'] = false) {
    header("location: unauthorised.php");
} else {
    if ($_SESSION['position'] != "Auditor" and $_SESSION['position'] != "Administrator") {
        header("location: unauthorised-employee.php");
    }
}