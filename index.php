<?php
session_start();

require 'includes/checklogin.php';

header("Location: dashboard.php");

?>