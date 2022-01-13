<div class="col-md-8">
  <?php include('calendar.php'); ?>
</div>
<?php if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') { ?>
  <div class="col-md-4">
    <?php include('rendez_vous_form.php'); ?>
  </div>
<?php } ?>