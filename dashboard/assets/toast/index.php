<?php 
function showToastMsg($title, $message, $time) {
    ?>
<div style="position: absolute; right: 10px; top: 10px;">
    <!-- Position toasts -->
    <div style="position: absolute; top: 0; right: 0; width: 300px;">
        <div class="toast show" id="myToast" style="transition: 1s;">
            <div class="toast-header">
                <strong class="mr-auto"><i class="fa fa-grav"></i> <?php echo $title;  ?></strong>
                <small><?php echo $time; ?></small>

            </div>
            <div class="toast-body">
                <div> <?php echo $message; ?></div>
            </div>
        </div>
    </div>

</div>

<script>
    document.getElementById('myToast').className = 'toast show';
    setTimeout(function () {
    document.getElementById('myToast').style.opacity = 0;
}, 3000);
setTimeout(function () {
    document.getElementById('myToast').className = 'toast';
}, 5000);
</script>

<?php
}
?>