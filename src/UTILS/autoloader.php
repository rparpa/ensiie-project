<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../src/MODEL/REPOSITORY/UserRepository.php';
include_once '../src/MODEL/ENTITY/User.php';