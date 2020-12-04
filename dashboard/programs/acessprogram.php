<?php

include('../../config/SQL/index.php');
$conn  = mySql();

$sql = "SELECT *,(superUser.id)superUserID,(program.id)programID  FROM program
LEFT JOIN superUser ON superUser.id = program.supeerUserID
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
                sino
            </th>
            <th>
                Program Name
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
            <td> <?php echo $row['programID']; ?> </td>
            <td> <?php echo $row['program name']; ?> </td>
            <td> <?php echo $row['name']; ?> </td>
            <td>
                <?php 
                if ($isSuperuser) { ?>
                <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#editProgram" btn-lg btn-block" onclick="editprogram('<?php echo $row['programID']; ?>', '<?php echo $row['program name']; ?>')">Edit</button>
                <button type="button" name="" id="" class="btn btn-danger" btn-lg btn-block" onclick="onDelete('<?php echo $row['programID']; ?>')">Delete</button>
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

