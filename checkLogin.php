<?php
    session_start();
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) 
        && !empty($_POST['password'])) {
        if ($_POST['username'] == 'admin' && 
            $_POST['password'] == 'admin') {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            $msg = 'You have entered valid use name and password';
        }else {
            $msg = 'Wrong username or password';
        }
    }
?>
<html>
    <?php 
        echo $msg;
    ?>
    <br>
    The username you entered was: <?php echo $_SESSION['username'];?>
</html>
