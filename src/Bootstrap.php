<?php
@ob_start();
//session_start();
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
include '../vendor/autoload.php';
