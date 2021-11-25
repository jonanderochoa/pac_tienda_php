<?php
if ($_SESSION['registered']) {
    session_destroy();
    header("location:index.php");
    exit();
}
