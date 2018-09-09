<?php
$status=0;
if(isset($_REQUEST['email'])){
    $email=$_REQUEST['email'];
    $verification_code = $_REQUEST['verification_code'];
    require_once './db_connect.php';
    $query = "select verified,verification_code from users where email = '$email'";
    $result = mysqli_query($con, $query);
    
    $row = mysqli_fetch_assoc($result);
    if($row['verified']==1){
        $status =1;
    }else{
        $code = $row['verification_code'];
        if($code==$verification_code){
            $query="update users set verified=1 where email='$email'";
           
            mysqli_query($con, $query);
            $status=2;
        }else{
            $status =3;
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Verify Email</title>
        <?php require_once './include/style.inc.php';?>
        <style>
            #main{
                margin:auto;
                padding:15px;
                text-align: center;
            }
            table{
                width:60%;
                padding:15px;
                margin:auto;
            }
        </style>
    </head>
    <body>
        <?php require_once './include/header.inc.php';?>
        <div id="main">
            <?php if($status==0) { ?>
            <h1 class="button disabled">Verify Email :</h1>
            <form action="verify_email.php" method="POST">
                <table>
                    <tr>
                    <td>Email : </td>
                    <td><input type="text" name="email" value="" required=""/></td>
                    </tr>
                    <tr>
                    <td>Verification Code : </td>
                    <td><input type="text" name="verification_code" value="" required=""/></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Verify" name="submit"/></td>
                    </tr>
                    
                </table>
            </form>
            <?php }?>
            <?php if($status==1) {?>
            <h1 class="button big">Email is already Verified !</h1><br>
            <a href="login.php" class="button big">Click Here to Login</a>
            <?php }?>
            <?php if($status==2) {?>
            <h1 class="button big">Congrats! Email is successfully Verified !</h1><br>
            <a href="login.php" class="button big">Click Here to Login</a>
            <?php }?>
            <?php if($status==3) {?>
            <h1 class="button big">Error! Verification Code not matched !</h1><br>
            <a href="verify_email.php" class="button big">Try Again</a>
            <?php }?>
            
        </div>
         <?php require_once './include/footer.inc.php';?>
    </body>
</html>
