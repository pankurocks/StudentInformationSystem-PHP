<?php
require_once './member.secure.php';
require_once '../db_connect.php';
$query = "select * from students";
$result = mysqli_query($con, $query);
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
            }
        </style>
        
    </head>
    <body>
        <?php
        require_once './header.inc.php';
        ?>
        <div id="main">
            <ul class="actions">
                <li>
                    <a href="#view" class="button big">View All Students</a>
                </li>
                <li>
                    <a href="add_students.php" class="button big">Add Students</a>
                </li>
                <li>
                    <a href="search_student.php" class="button big">Search Students</a>
                </li>
                 <li>
                    <a href="approved.php" class="button big">View Approved Students</a>
                </li>
            </ul>
        </div>
        <div id="view">
            <h1 class="button disabled">Student List :</h1>
           <?php if(mysqli_num_rows($result)==0) { ?>
            <h3 style="color: red">Error !! No Record Found.</h3>
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
                    <td><?php echo $row['roll_number'];  ?></td>
                    <td><?php echo $row['name'];  ?></td>
                    <td><?php echo $row['gender'];  ?></td>
                    <td><?php echo $row['email'];  ?></td>
                    <td><?php echo $row['mobile_number'];  ?></td>
                    <td><?php echo $row['course'];  ?></td>
                    <td>
                        <a href="edit_student.php?roll_number=<?php echo $row['roll_number'];  ?>" title="Edit Record"><img src="../images/edit.png" alt=""/> Edit</a>
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
