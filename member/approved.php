<?php
require_once './member.secure.php';
require_once '../db_connect.php';
$query = "select * from students where approved=1";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Approved Students</title>
        <?php require_once './style.inc.php';?>
        <style>
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
            <h1 class="button disabled">Approved Student List :</h1>
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
                    <th>Status</th>
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
                        <h1 class="button small" style="color:green">APPROVED</h1>
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
