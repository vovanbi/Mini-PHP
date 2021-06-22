<?php

session_start();
unset($_SESSION['name_id']);
unset($_SESSION['name_user']);
header('location:sign-in.php');