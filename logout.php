<?php
    include_once('libs/session.php');
    session_destroy();
    header('Location:index');
?>