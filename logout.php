<?php
session_start();
$_SESSION = [];
session_destroy();

header("Location: /bazar/login.php");
exit;
