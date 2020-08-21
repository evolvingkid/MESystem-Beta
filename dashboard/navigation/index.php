<?php 
// * main top navigation
function mainNavigation($name)
{?>
<div class="d-flex justify-content-between p-2 bg-white">
    <div class="p-2 text-primary d-flex ">
    <img src="../assets/Images/evolvingkid_logo.svg" alt="" srcset="" class="float-left" style="width: 40px;"> 
    <label class="mt-2 ml-2">MESystem</label>
    </div>
    <div class="p-2">
        <?php echo $name; ?>
        <!--bootstrap svg -->
        <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-person-circle ml-2" fill="currentColor"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z" />
            <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z" />
        </svg>
    </div>
</div>
<?php
}
?>