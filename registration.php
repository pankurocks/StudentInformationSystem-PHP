<?php

function get_verification_code() {
    $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = str_shuffle($str);
    $str = substr($str, 1, 20);
    return $str;
}

$template = 0;
$email = '';
$name = '';
$password = '';
$confirm_password = '';
$question = '';
$answer = '';
$errors = array();


if (isset($_REQUEST['submit'])) {
    require_once './db_connect.php';
    $email = $_REQUEST['email'];
    $name = $_REQUEST['name'];
    $password = $_REQUEST['password'];
    $confirm_password = $_REQUEST['confirm_password'];
    $question = $_REQUEST['question'];
    $answer = $_REQUEST['answer'];
    
    //Verification Stage 1:
    if ($email == '') {
        $errors['email'] = 'Email is Required!';
    }
    if ($name == '') {
        $errors['name'] = 'Name is Required!';
    }
    if ($password == '') {
        $errors['password'] = 'Password is Required !';
    }
    if ($confirm_password == '') {
        $errors['confirm_password'] = 'Re-enter your Password !';
    }
    if ($answer == '') {
        $errors['answer'] = 'Please write an answer !';
    }
    
    //Verification Stage 2:
    if(count($errors==0)){
        if(!preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)){
            $errors['email']='Please enter a valid email !';
        }
        if((strlen($password)) < 6){
            $errors['password']='Password must be atleast of 6 characters!';
        }
        if(strlen($confirm_password!=$password)){
            $errors['confirm_password']='Password do not match!';
        }
        if(!preg_match('/^[A-Za-z\s]+$/', $name)){
            $errors['name']='Name contains some invalid characters !';
        }
    }
    
    //Verification Stage 3:
    if(count($errors)==0){
        $query = "select * from users where email='$email'";
        $result = mysqli_query($con,$query);
        if (mysqli_num_rows($result) == 1) {
            $errors['email'] = 'Email ID already exists';
        }
    }

    if (count($errors) == 0) {
        $role = "member";
        $verified = 0;
        $verification_code = get_verification_code();
        $query = "insert into users values ('$email','$name','$password','$role','$question','$answer',$verified,'$verification_code')";
        if (mysqli_query($con, $query)) {
            $template = 1;
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
            $mail->Subject = 'Registration Confirmed : Student Information System';
            $message = 'Congratulations, Your Registration is Confirmed !' . '<br>Your Verification Code is: <strong>' . $verification_code . '</strong>' .
                    '<br>Please verify your email by clicking the below link :' .
                    '<a href="http://localhost/StudentInformationSystem/verify_email.php?email=' . $email . '&verification_code=' . $verification_code . '"><br> -- Click Here to Verify Email -- </a>' .
                    '<br><br>Thank you!! <br><br>--<br>Regards,<br>Pankaj Chaudhary <br>Student Information System Admin';
            $mail->msgHTML($message);
            if (!$mail->send()) {
                // echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                //echo "Message sent!";
            }
        }
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
                text-align: justify;
                width: 75%;
            }
            td{
                padding: 10px;
            }
            .error{
                color: red;
                font-size: 1.2em;
            }

        </style>

    </head>
    <body>
        <?php
        require_once './include/header.inc.php';
        ?>
        <div id="main">
            <?php if ($template == 0) { ?>
                <h1 class="button alt">Registration Form : </h1>
                <form action="registration.php" method="POST">
                    <table>
                        <tr>
                            <td>Email : </td>
                            <td> <input type="text" name="email" value="<?php echo $email?>" placeholder="Enter your email"  /></td>
                            <td> <span class="error"> * </span>
                                <?php if(isset($errors['email'])) {?>
                                <span class="button alt small"> <?php echo $errors['email']; ?> </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Name : </td>
                            <td> <input type="text" name="name" value="<?php echo $name?>" placeholder="Enter your Name" /></td>
                            <td> <span class="error"> * </span>
                                <?php if(isset($errors['name'])) {?>
                                <span class="button alt small"> <?php echo $errors['name']; ?> </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Password : </td>
                            <td> <input type="password" name="password" value="<?php echo $password?>" placeholder="Enter your password" /></td>
                            <td> <span class="error"> * </span>
                                <?php if(isset($errors['password'])) {?>
                                <span class="button alt small"> <?php echo $errors['password']; ?> </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Confirm Password : </td>
                            <td> <input type="password" name="confirm_password" value="" placeholder="Re-enter your password" /></td>
                            <td> <span class="error"> * </span>
                                <?php if(isset($errors['confirm_password'])) {?>
                                <span class="button alt small"> <?php echo $errors['confirm_password']; ?> </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Security Question : </td>
                            <td> <select name="question">
                                    <option>What is your favourite movie?</option>
                                    <option>What is the name of your first school?</option>
                                    <option>What is your mother's first name?</option>
                                    <option>What is your favourtie pet?</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td>Answer : </td>
                            <td> <input type="text" name="answer" value="<?php echo $answer?>" placeholder="Enter your answer" /></td>
                            <td> <span class="error"> * </span>
                                <?php if(isset($errors['answer'])) {?>
                                <span class="button alt small"> <?php echo $errors['answer']; ?> </span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align:center">
                                <input type="submit" name="submit" value="Sign Up" />
                            </td>
                        </tr>
                    </table>
                    <br>
                    <a href="login.php" class="button alt">Already Registered? Login Here </a>

                </form>
            <?php } ?>
            <?php if ($template == 1) { ?>
                <h1 class="button disabled">Registration Successful!</h1><br>
                <h1 class="button disabled">An email has been sent to you with verification code! Click on the link or copy the verification code and verify here..</h1><br>
                <a href="verify_email.php" class="button">Verify Email</a>
            <?php } ?>

        </div>
        <?php require_once './include/footer.inc.php'; ?>
    </body>
</html>
