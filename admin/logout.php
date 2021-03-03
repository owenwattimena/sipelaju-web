<?php
    session_start();
    unset($_SESSION['loged']);
    session_destroy();
    header('location:../');
    die;
?>