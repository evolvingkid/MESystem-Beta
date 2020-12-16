<?php
function programTable($conn, $isSuperuser = FALSE, $SuperuserID)
{ 
    $sql = "SELECT *,(superUser.id)superUserID FROM student LEFT JOIN program ON student.programid = program.id
            LEFT JOIN superUser ON superUser.id = program.supeerUserID
            LEFT JOIN user ON superUser.userid = user.id";
    $result = $conn->query($sql);
    ?>

<?php  
if ($isSuperuser) {
 
?>

<button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal">
  Add Students
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">Students name</label>
            <input type="text" class="form-control" id="name" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter students name</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Students RollNo</label>
            <input type="text" class="form-control" id="rollnumber" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter students Rollno</small>
        </div>
        <?php 
          $sql = "SELECT * FROM program";
          $result = $conn->query($sql);
        ?>
        <div class="form-group">
          <label for="my-select">Program</label>
          <select id="program" class="form-control" name="program">
          <?php 
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
              
              <option value="<?php echo $row['id'] ?>"> <?php echo $row['program name'] ?></option>
              <?php   }
       } else {
            echo "0 results";
          }
          
          ?>
           
          </select>
        </div>

        <?php 
          $sql = "SELECT * FROM course";
          $result = $conn->query($sql);
        ?>

        <div class="form-group">
          <label for="my-select">Course</label>
          <select id="course" class="form-control" name="course">
          <?php 
          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) { ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['course_name'] ?></option>
            <?php   }
       } else {
            echo "0 results";
          }
          
          ?>
          </select>
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

    var isSuperUser = false;
    var superUserID = null;

    <?php 
    
    if (isset($SuperuserID)) { ?>
      isSuperUser = true;
      superUserID = <?php echo $SuperuserID ;?>;
   <?php  }
    ?>
    

    
    function programTableLoad() {
        var url = isSuperUser ? '../students/acessTable.php?admin=true' : '../students/acessTable.php';
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
        var studentName =  document.getElementById('name').value;
        var studentRollNumner = document.getElementById('rollnumber').value;
        var program =  document.getElementById('program').value;
        var course =  document.getElementById('course').value;
      
        var url = `../students/create.php?studentname=${studentName}&supeerUserID=${superUserID}&rollno=${studentRollNumner}&programid=${program}&courseid=${course}`;
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
 
        var url = `../programs/editprogram.php?program=${programdata}&supeerUserID=${superUserID}&programID=${programeditId}`;
        ajaxController({url: url}, onFunctiondone);
    }

    function onDelete(id) {
 
        var url = `../programs/deleteprogram.php?supeerUserID=${superUserID}&programID=${id}`;
        ajaxController({url: url}, onFunctiondone);
    }
   
</script>

<?php
}
?>