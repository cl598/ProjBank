<link rel="stylesheet" href="static/css/styles.css">

<?php require_once(__DIR__ . "/partials/nav.php"); ?>

<?php

//since this function call is included we can omit it here. Having multiple calls to session_start() will cause errors/warnings

//session_start();
// remove all session variables
session_unset();

// destroy the session
session_destroy();

echo "<p>You have successfully logged out. <br>See you next time!</p>";
