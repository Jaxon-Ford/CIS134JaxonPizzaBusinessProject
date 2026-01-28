<?php
    $passwords = [
        "Abcdef123!@#X",
        "MySecurePass#2024",
        "Qwerty!1234567",
        "Aa1!Bb2@Cc3#",

        "short1A!",
        "alllowercase123!",
        "ALLUPPERCASE123!",
        "NoSpecialChar123",
        "Bad Pass 123!" 
    ];

    echo "<h2>Password Checker</h2>";

    foreach ($passwords as $password) {
        $result = checkPassword($password);

        if ($result === TRUE) {
            echo "<b>$password</b> →<span style='color:green'>GOOD password</span><br><br>";
        } else {
            echo "<span style='color:red'>$result</span><br><br>";
        }
    }

function checkPassword($password) {

    // Rule 1: At least 12 characters
    if (strlen($password) < 12) {
        return "$password is invalid: Must be at least 12 characters long.";
    }

    // Rule 2: No spaces
    if (strpos($password, " ") !== false) {
        return "$password is invalid: Must not contain spaces.";
    }

    // Rule 3: At least one uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        return "$password is invalid: Must contain at least one uppercase letter.";
    }

    // Rule 4: At least one lowercase letter
    if (!preg_match('/[a-z]/', $password)) {
        return "$password is invalid: Must contain at least one lowercase letter.";
    }

    // Rule 5: At least one number
    if (!preg_match('/[0-9]/', $password)) {
        return "$password is invalid: Must contain at least one number.";
    }

    // Rule 6: At least one special character
    if (!preg_match('/[^a-zA-Z0-9]/', $password)) {
        return "$password is invalid: Must contain at least one special character.";
    }

    // If it passes all checks
    return TRUE;
}

?>