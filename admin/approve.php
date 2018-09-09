<?php
require_once './admin.secure.php';
require_once '../db_connect.php';
if(isset($_REQUEST['approve'])){
    $roll_number= $_REQUEST['approve'];
    $query = "update students set approved=1 where roll_number=$roll_number";
    if(mysqli_query($con, $query)){
        header('Location: approve.php');
    }
}
if(isset($_REQUEST['delete'])){
    $roll_number = $_REQUEST['delete'];
    $query = "delete from students where roll_number=$roll_number";
      if(mysqli_query($con, $query)){
        header('Location: approve.php');
    }
}
$query = "select * from students where approved=0";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Student Approval</title>
        <?php require_once './style.inc.php'; ?>
        <style>
            #main{
                padding:15px;
                margin: auto;
            }
        </style>
        
    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        <div id="main">
            <h1 class="button big">STUDENT APPROVAL :</h1>  
            <?php if (mysqli_num_rows($result) == 0) { ?>
                <h3 style="color: red">No more pending Approval!</h3>
            <?php } else { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Roll Number</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email ID</th>
                            <th>Mobile Number</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $row['roll_number']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['gender']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['mobile_number']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td>
                                    <a href="approve.php?approve=<?php echo $row['roll_number']; ?>" class="button small">Approve</a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a onclick="return confirm('Delete this record')" href="approve.php?delete=<?php echo $row['roll_number']; ?>" title="Delete Record"><img src="../images/delete.png" alt=""/> Delete</a>
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
