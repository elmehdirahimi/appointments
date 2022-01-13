<?php
$records = getOneaAppointment();
extract($records);
$status_name = "vide";

if ($status_rdv == 'vide') {
    $status_name = "vide";
} else if ($status_rdv == 'reserver') {
    $status_name = "reserver";
} else if ($status_rdv == 'accepter') {
    $status_name = "accepter";
} else if ($status_rdv == 'annuler') {
    $status_name = "annuler";
}

?>
<link href="<?php echo WEB_ROOT; ?>dist/css/label.css" rel="stylesheet" type="text/css" />

<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>


<div class="col-md-9">
    <div class="box box-solid">
        <!-- /.box-header -->
        <div class="box-body">
            <dl class="dl-horizontal">

                <dt> statut du rendez-vous</dt>
                <dd><span class="label-<?php echo $status_rdv; ?>"><?php echo $status_name; ?></span></dd>


                <dt>Nom du etudiant</dt>
                <dd><?php

                    $sql = "SELECT  nom_user FROM users  where login = '$login_etudiant'";
                    $result = dbQuery($sql);
                    $row = dbFetchAssoc($result);
                    echo $row['nom_user'];
                    ?></dd>

                <dt>date </dt>
                <dd> de <?php echo  $date_debut; ?> a <?php echo  $date_fin; ?></dd>




            </dl>
            <div class="box-footer">

                <?php if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') : ?>
                    <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=rdvreserver&code_rdv=<?php echo $_GET['code_rdv']; ?>" method="post">
                        <button type="submit" class="btn btn-primary">reserver</button>
                    </form>
                <?php endif; ?>
                <?php if (
                    $_SESSION['calendar_fd_user']['fonction'] == 'manager'
                    && $login_etudiant
                ) : ?>
                    <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=rdvaccepter&code_rdv=<?php echo $_GET['code_rdv']; ?>" method="post">
                        <button type="submit" class="btn btn-primary">accepter</button>
                    </form>
                <?php endif; ?>
                <?php if (
                    $_SESSION['calendar_fd_user']['fonction'] == 'manager'
                    && $login_etudiant
                ) : ?>
                    <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=rdvannuler&code_rdv=<?php echo $_GET['code_rdv']; ?>" method="post">
                        <button type="submit" class="btn btn-primary">annuler</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->

</div>