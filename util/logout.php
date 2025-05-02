<?php

session_start();    // start session if not already
session_unset();    // clear all session vars
session_destroy();  // destroy the session

header('Location: ../index.php');  // back to homepage
exit;
