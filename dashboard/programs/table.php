<?php
function programTable($conn, $isSuperuser = FALSE)
{ 
    $sql = "SELECT *,(superUser.id)superUserID FROM superUser 
            LEFT JOIN program ON superUser.id = program.supeerUserID
            LEFT JOIN user ON superUser.userid = user.id";
    $result = $conn->query($sql);
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
                echo "No Data";
            }
            ?>
</table>
<?php
}
?>