<?php
$records = getOneaAppointment();
extract($records);
$dDate = explode(" ", $date_debut);
$fDate = explode(" ", $date_fin);
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

<div class="col-md-8">

<link href="<?php echo WEB_ROOT; ?>dist/css/label.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

    <link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

    <link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

    <div class="box box-primary">



        <div class="box-header with-border">
            <h3 class="box-title"><b>Détailles du rendez-vous</b></h3>




        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=updateRdv&code_rdv=<?php echo $_GET['code_rdv']; ?>" method="post">
            <div class="box-body">

                <!-- pour choisir le etudiant -->
            
        <div class="form-group">
          <label for="exampleInputEmail1">statut du rensez-vous</label>
          <span id="sprytf_type">
            <select    name="status_rdv" class="form-control input-sm">
              <option class ="option-confirme" value="confirme" <?php if($status_rdv == "confirme"){echo 'selected="selected"';} ?>>confirmé</option>
              <option class ="option-non_confirme" value="non_confirme" <?php if($status_rdv == "confirme"){echo 'selected="selected"';} ?>>non confirmé</option>

              <option class ="option-r2" value="r2" <?php if($status_rdv == "r2"){echo 'selected="selected"';} ?>>R2</option>
              <option class ="option-r3" value="r3" <?php if($status_rdv == "r3"){echo 'selected="selected"';} ?>>R3</option>

              <option class ="option-r4" value="r4" <?php if($status_rdv == "r4"){echo 'selected="selected"';} ?>>R4</option>
              <option class ="option-vente" value="vente" <?php if($status_rdv == "confirme"){echo 'selected="selected"';} ?>>Vente</option>

              <option class ="option-pas_de_vente" value="pas_de_vente" <?php if($status_rdv == "confirme"){echo 'selected="selected"';} ?>>Pas de vente</option>
            
            </select>
          </span>

        </div>
                <!-- pour choisir le etudiant -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Nom du etudiant</label>
                    <div>
                        <input type="hidden" name="login_etudiant" value="<?php

                                                                            if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant')
                                                                                echo $_SESSION['calendar_fd_user']['login'];
                                                                            ?>" id="login_etudiant" />
                        <span id="sprytf_name">
                            <select name="login_etudiant" class="form-control input-sm">

                                <?php if ($_SESSION['calendar_fd_user']['fonction'] == 'etudiant') : ?>

                                    <option value="<?php echo $$_SESSION['calendar_fd_user']['login']; ?>">
                                        <?php echo $_SESSION['calendar_fd_user']['nom_user']; ?>
                                    </option>
                                <?php else : ?>
                                    <?php
                                    $sql = "SELECT login, nom_user FROM users  where fonction = 'etudiant'";
                                    $result = dbQuery($sql);
                                    while ($row = dbFetchAssoc($result)) {
                                        extract($row);
                                    ?>
                                        <option <?php if ($login_etudiant == $login) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?php echo $login; ?>"><?php echo $nom_user; ?></option>
                                    <?php
                                    }
                                    ?>
                                <?php endif; ?>
                            </select>
                            <span class="selectRequiredMsg">nom du etudiant est necessaire</span>

                        </span>
                    </div>

                


                    <!-- pour choisir la date de debut du rendez-vous -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>date de debut</label>
                                <span id="sprytf_rdate">
                                    <input value="<?php echo  $dDate[0]; ?>" type="text" name="date_debut" class="form-control" placeholder="YYYY-mm-dd">
                                    <span class="textfieldRequiredMsg">Date is required.</span>
                                    <span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
                                </span>
                            </div>
                            <div class="col-xs-6">
                                <label>l'houre de debut</label>
                                <span id="sprytf_rtime">
                                    <input value="<?php echo  $dDate[1]; ?>" type="text" name="houre_debut" class="form-control" placeholder="HH:mm">
                                    <span class="textfieldRequiredMsg">Time is required.</span>
                                    <span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
                                </span>
                            </div>
                        </div>
                    </div>


                    <!-- pour choisir la date de fin du rendez-vous -->

                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-6">
                                <label>date de fin</label>
                                <span id="sprytf_rdate">
                                    <input value="<?php echo  $fDate[0]; ?>" type="text" name="date_fin" class="form-control" placeholder="YYYY-mm-dd">
                                    <span class="textfieldRequiredMsg">Date is required.</span>
                                    <span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
                                </span>
                            </div>
                            <div class="col-xs-6">
                                <label>l'houre de fin</label>
                                <span id="sprytf_rtime">
                                    <input value="<?php echo  $fDate[1]; ?>" type="text" name="houre_fin" class="form-control" placeholder="HH:mm">
                                    <span class="textfieldRequiredMsg">Time is required.</span>
                                    <span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
                                </span>
                            </div>
                        </div>
                    </div>

                   


                    
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">enregestrer</button>
                    </div>
                </div>
                <!-- /.box -->
                <script type="text/javascript">
                    var sprytf_name = new Spry.Widget.ValidationTextField("sprytf_name", 'none', {
                        minChars: 6,
                        validateOn: ["blur", "change"]
                    });
                    var sprytf_address = new Spry.Widget.ValidationTextarea("sprytf_address", {
                        minChars: 10,
                        isRequired: true,
                        validateOn: ["blur", "change"]
                    });
                    var sprytf_phone = new Spry.Widget.ValidationTextField("sprytf_phone", 'none', {
                        validateOn: ["blur", "change"]
                    });
                    var sprytf_mail = new Spry.Widget.ValidationTextField("sprytf_email", 'email', {
                        validateOn: ["blur", "change"]
                    });

                    var sprytf_type = new Spry.Widget.ValidationSelect("sprytf_type");
                </script>
            </div>