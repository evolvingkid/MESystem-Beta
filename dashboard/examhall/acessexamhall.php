<?php 

include('../../config/SQL/index.php');
$conn  = mySql();

$sql = "SELECT *,(superUser.id)superUserID,(examhall.id)examID  FROM examhall
LEFT JOIN superUser ON examhall.superuser_ID = superUser.id
LEFT JOIN user ON user.id = superUser.userid";

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
                Id
            </th>
            <th>
                Exam hall
            </th>
            <th>
                seats
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
            <td> <?php echo $row['examID']; ?> </td>
            <td> <?php echo $row['hallname']; ?> </td>
            <td> <?php echo $row['seats']; ?> </td>
            <td> <?php echo $row['name']; ?> </td>
            <td>
                <?php 
                if ($isSuperuser) { ?>
                <button type="button" name="" id="" class="btn btn-primary" data-toggle="modal" data-target="#editProgram" btn-lg btn-block" onclick="editprogram('<?php echo $row['hallname']; ?>')">Edit</button>
                <button type="button" name="" id="" class="btn btn-danger" btn-lg btn-block" onclick="onDelete('<?php echo $row['examID']; ?>')">Delete</button>
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
