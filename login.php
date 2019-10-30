<?php 
    session_start();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container" style="max-width: 400px; text-align: center; margin-top: 10px;">
            <form action="checkLogin.php" method="POST">
                <h2>Login</h2>
                <?php
                if(!empty($_SESSION['msg'])) {
                    echo '<p style="color: red;"> '.$_SESSION['msg'].'</p>';
                    unset($_SESSION['msg']);
                }?> 
                <input type="text" class="form-control" style="margin: 2%;" name="username" id="username" placeholder="Username">
                <input type="password" class="form-control" style="margin: 2%;" name="password" id="password" placeholder="Password">
                <input type="submit" class="btn btn-primary" value="Submit" name="login">
            </form>
        </div>
    </body>
</html>