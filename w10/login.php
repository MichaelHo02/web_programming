<?php
session_start();

if (isset($_POST['act'])) {
    if (isset($_POST['password']) && $_POST['password'] == 'p4ssw0rd') {
        $_SESSION['loggedin'] = true;
        header('location: add_product.php');
    } else {
        $error = 'Invalid username/password';
    }
}

if (isset($error)) {
    echo "<p>$error</p>";
}

?>

<form method="post" action="login.php">
    Username <input type="text" name="username"><br>
    Password <input type="password" name="password"><br>
    <input type="submit" name="act" value="Login">
</form>