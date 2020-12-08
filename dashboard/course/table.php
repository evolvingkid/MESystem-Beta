<?php 

function courseTable($conn, $isSuperuser = FALSE, $SuperuserID)
{ 
    if ($isSuperuser) {

?>


<button type="button" class="btn btn-primary mb-2 float-right" data-toggle="modal" data-target="#exampleModal">
  Add Course
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
            <label for="exampleInputEmail1">Course Name</label>
            <input type="text" class="form-control" id="courseName" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter course name</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Course ID</label>
            <input type="text" class="form-control" id="courseid" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter Course ID</small>
        </div>

        <div class="form-group">
          <label for="my-select">Program</label>
          <?php
          $sql = "SELECT * FROM program";
          $result = $conn->query($sql);
          
          ?>
          <select id="programType" class="form-control" name="">
          <?php 
          
          if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
          ?>
            <option value="<?php echo $row['id']; ?>"> <?php echo $row['program name']; ?> </option>
            <?php 
            }
          }else{
            echo "Pls create programs";
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


<!-- //* edit -->

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
            <label for="exampleInputEmail1">Course Name</label>
            <input type="text" class="form-control" id="courseNameedit" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter course name</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Course ID</label>
            <input type="text" class="form-control" id="courseidedit" aria-describedby="programhelp">
            <small id="programhelp" class="form-text text-muted">Enter Course ID</small>
        </div>

        <div class="form-group">
          <label for="my-select">Program</label>
          <?php
          $sql = "SELECT * FROM program";
          $result = $conn->query($sql);
          
          ?>
          <select id="programTypeedit" class="form-control" name="">
          <?php 
          
          if ($result->num_rows > 0) { 
            while($row = $result->fetch_assoc()) {
          ?>
            <option value="<?php echo $row['id']; ?>"> <?php echo $row['program name']; ?> </option>
            <?php 
            }
          }else{
            echo "Pls create programs";
          }
            ?>
          </select>
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

    }?>


     <!--//* course table -->
<div id="coursetable">
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


  function programTableLoad() {
        var url = isSuperUser ? '../course/acesscourse.php?admin=true' : '../programs/acessprogram.php';
        ajaxController({ docID: 'coursetable', url: url });
  }

  programTableLoad();

  function onFunctiondone(data) {
        document.getElementById('coursetable').innerHTML = `
        <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
        </div>`;
        console.log(data);
        programTableLoad();
  }

  function addProgramName() {
        var coursedata =  document.getElementById('courseName').value;
        var courseid =  document.getElementById('courseid').value;
        var programid = document.getElementById('programType').value;
      
        var url = `../course/createCourse.php?course=${coursedata}&supeerUserID=${superUserID}&courseid=${courseid}&programid=${programid}`;
        ajaxController({url: url}, onFunctiondone);
  }


  function editprogram(id, courseName) {
        console.log('edit program');
        console.log(courseName);
        currentid = id;
        document.getElementById('courseidedit').value = id;
        document.getElementById('courseNameedit').value = courseName;
  }

    function toEditprogram() {
        var courseName =  document.getElementById('courseNameedit').value;
        var courseid =  document.getElementById('courseidedit').value;
        var programid = document.getElementById('programTypeedit').value;
        var url = `../course/editcourse.php?course=${courseName}&supeerUserID=${superUserID}&courseid=${courseid}&programid=${programid}&currentid=${currentid}`;
        ajaxController({url: url}, onFunctiondone);
    }


    function onDelete(id) {
    var url = `../course/deletecourse.php?supeerUserID=${superUserID}&courseID=${id}`;
    ajaxController({url: url}, onFunctiondone);
    }


</script>

 <?php
    }
?>