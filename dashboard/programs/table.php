<?php
function programTable($conn, $isSuperuser = FALSE, $SuperuserID)
{ 
    $sql = "SELECT *,(superUser.id)superUserID FROM program
            LEFT JOIN superUser ON superUser.id = program.supeerUserID
            LEFT JOIN user ON superUser.userid = user.id";
    $result = $conn->query($sql);
    ?>

<?php  
if ($isSuperuser) {
 
?>

<button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal">
  Add Program
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Programs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">Program name</label>
            <input type="text" class="form-control" id="programName" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter program name</small>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addProgramName()">Save changes</button>
      </div>
    </div>
  </div>
</div>



<?php

}
?>

 <!--//* program table -->
<div id="programTable">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>


<!--  //* edit program-->

<div class="modal fade" id="editProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Programs</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">Program name</label>
            <input type="text" class="form-control" id="editprogramName" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter program name</small>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="toEditprogram()">Save changes</button>
      </div>
    </div>
  </div>
</div>



<script>
    var programeditId; 

    var isSuperUser = <?php echo $isSuperuser; ?>;
    function programTableLoad() {
        var url = isSuperUser ? '../programs/acessprogram.php?admin=true' : '../programs/acessprogram.php';
        ajaxController({ docID: 'programTable', url: url });
    }

    programTableLoad();

    function onFunctiondone(data) {
        document.getElementById('programTable').innerHTML = `
        <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
        </div>`;
        console.log(data);
        programTableLoad();
    }


     function addProgramName() {
        var programdata =  document.getElementById('programName').value;
        var superUserID = <?php  echo $SuperuserID; ?>;
        var url = `../programs/addnewprogram.php?program=${programdata}&supeerUserID=${superUserID}`;
        ajaxController({url: url}, onFunctiondone);
    }



    function editprogram(id, programName) {
        console.log('edit program');
        console.log(programName);
        programeditId = id;
        document.getElementById('editprogramName').value = programName;
    }

    function toEditprogram() {
        var programdata =  document.getElementById('editprogramName').value;
        var superUserID = <?php  echo $SuperuserID; ?>;
        var url = `../programs/editprogram.php?program=${programdata}&supeerUserID=${superUserID}&programID=${programeditId}`;
        ajaxController({url: url}, onFunctiondone);
    }

    function onDelete(id) {
        var superUserID = <?php  echo $SuperuserID; ?>;
        var url = `../programs/deleteprogram.php?supeerUserID=${superUserID}&programID=${id}`;
        ajaxController({url: url}, onFunctiondone);
    }
   
</script>

<?php
}
?>