<?php 

function examHall($conn, $isSuperuser = FALSE, $SuperuserID) {
    if ($isSuperuser) {
?>

    <button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal">
        Add Exam Hall
    </button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Exam Hall </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">ExamHall name</label>
            <input type="text" class="form-control" id="programName" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter Examhall</small>
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1"> Seats </label>
            <input type="text" class="form-control" id="totseat" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter Seat number</small>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addProgramName()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="editProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">ExamHall Name</label>
            <input type="text" class="form-control" id="examhalledit" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter hall name</small>
        </div>   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="toEditprogram()">Save changes</button>
      </div>
    </div>
  </div>
</div>


<?php 
    }
?>

     <!--//* course table -->
    <div id="examhalltable">
        <div class="spinner-border text-primary" role="status">
          <span class="sr-only">Loading...</span>
        </div>
    </div>


<script>
    var currentid; 
    var isSuperUser = false;
    var superUserID = null;

    <?php 
    
    if (isset($SuperuserID)) { ?>
      isSuperUser = true;
      superUserID = <?php echo $SuperuserID ;?>;
   <?php  }
    ?>

    function onFunctiondone(data) {
        document.getElementById('examhalltable').innerHTML = `
        <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
        </div>`;
        console.log(data);
        programTableLoad();
    }


    function programTableLoad() {
        var url = isSuperUser ? '../examhall/acessexamhall.php?admin=true' : '../programs/acessprogram.php';
        ajaxController({ docID: 'examhalltable', url: url });
    }

    programTableLoad();

    function addProgramName() {
        var programdata =  document.getElementById('programName').value;
        var tothall =  document.getElementById('totseat').value;
        var url = `../examhall/addexamhall.php?program=${programdata}&supeerUserID=${superUserID}&seat=${tothall}`;
        ajaxController({url: url}, onFunctiondone);
    }


    function editprogram(id) {
        programeditId = id;
        document.getElementById('examhalledit').value = id;
    }


    function onDelete(id) {
    var url = `../examhall/deleteexamhall.php?supeerUserID=${superUserID}&examhallID=${id}`;
    ajaxController({url: url}, onFunctiondone);
    }

</script>

<?php
}
?>