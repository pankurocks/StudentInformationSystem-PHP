<?php
require_once './admin.secure.php';
require_once '../db_connect.php';
$status=0;

if(isset($_REQUEST['submit'])){
    $email=$_REQUEST['email'];
    $name = $_REQUEST['name'];
    $role = $_REQUEST['role'];
    $query="update users set name='$name',role='$role' where email='$email'";
    if(mysqli_query($con, $query)){
        $status =1;
    }else{
        $status=2;
    }
}
elseif(isset($_REQUEST['email'])){
    $email=$_REQUEST['email'];
    $query = "select email,name,role from users where email='$email'";
   
    $result = mysqli_query($con, $query);
}
else{
    header('Location: manage_users.php');
}


?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <?php require_once './style.inc.php'; ?>
        <style>
            #main{
                text-align: center;
                padding: 15px;
                margin: auto;
            }
            #view{
                padding: 15px;
                margin: auto;
            }
            table,td{
                padding: 10px;
                width:60%;
                margin: auto;
            }
        </style>

    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        <div id="main">
            <?php if($status==0) { ?>
            <h1 class="button small">Edit User Information :</h1>
            <?php while($row=mysqli_fetch_assoc($result)) {?>
            <form action="edit_users.php" method="POST">
            <table>
                
                <tr>
                    <td>Email : </td>
                    <td><input type="text" name="email" value="<?php echo $row['email'];?>" readonly="" /></td>
                </tr>
                <tr>
                    <td>Name : </td>
                    <td><input type="text" name="name" value="<?php echo $row['name'];?>" /></td>
                </tr>
                <tr>
                    <td>Role : </td>
                    <td><select name="role">
                            <option <?php if ($row['role'] == 'admin') { ?> selected="selected" <?php } ?>>admin</option>
                            <option <?php if ($row['role'] == 'member') { ?> selected="selected" <?php } ?>>member</option>
                        </select> </td>
                </tr>
                <tr>
                    <td colspan="2"> <input type="submit" value="Update" name="submit" /></td>
                </tr>
            </table>
                </form>
            <?php }?>
            <?php }?>
            <?php if($status==1) {?>
            <h1 class="button big">Record Updated</h1><br>
            <a href="manage_users.php" class="button big">Go Back to Manage Users</a>
            <?php }?>

        </div>

        <?php require_once './footer.inc.php'; ?>
    </body>
</html>
