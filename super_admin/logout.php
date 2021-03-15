<?php
    session_start();
    unset($_SESSION['SUPER_ADMIN_LOGIN']);
    unset($_SESSION['SUPER_ADMIN_USERNAME']);
    header('location: index');
    die();
