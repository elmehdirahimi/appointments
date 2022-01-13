<?php
$records = getUsersRecords();
?>

<div class="col-md-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">list des utilisateurs</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-bordered">
        <tr>
          <th>nom</th>
          <th>prenom</th>
          <th>Email</th>
          <th>telephone</th>
          <th>fonction</th>
          <th>Action</th>
        </tr>
        <?php
        foreach ($records as $rec) {
          extract($rec);
          $stat = '';
        ?>
          <tr>
            <td><?php echo strtoupper($nom_user) ?></td>
            <td><?php echo  $prenom_user; ?></td>
            <td><?php echo $login; ?></td>
            <td><?php echo $tel; ?></td>
            <td><?php echo $fonction; ?></td>
            <td>
              <a href="javascript:updateUser('<?php echo $login ?>');">modifier</a>&nbsp;/
              &nbsp;<a href="javascript:deleteUser('<?php echo $login ?>');">suprimer</a>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <button type="button" class="btn btn-info" onclick="javascript:createUserForm();"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Creer un nouvel utilisateur</button>
      <?php echo generatePagination(); ?> </div>
  </div>
  <!-- /.box -->
</div>

<script language="javascript">
  function createUserForm() {
    window.location.href = '<?php echo WEB_ROOT; ?>views/?v=CREATE';
  }

  function updateUser(login) {
    window.location.href = '<?php echo WEB_ROOT; ?>views/?v=UPDATEUSER&login=' + login;
  }

  function deleteUser(login) {
    //  if (confirm('Etes-vous sûr de  suprimer ' + $login))

    window.location.href = '<?php echo WEB_ROOT; ?>views/process.php?cmd=deleteUser&login=' + login;
  }
</script>