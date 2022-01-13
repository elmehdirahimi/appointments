<link href="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script>

<link href="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo WEB_ROOT; ?>library/spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>

<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title"><b>nouveau rendez-vous</b></h3>
	</div>
	<?php if ($_SESSION['calendar_fd_user']['fonction'] == 'manager') { ?>
		<form role="form" action="<?php echo WEB_ROOT; ?>api/process.php?cmd=book" method="post">
			<div class="box-body">


				<!-- pour choisir la date de debut du rendez-vous -->

				<div class="form-group">
					<div class="row">
						<div class="col-xs-6">
							<label>date de debut</label>
							<span id="sprytf_rdate">
								<input type="text" name="date_debut" class="form-control" placeholder="YYYY-mm-dd">
								<span class="textfieldRequiredMsg">Date is required.</span>
								<span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
							</span>
						</div>
						<div class="col-xs-6">
							<label>l'houre de debut</label>
							<span id="sprytf_rtime">
								<input type="text" name="houre_debut" class="form-control" placeholder="HH:mm">
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
								<input type="text" name="date_fin" class="form-control" placeholder="YYYY-mm-dd">
								<span class="textfieldRequiredMsg">Date is required.</span>
								<span class="textfieldInvalidFormatMsg">Invalid date Format.</span>
							</span>
						</div>
						<div class="col-xs-6">
							<label>l'houre de fin</label>
							<span id="sprytf_rtime">
								<input type="text" name="houre_fin" class="form-control" placeholder="HH:mm">
								<span class="textfieldRequiredMsg">Time is required.</span>
								<span class="textfieldInvalidFormatMsg">Invalid time Format.</span>
							</span>
						</div>
					</div>
				</div>



				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
		</form>
	<?php } ?>
</div>
<!-- /.box -->
<script type="text/javascript">
	// var sprytf_name = new Spry.Widget.ValidationSelect("sprytf_name");
	var sprytf_rdate = new Spry.Widget.ValidationTextField("sprytf_rdate", "date", {
		format: "yyyy-mm-dd",
		useCharacterMasking: true,
		validateOn: ["blur", "change"]
	});
	var sprytf_rtime = new Spry.Widget.ValidationTextField("sprytf_rtime", "time", {
		hint: "i.e 20:10",
		useCharacterMasking: true,
		validateOn: ["blur", "change"]
	});
</script>