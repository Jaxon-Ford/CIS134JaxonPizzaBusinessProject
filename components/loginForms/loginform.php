<!DOCTYPE html>
<html>
<head>
    <!-- formv1.php Created 5-7-2018 by Ray Ryon -->
    <!-- This page is an example of form input. -->
    <title>Login Form</title>
</head>
<body>
<p><b>Login</b></p>
<form name="login" action="logindisplay.php" method="post">
    <p>Enter your Username: <input type="text" name="Username" value="" /></p>
    <p>Enter your password <input type="text" name="Password" value="" /></p>
    <p>
        <input type="reset" value="Clear Form" />
        &nbsp;&nbsp;
        <input type="submit" name="Submit" value="Send Form" />
    </p>
</form>
</body>
</html>