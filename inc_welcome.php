<?php
session_start(); // Start or resume session

// Default values
$isValid = false;
$username = "";

/* Get login status from session storage */
if (isset($_SESSION["isValidUser"])) {
    $isValid = $_SESSION["isValidUser"];
}

/* Get username from cookie storage */
if (isset($_COOKIE["username"])) {
    $username = $_COOKIE["username"];
}

/* Display appropriate message */
if ($isValid == true) {
    echo "Welcome " . $username;
} else {
    echo "Please login";
}
?>