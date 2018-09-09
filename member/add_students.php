<?php
require_once './member.secure.php';
$template=0;
$status=0;
if (isset($_REQUEST['submit'])) {
    $template=1;
    $roll_number = $_REQUEST['roll_number'];
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $gender = $_REQUEST['gender'];
    $mobile_number = $_REQUEST['mobile_number'];
    $course = $_REQUEST['course'];
    require_once '../db_connect.php';
    
    $query = "insert into students values ($roll_number,'$name','$email','$gender','$mobile_number','$course',0)";
    
    if(mysqli_query($con, $query)){
        $status=1;
    }else{
        $status=2;
    }
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Students</title>
        <?php require_once'./style.inc.php' ?>
        <style>
            #main{
                text-align: center;
                width: 60%;
                padding: 15px;
                margin: auto;
            }
            
            td{
                padding: 15px;
            }
        </style>
        
    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        <div id="main">
            <?php if($template==0) {?>
            <h1 class="button disabled">Student Registration :</h1>
            <form action="add_students.php" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>Roll Number : </td>
                            <td><input type="text" name="roll_number" value="" required="" /></td>
                        </tr>
                        <tr>
                            <td>Name :</td>
                            <td><input type="text" name="name" value="" required="" /></td>
                        </tr>
                        <tr>
                            <td>Gender :</td>
                            <td style="text-align:left">
                                <input type="radio" id="priority-normal" value="Male" name="gender">
				<label for="priority-normal">Male</label>
                                <input type="radio" id="priority-high" value="Female" name="gender">
				<label for="priority-high">Female</label>
                            </td>
                                
                        </tr>
                        <tr>
                            <td>Email :</td>
                            <td><input type="email" name="email" value="" required="" /></td>
                        </tr>
                        <tr>
                            <td>Mobile Number :</td>
                            <td><input type="number" name="mobile_number" value="" required="" /></td>
                        </tr>
                        <tr>
                            <td>Course :</td>
                            <td><select name="course">
                                    <option>Java</option>
                                    <option>Android</option>
                                    <option>PHP</option>
                                    <option>Python</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Submit" name="submit" /> &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="reset" value="Reset" /></td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <?php } ?>
            <?php if($template==1){
                if($status==1){ ?>
            <h1 style="color:green">Student is successfully registered. Please wait for Admin approval.</h1>
             <a href="add_students.php" class="button big">Add More Students</a>
                <?php } else{?>
             <h1 style="color:red">Error Occured! Please Try Again!!.</h1>
             <a href="add_students.php" class="button big">Go Back</a>
                <?php }?>
            <?php } ?> 
           
        </div>
        <?php
        require_once './footer.inc.php';
        ?>
    </body>
</html>