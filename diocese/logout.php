<?php 
    session_start();
    session_unset("id");
    session_destroy();
    header("location:/religion/diocese/");
?>