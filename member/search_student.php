<?php
require_once './member.secure.php';
$template = 0;
if (isset($_REQUEST['submit'])) {
    require_once '../db_connect.php';
    $roll_number = $_REQUEST['roll_number'];
    $query = "select * from students where roll_number=$roll_number";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        $template = 1;
        $row = mysqli_fetch_assoc($result);
    } else {
        $template = 3;
    }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Student Search</title>
        <style>
            #main,#result{
                margin: 15px;
                padding: 15px;
            }
        </style>
        <?php require_once './style.inc.php'; ?>
    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        <div id="main">
            <h1 class="button disabled">SEARCH STUDENT DATA :</h1>
            <form action="search_student.php" method="POST">
                <table>
                    <tr>
                        <td> Enter Roll Number : </td>
                        <td><input type="text" name="roll_number" value="" required=""/></td>
                        <td><input type="submit" value="Search" name="submit"/></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="result">
            <?php if($template==1){ ?>
            <h1 class="button disabled">STUDENT DATA :</h1>
            <table>
                <tr>
                    <td>Roll Number : </td>
                    <td> <?php echo $row['roll_number']; ?></td>
                </tr>
                <tr>
                    <td>Name : </td>
                    <td> <?php echo $row['name']; ?></td>
                </tr>
                <tr>
                    <td>Gender : </td>
                    <td> <?php echo $row['gender']; ?></td>
                </tr>
                <tr>
                    <td>Email : </td>
                    <td> <?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <td>Mobile Number : </td>
                    <td> <?php echo $row['mobile_number']; ?></td>
                </tr>
                <tr>
                    <td>Course : </td>
                    <td> <?php echo $row['course']; ?></td>
                </tr>
                <tr>
                    <td>Status : </td>
                    <td> <?php
                        if ($row['approved'] == 1) {
                            echo 'Approved';
                        } else {
                            echo 'Not Approved';
                        }
                        ?></td>
                </tr>
            </table>
            <?php }?>
            <?php if($template==3){ ?>
            <h1 class="button big">Record Not Found !</h1>
            <?php }?>
        </div>

        <?php require_once './footer.inc.php'; ?>
    </body>
</html>
