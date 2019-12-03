<?php
    require "dbutil.php";
    session_start();
    $msg = '';
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) { 
        $username = $_POST['username'];
        $password = $_POST['password'];
        $db = DbUtil::loginConnection();
        $stmt = $db->stmt_init();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if($stmt->prepare("select * from h_user where username = '$username'") or die(mysqli_error($db))) {
          $stmt->bind_param(s, $searchString);
          $stmt->execute();
          $stmt->bind_result($found_username, $found_password);
          $stmt->fetch();
          $stmt->close();
        }
        $db->close();
        if(!empty($found_username)){
            if(password_verify($password, $found_password)){
                $_SESSION['valid'] = true;
                $_SESSION['timeout'] = time();
                $_SESSION['username'] = $_POST['username'];
            }
            else {
                $_SESSION['msg'] = "Wrong username or password";
            }
        }
        else {
            $_SESSION['msg'] = "Wrong username or password";
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
