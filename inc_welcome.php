<?php
$isLogin = false;
$username = null;

if ($isLogin == true) {
    echo "Welcome " . $_SESSION['username'];
} else {
    echo "Please login";
}