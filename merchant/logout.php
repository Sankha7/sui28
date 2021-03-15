<?php
    session_start();
    unset($_SESSION['ADMIN_LOGIN']);
    unset($_SESSION['ADMIN_USERNAME']);
    unset($_SESSION['MERCHANT_ID']);
    header('location: index');
    die();
