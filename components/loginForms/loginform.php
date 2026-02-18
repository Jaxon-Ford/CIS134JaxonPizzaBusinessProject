<?php
// Check if username cookie exists
$cookieUser = "";

if (isset($_COOKIE["username"])) {
    // Retrieve username from cookie
    $cookieUser = $_COOKIE["username"];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
<p><b>Login</b></p>
<form name="login" action="logindisplay.php" method="post">
    <p>Enter your Username: <input type="text" name="Username" value="<?php echo $cookieUser; ?>" /></p>
    <p>Enter your password <input type="text" name="Password" value="" /></p>
    <p>
        <input type="reset" value="Clear Form" />
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="submit" name="Submit" value="Send Form" />
        &nbsp;&nbsp;
        <input type="submit" name="create" value="Create Account" />
    </p>
</form>
</body>
</html>