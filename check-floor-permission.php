<?php
session_start();
if ($_SESSION['id'] = false) {
    header("location: unauthorised.php");
} else {
    if ($_SESSION['position'] != "Factory Manager" and $_SESSION['position'] != "Production Operator") {
        header("location: unauthorised.php");
    }
}