<?php
$errorCount = 0;


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
?>


<!DOCTYPE html>
<html>
<head>
    <title>LoginDisplay</title>
</head>
<body>
<h1>Login Credentials</h1>
<?php
if (isset($_POST['Submit'])) {
    $UserName = validateUserName($_POST["Username"], "username");
    $Password = validatePassword($_POST["Password"], "password");
    echo "<p>Thank you for logging in, $UserName</p>";
    echo "<p>Your password is $Password</p>";
}
?>
</body>
</html>