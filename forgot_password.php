<?php
function generate_password() {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = str_shuffle($str);
    $str = substr($str, 1, 8);
    return $str;
}

require_once './db_connect.php';
$status = 0;
if (isset($_REQUEST['submit'])) {
    $email = $_REQUEST['email'];
    $query = "select * from users where email='$email'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result)==1){
      $status=1;
      $row = mysqli_fetch_assoc($result);
    }
    else{
        $status=3;
    }
}
if(isset($_REQUEST['question'])){
    $answer = $_REQUEST['answer'];
    $email = $_REQUEST['email'];
    $query = "select * from users where email='$email'";
    
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
   
    if($row['answer']===$answer){
        $status=2;
        $generated_password = generate_password();
        $password = sha1($generated_password);
        $query = "update users set password='$password' where email='$email'";
        mysqli_query($con, $query);
        
        //Mail Send to user:-
        require 'include/class.phpmailer.php';
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "droidguruindia@gmail.com";
            $mail->Password = "password";
            $mail->setFrom('droidguruindia@gmail.com', 'Pankaj Chaudhary');
            $mail->addAddress($email, '');
            $mail->Subject = 'Password Changed : Student Information System';
            $message = 'Hello, Your Password is Changed !' . '<br>Your New Password is: <strong>' . $generated_password . '</strong>' .
                    '<br>You can login into your account using the following password :' .
                    '<a href="http://localhost/StudentInformationSystem/login.php"><br> -- Click Here to Login -- </a>' .
                    '<br><br>Thank you!! <br><br>--<br>Regards,<br>Pankaj Chaudhary <br>Student Information System Admin';
            $mail->msgHTML($message);
            if (!$mail->send()) {
                // echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                //echo "Message sent!";
            }
    }else{
        $status = 4;
    }  
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <?php require_once './include/style.inc.php'; ?>
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
        <?php require_once './include/header.inc.php'; ?>
        <div id="main">
            <h1 class="button alt">Change Password :</h1>
            <form action="forgot_password.php" method="POST">
                <?php if ($status == 0) { ?>
                    <table>
                        <tr>
                            <td>Enter your Registered Email ID : </td>
                            <td><input type="text" name="email" value="" required=""/></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2"><input type="submit" value="Submit" name="submit" /></td>
                        </tr>
                    </table>
                <?php } ?>
                <?php if ($status == 1) { ?>
                    <table>
                        <tr>
                            <td>Email ID : </td>
                            <td><input type="text" name="email" value="<?php echo $row['email']; ?>" readonly=""/></td>
                        </tr>
                        <tr>
                            <td>Security Question : </td>
                            <td><input type="text" name="question" value="<?php echo $row['question']; ?>" readonly=""/></td>
                        </tr>
                        <tr>
                            <td>Answer : </td>
                            <td><input type="text" name="answer" value="" required=""/></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Submit" name="question" /></td>
                        </tr>
                    </table>
                <?php } ?>

            </form>
            
            <?php if ($status == 2) { ?>
            <h1 class="button big">An Email with a temporary password has been sent to you! Please check your email! </h1>
            <?php } ?>
            
            <?php if ($status == 3) { ?>
            <h1 class="button disabled">Email ID not found! Please enter your registered email carefully! </h1> <br>
            <a href="forgot_password.php"class="button small">Try Again !</a>
            <?php } ?>
            
            <?php if ($status == 4) { ?>
            <h1 class="button alt big">Answer Do not Match! </h1> <br><hr>
            <a href="forgot_password.php"class="button big">Try Again !</a>
            <?php } ?>

        </div>
        <?php require_once './include/footer.inc.php'; ?>
    </body>
</html>
