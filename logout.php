<?php
session_start();
unset($_SESSION["id"]);
unset($_SESSION["name"]);
echo "logout Successful";
?>
