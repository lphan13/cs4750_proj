<?php
<<<<<<< HEAD
    session_start();
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) 
        && !empty($_POST['password'])) {
        if ($_POST['username'] == 'admin' && 
            $_POST['password'] == 'admin') {
=======
    require "dbutil.php";
    session_start();
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) { 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = DbUtil::loginConnection();
        $stmt = $db->stmt_init();
        if($stmt->prepare("select * from h_user where username = '$username' and password= '$password'") or die(mysqli_error($db))) {
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($found_username, $found_password);
          $stmt->fetch();
          $stmt->close();
        }
        $db->close();
        echo "username in db: " + $found_username;
        echo "pwd in db: " + $found_password;
        if(!empty($found_username) && !empty($found_password)){
>>>>>>> e2c5c5938d37789136fac44a94dac77a3312e341
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['msg'] = 'You have entered valid use name and password';
<<<<<<< HEAD
        }else {
            $_SESSION['msg'] = 'Wrong username or password';
=======
        }
        else {
            $_SESSION['msg'] = "Wrong username or password: username in db";
>>>>>>> e2c5c5938d37789136fac44a94dac77a3312e341
        }
    }
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    </head>
    <body>
    <?php 
        if($_SESSION['valid'] === true){
            header("Location: home.html");
        }
        else{
            header("Location: login.php");
        }
    ?>
    <br>
    The username you entered was: <?php echo $_SESSION['username'];?>
    </body>
</html>
