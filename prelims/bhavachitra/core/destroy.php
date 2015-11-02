<?php
session_start();
unset($_SESSION['id']);
unset($_SESSION['member_1']);
unset($_SESSION['member_2']);
session_unset();
echo "event's not up !";
?>