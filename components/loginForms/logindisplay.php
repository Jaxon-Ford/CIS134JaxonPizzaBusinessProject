<?php
$errorCount = 0;
$isLogin = false;


function validateUserName($data, $fieldName) {
    global $errorCount;
    if (empty($data)) {
        echo "\"$fieldName\" is required.<br/>\n";
        ++$errorCount;
        $retrieval = "";
    } else {
        $retrieval = trim($data);
    }
    return $retrieval;
}

function validatePassword($data, $fieldName) {
    global $errorCount;
    if (empty($data)) {
        echo "\"$fieldName\" is required.<br/>\n";
        ++$errorCount;
        $retrieval = "";
    } else {
        $retrieval = trim($data);
    }
    return $retrieval;
}


function searchPasswordFile($user, $pass) {
    global $isLogin;

    $file = "password.txt";

    if (file_exists($file)) {

        $fp = fopen($file, "r");

        // Priming read
        $fileUser = trim(fgets($fp));

        while (!feof($fp)) {

            $filePass = trim(fgets($fp));

            if ($user === $fileUser && $pass === $filePass) {
                $isLogin = true;
                break;
            }

            $fileUser = trim(fgets($fp));
        }

        fclose($fp);
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>LoginDisplay</title>
</head>
<body>
<h1>Login Credentials</h1>
<?php
if (isset($_POST['Submit']) || isset($_POST['create'])) {
    $UserName = validateUserName($_POST["Username"], "username");
    $Password = validatePassword($_POST["Password"], "password");

    if ($errorCount == 0) {

        // ---------------- CREATE LOGIN ----------------
        if (isset($_POST['create'])) {

            $fp = fopen("password.txt", "a"); // Append mode

            fwrite($fp, $UserName . "\n");
            fwrite($fp, $Password . "\n");

            fclose($fp);

            echo "<p><strong>Login Created Successfully!</strong></p>";
        }

        if (isset($_POST['Submit'])) {

            searchPasswordFile($UserName, $Password);

            if ($isLogin) {
                echo "<p><strong>Login Successful!</strong></p>";
            } else {
                echo "<p><strong>Invalid Username or Password.</strong></p>";
            }
        }

    } else {
        echo "<p>Please re-enter your login information.</p>";
    }
}
?>
</body>
</html>