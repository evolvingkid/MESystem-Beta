<?php
function programTable($conn, $isSuperuser = FALSE)
{ 
    $sql = "SELECT *,(superUser.id)superUserID FROM program
            LEFT JOIN superUser ON superUser.id = program.supeerUserID
            LEFT JOIN user ON superUser.userid = user.id";
    $result = $conn->query($sql);
    ?>

<?php 
                if ($isSuperuser) { ?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Add new program </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="">Program Name</label>
                    <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Program name">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Add Program</button>
            </div>
        </div>
    </div>
</div>

<div class="float-right mb-2">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add
    </button>
</div>
<?php  
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
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['program name']; ?> </td>
            <td> <?php echo $row['name']; ?> </td>
            <td>
                <?php 
                if ($isSuperuser) { ?>
                <button type="button" name="" id="" class="btn btn-primary" btn-lg btn-block">Edit</button>
                <button type="button" name="" id="" class="btn btn-danger" btn-lg btn-block">Delete</button>
                <?php  }
                ?>

            </td>
        </tr>
    </tbody>
    <?php
     }
            }else{
                include('../assets/toast/index.php');

                $toastMsg = 'Sorry you are not Superuser so you cant add new programs';
                if ($isSuperuser) {
                    $toastMsg = 'Feel free to add new programs';
                }
                showToastMsg('Program', $toastMsg, 'Now');

            }
            ?>
</table>
<?php
}
?>