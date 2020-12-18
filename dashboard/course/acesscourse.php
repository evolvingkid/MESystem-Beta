<?php 

include('../../config/SQL/index.php');
$conn  = mySql();

$sql = "SELECT *,(superUser.id)superUserID,(program.id)programID,(course.id)courseID   FROM course
LEFT JOIN program ON program.id = course.programid
LEFT JOIN superUser ON superUser.id = course.supeerUserID
LEFT JOIN user ON superUser.userid = user.id";

$result = $conn->query($sql);

$isSuperuser = false;


if (isset($_GET['admin'])) {
    
    if ($_GET['admin'] == 'true') {
        $isSuperuser = true;
    }

}

?>


<table class="table bg-white">
    <thead class="bg-primary text-white">
        <tr>
            <th>
                Course ID
            </th>
            <th>
                Course
            </th>
            <th>
                Program
            </th>
            <th>
                Exam Date
            </th>
            <th>
                Created/Edited
            </th>
            <th>

            </th>
        </tr>
    </thead>

    <?php
        if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
            ?>
    <tbody>
        <tr>
            <td> <?php echo $row['courseID']; ?> </td>
            <td> <?php echo $row['course_name']; ?> </td>
            <td> <?php echo $row['program name']; ?> </td>
            <td> <?php echo $row['examDate']; ?> </td>
            <td> <?php echo $row['name']; ?> </td>
            <td>
                <?php 
                if ($isSuperuser) { ?>
                <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#editProgram" btn-lg btn-block" onclick="editprogram('<?php echo $row['courseID']; ?>', '<?php echo $row['course_name']; ?>')">Edit</button>
                <button type="button" name="" id="" class="btn btn-danger" btn-lg btn-block" onclick="onDelete('<?php echo $row['courseID']; ?>')">Delete</button>
                <?php  
                }
                ?>

            </td>
        </tr>
    </tbody>
    <?php
     }
            }else{
                include('../assets/toast/index.php');
                $toastMsg = 'Sorry their is no data';
                showToastMsg('Program', $toastMsg, 'Now');
            }
            ?>
</table>
