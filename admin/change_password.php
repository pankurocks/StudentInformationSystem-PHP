<?php
require_once './admin.secure.php';
require_once '../db_connect.php';
$status = 0;
if (isset($_REQUEST['submit'])) {
    $email = $_SESSION['email'];
    $query = "select * from users where email='$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $answer = $row['answer'];
    $input = $_REQUEST['input'];
    if ($answer == $input) {
        $status = 1;
    }
} else if (isset($_REQUEST['change'])) {
    $email = $_SESSION['email'];
    $current_password = sha1($_REQUEST['current_password']);
    $input_password = sha1($_REQUEST['new_password']);
    $query = "select * from users where email='$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $password = $row['password'];
    if ($password == $current_password) {
        $query = "update users set password='$input_password' where email='$email'";
        $result = mysqli_query($con, $query);
        $status = 2;
    } else {
        $status = 3;
    }
} else {
    $email = $_SESSION['email'];
    $query = "select * from users where email='$email'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $answer = $row['answer'];
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <?php require_once './style.inc.php'; ?>
        <style>
            #main{
                margin: auto;
                text-align: center;
                padding: 15px;
            }
            table{
                width: 60%;
                padding: 15px;
                margin: auto;
            }
        </style>
    </head>
    <body>
        <?php require_once './header.inc.php'; ?>
        <div id="main">
            <h1 class="button alt">Change Password :</h1>
            <form action="change_password.php" method="POST">
                <?php if ($status == 0) { ?>
                    <table>
                        <tr>
                            <td>Security Question : </td>
                            <td><?php echo $row['question']; ?></td>
                        </tr>
                        <tr>
                            <td>Answer : </td>
                            <td><input type="text" name="input" value="" required=""/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Submit" name="submit" /></td>
                        </tr>
                    </table>
                <?php } ?>
                <?php if ($status == 1) { ?>
                    <table>
                        <tr>
                            <td>Enter Current Password : </td>
                            <td><input type="password" name="current_password" value="" /></td>
                        </tr>
                        <tr>
                            <td>Enter New Password : </td>
                            <td><input type="password" name="new_password" value="" /></td>
                        </tr>
                        <tr>
                            <td>Confirm New Password : </td>
                            <td><input type="password" name="new_password" value="" /></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Change Password" name="change"/></td>
                        </tr>
                    </table>
                <?php } ?>

            </form>
            <?php if ($status == 2) { ?>
            <h1 class="button big">Password Changed Successfully! </h1>
            
            <?php } ?>
            <?php if ($status == 3) { ?>
            <h1 class="button disabled">Password not matched! </h1> <br>
            <a href="change_password.php"class="button small">Try Again !</a>
            <?php } ?>

        </div>
        <?php require_once './footer.inc.php'; ?>
    </body>
</html>
