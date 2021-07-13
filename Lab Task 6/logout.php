<?php

    if(session_status() >= 0){

        session_start();

        session_unset();

        session_destroy();

        echo "Logging Out...";

    }

    header("location: index.php");
    exit;
?>