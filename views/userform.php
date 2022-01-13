<div class="col-md-8">

  <link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

  <link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

  <link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title"><b>nouvel utilisateur</b></h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" action="<?php echo WEB_ROOT; ?>views/process.php?cmd=create" method="post">
      <div class="box-body">
        <!-- nom-->
        <div class="form-group">
          <label for="exampleInputEmail1">nom</label>
          <span id="sprytf_name">
            <input type="text" name="nom_user" class="form-control input-sm" placeholder="rahimi">
            <span class="textfieldRequiredMsg">le nom est requis.</span>
          </span>
        </div>
        <!-- prenom-->
        <div class="form-group">
          <label for="exampleInputEmail1">prenom</label>
          <span id="sprytf_name">
            <input type="text" name="prenom_user" class="form-control input-sm" placeholder="el mehdi">
            <span class="textfieldRequiredMsg">le prenom est requis.</span>
          </span>
        </div>

        <!-- numero de telephone -->
        <div class="form-group">
          <label for="exampleInputEmail1">numero de telephone</label>
          <span id="sprytf_phone">
            <input type="text" name="tel" class="form-control input-sm" placeholder="Phone number">
            <span class="textfieldRequiredMsg">Le numéro de téléphone est requis.</span>
          </span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <span id="sprytf_email">
            <input type="text" name="login" class="form-control input-sm" placeholder="Enter email">
            <span class="textfieldRequiredMsg">Email ID is required.</span>
            <span class="textfieldInvalidFormatMsg">Please enter a valid email (user@telaction.com).</span>
          </span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">mot de passe</label>
          <span id="sprytf_name">
            <input type="password" name="password" class="form-control input-sm" placeholder="">
            <span class="textfieldRequiredMsg">le mot de passe est requis.</span>
          </span>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">User Type</label>
          <span id="sprytf_type">
            <select name="fonction" class="form-control input-sm">
              <option value=""> -- select user type --</option>
              <option value="manager">manager</option>
              <option value="etudiant">etudiant</option>
            </select>
            <span class="selectRequiredMsg">sélectionner la fonction.</span>
          </span>

        </div>


        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
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