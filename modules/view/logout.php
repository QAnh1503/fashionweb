<?php
    ### Handle LOG OUT ###
    unset($_SESSION['is_login']);
    unset($_SESSION['email_login']);
    setcookie('is_login', '', time()-3600, '/');
    setcookie('email_login', '', time()-3600, '/');
    header("Location: login.php");
?>