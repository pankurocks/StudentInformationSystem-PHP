<?php
require_once './admin.secure.php';
require_once '../db_connect.php';
if(isset($_REQUEST['delete'])){
    $email = $_REQUEST['delete'];
    $query = "delete from users where email='$email'";
      if(mysqli_query($con, $query)){
        header('Location: manage_users.php');
    }
}
$query = "select email,name,role,verified from users where role='member'";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <?php require_once './style.inc.php';?>
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
            }
        </style>
        
    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        
        <div id="view">
            <h1 class="button disabled">Users List :</h1>
           <?php if(mysqli_num_rows($result)==0) { ?>
            <h3 style="color: red">Error !! No Record Found.</h3>
        <?php } else { ?>
        <table>
            <thead>
                <tr>
                    <th>Email ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['email'];  ?></td>
                    <td><?php echo $row['name'];  ?></td>
                    <td><?php echo $row['role'];  ?></td>
                    <td><?php if($row['verified']==1) echo 'Email Verified'; else echo'Email Not Verified';  ?></td>
                   
                    <td>
                        <a href="edit_users.php?email=<?php echo $row['email'];  ?>" title="Edit Record"><img src="../images/edit.png" alt=""/> Edit</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Delete this record')" href="manage_users.php?delete=<?php echo $row['email'];  ?>" title="Delete Record"><img src="../images/delete.png" alt=""/> Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php } ?>             
        </div>

<?php require_once './footer.inc.php'; ?>
    </body>
</html>
