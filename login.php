<?php
$status = 0;
session_start();
session_destroy();
require_once './db_connect.php';
if (isset($_REQUEST['submit'])) {
    $email = $_REQUEST['email'];
    $passwd = $_REQUEST['password'];
    $password = sha1($passwd);

    $query = "select * from users where email='$email' and password='$password'";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['verified'] == 0) {
            $status = 1;
        } else {
            session_start();
            $_SESSION['email'] = $row['email'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];
            if ($row['role'] == 'admin') {
                header('Location: admin/index.php');
            } else {
                header('Location: member/index.php');
            }
        }
    } else {
        $status = 2;
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         <?php require_once './include/style.inc.php'; ?>
        <style>
            #main{
                margin: auto;
                padding: 15px;
                text-align: center;
                min-height: 500px;
                width:80%;

            }
            table{
                margin: auto;
                width: 70%;
            }
            td{
                padding: 10px;
            }
        </style>
       
    </head>
    <body>
        <?php
        require_once './include/header.inc.php';
        ?>
        <div id="main">
            <h1 class="button alt">LOGIN HERE : </h1>
            <form action="login.php" method="POST">
                <table>
                    <tr>
                        <td>Email : </td>
                        <td> <input type="text" name="email" value="" placeholder="Enter your email" required=""/></td>
                    </tr>
                    <tr>
                        <td>Password : </td>
                        <td> <input type="password" name="password" value="" placeholder="Enter your password" required=""/></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit"name="submit" value="Login" />
                        </td>
                    </tr>
                </table>
                <br><br>
                <a href="forgot_password.php" class="button alt">Forget Password ? </a>
                <br><hr>
                <a href="registration.php" class="button alt">Do not have an Account ? Register Now </a>

            </form>
            <?php
            if ($status == 1) {
                echo 'Your email is not verified. Please verify your email.';
            }
            ?>
            <?php
            if ($status == 2) {
                echo 'Error! email or password is incorrect. Please try again!';
            }
            ?>


        </div>



        <?php require_once './include/footer.inc.php'; ?>
    </body>
</html>
