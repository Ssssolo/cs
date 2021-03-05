<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

include ('core/database/connect.php');
$id = $_GET['id'];

if (isset($_GET['id'])){
	$token = time();
	if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
		$_SESSION['token'] = $token;
	
	$admin = $date_utilizator['username'];
	$sql = mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `id` = $id");
	if(mysqli_num_rows($sql)){
		$sql2 = mysqli_query($con, "SELECT * FROM `utilizatori` WHERE `id` = $id");
		while($rand = mysqli_fetch_assoc($sql2)){
			$username   = $rand['username'];
			$parola     = $rand['parola'];
			$email      = $rand['email'];
			$avertizari = $rand['avertizari'];
			$activ      = $rand['activ'];
			$acces      = $rand['acces'];
			$stare      = $rand['stare'];
			$credit     = $rand['credit'];
?>	
<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />

<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Editare profil <i>"<?php echo $rand['username']; ?>"</i></h3>
    </div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header bg-info">
				<h4 class="m-b-0 text-white">Informații principale</h4>
            </div>
            <div class="card-body">
				<form class="form-horizontal p-t-20" id="principal" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
					<input type="text" id="id" name="id" hidden value="<?php echo $id; ?>"/>
					<input type="text" id="admin" name="admin" hidden value="<?php echo $admin; ?>"/>
					<input type="text" id="username2" name="username2" hidden value="<?php echo $username; ?>"/>
					<input type="text" id="email2" name="email2" hidden value="<?php echo $email; ?>"/>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Username</label>
                        <div class="col-sm-9">
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>">
						</div>
                    </div>
					
                    <div class="form-group row">
						<label class="col-sm-3 control-label">Parola</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="parola" name="parola" placeholder="Parola" value="<?php echo $parola; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email" name="email" placeholder="Adresa de email" value="<?php echo $email; ?>">
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Avertizări</label>
                        <div class="col-sm-9">
							<div class="input-group">
								<input type="number" id="avertizari" name="avertizari" value="<?php echo $avertizari; ?>" name="avertizari" class=" form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
							</div>
                        </div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Activ</label>
						<div class="col-sm-9">
							<select class="selectpicker" data-style="form-control btn-secondary" id="activ" name="activ">
								<option <?php if($activ == 1) echo "selected "; ?> value="1">Activ</option>
								<option <?php if($activ == 0) echo "selected"; ?> value="0">Inactiv</option>
							</select>
						</div>
					</div>
				<script>
					$(document).ready( function() {
					  $('#acces_up').bind('change', function (e) {
						if( $('#acces_up').val() == '-1') {
						  $('#motiv').show();
						}
						else{
						  $('#motiv').hide();
						}
					  });

					});
					</script>
					<div class="form-group row">
						<label class="col-sm-3 control-label">Acces site</label>
						<div class="col-sm-9">
							<select class="selectpicker" data-style="form-control btn-secondary" id="acces_up" name="acces_up">
								<?php if($acces != -1){ ?>
									<option <?php if($acces == 1) echo "selected "; ?> value="1">Administrator</option>
									<option <?php if($acces == 2) echo "selected"; ?> value="2">Moderator</option>
									<option <?php if($acces == 0) echo "selected"; ?> value="0">Membru</option>
									<option value="-1">Banare</option>
								<?php } else { ?>
									<option <?php if($acces == -1) echo "selected"; ?> name="banned" id="banned" value="Banned">Banat</option>
								<?php if($acces == -1) { ?>
									<option name="debanare" id="debanare">Debanare</option>
								<?php } } ?>
							</select>
							<div id="motiv" style="display:none;">
							<br>
								<input type="text" class="form-control" id="motiv" name="motiv" placeholder="Motiv">
							</div>
						</div>
					</div>
					<div class="form-group row m-b-0">
						<div class="offset-sm-3 col-sm-9">
							<button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light">Salvați</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div> 
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header bg-info">
				<h4 class="m-b-0 text-white">Informații secundare</h4>
            </div>
            <div class="card-body">
				<form class="form-horizontal p-t-20" id="secundar" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
					<input type="text" id="id" name="id" hidden value="<?php echo $id; ?>"/>
					<input type="text" id="admin" name="admin" hidden value="<?php echo $admin; ?>"/>
					<input type="text" id="username" name="username" hidden value="<?php echo $username; ?>"/>
					<input type="text" id="stare2" name="stare2" hidden value="<?php echo $stare; ?>"/>
					<input type="text" id="credit2" name="credit2" hidden value="<?php echo $credit; ?>"/>
					
					<div class="form-group row">
						<label for="exampleInputuname3" class="col-sm-3 control-label">Stare</label>
						<div class="col-sm-9">
								<input type="text" class="form-control" id="stare" name="stare" placeholder="Stare utilizator" value="<?php echo $stare; ?>">
						</div>
					</div>
					<style>
					input[type=number]::-webkit-inner-spin-button, 
					input[type=number]::-webkit-outer-spin-button { 
					  -webkit-appearance: none; 
					  margin: 0; 
					}
					</style>
                    <div class="form-group row">
						<label class="col-sm-3 control-label">Credit</label>
                        <div class="col-sm-9">
							<div class="input-group">
								<input type="number" id="credit" name="credit" value="<?php echo $credit; ?>" name="credit" class=" form-control" data-bts-button-down-class="btn btn-secondary btn-outline" data-bts-button-up-class="btn btn-secondary btn-outline">
							</div>
                        </div>
					</div>
                    <div class="form-group row">
						<label for="inputPassword4" class="col-sm-3 control-label">Listă IP-uri</label>
                        <div class="col-sm-9">
							<div class="input-group">
								<blockquote>
									<?php
									$sql = mysqli_query($con, "SELECT `logIP` FROM `utilizatori` WHERE `id` = $id");
									while($rand = mysqli_fetch_array($sql)){
										$logIP = json_decode($rand['logIP'], true);
										array_unshift($logIP, $_SERVER['REMOTE_ADDR']);
										$logIP = array_unique($logIP);
										$logIP = array_slice($logIP, 0, 5);
										echo implode('<br>', $logIP);									
									}
									?>

								</blockquote>
							</div>
                        </div>
					</div>

					<div class="form-group row m-b-0">
						<div class="offset-sm-3 col-sm-9">
							<button type="submit" name="submit2" id="submit2" class="btn btn-success waves-effect waves-light">Salvați</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header bg-info">
				<h4 class="m-b-0 text-white">Informații server</h4>
            </div>
            <div class="card-body">
				<form class="form-horizontal p-t-20" id="server" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
					<input type="text" id="username" name="username" hidden value="<?php echo $username; ?>"/>
					<?php
					$us_sv = mysqli_fetch_assoc(mysqli_query($con, "SELECT `username` FROM `utilizatori` WHERE `id` = $id"));
					$sql   = mysqli_query($con, "SELECT `access` FROM `admins` WHERE `auth` = '". $us_sv['username'] ."'");
					$ac_sv = mysqli_fetch_assoc($sql);
					?>
					<input type="text" id="grad2" name="grad2" hidden value="<?php echo $ac_sv['access']; ?>"/>
					<input type="text" id="admin" name="admin" hidden value="<?php echo $admin; ?>"/>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Grad server</label>
						<div class="col-sm-9">
							<?php if($ac_sv['access'] == ''){ echo "<span style='color:#EF5350'>EROARE <b>#3N626J40</b></span>"; } else {?>
							<select class="selectpicker" data-style="form-control btn-secondary" id="grad" name="grad">
								<option <?php if($ac_sv['access'] == 'abcdefghijklmnopqrstu') echo "selected "; ?> value="abcdefghijklmnopqrstu">Owner</option>
								<option <?php if($ac_sv['access'] == 'bcdefghijmnoqrstu') echo "selected"; ?> value="bcdefghijmnoqrstu">God</option>
								<option <?php if($ac_sv['access'] == 'bcdefijmnopqrt') echo "selected"; ?> value="bcdefijmnopqrt">Super-Moderator</option>
								<option <?php if($ac_sv['access'] == 'bcdefijm') echo "selected"; ?> value="bcdefijm">Moderator</option>
								<option <?php if($ac_sv['access'] == 'bcdefim') echo "selected"; ?> value="bcdefim">Administrator</option>
								<option <?php if($ac_sv['access'] == 'cefim') echo "selected"; ?> value="cefim">Helper</option>
								<option <?php if($ac_sv['access'] == 'b') echo "selected"; ?> value="b">Slot</option>
							</select>
							<?php } ?>
						</div>
					</div>

					<div class="form-group row m-b-0">
						<div class="offset-sm-3 col-sm-9">
							<button type="submit" name="submit3" id="submit3" class="btn btn-success waves-effect waves-light">Salvați</button>
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>

<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>

<script type="text/javascript">
$( document ).ready( function () {
	$('#submit').click(function(){
		jQuery.validator.addMethod("special_chars", function(value, element) {
			 return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value );
		}, "<span style='color:#EF5350'>Ați introdus caractere interzise!</span>.");
		
		jQuery.validator.addMethod("email", function(value, element) {
			 return this.optional( element ) || /^([a-zA-Z0-9]+[a-zA-Z0-9._%-]*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,3})$/.test( value );
		}, "<span style='color:#EF5350'>Ați introdus caractere interzise!</span>.");
	
			
		$( "#principal" ).validate( {
			rules: {
				username: {
					required: true,
					minlength: 3,
					maxlength: 15,
					remote: {
						url: "sadmin/actiuni/profil/username.php",
						type: "POST",
						data: { token: $('#token').val(), username2: $('#username2').val() }
					},
					special_chars : true
				},
				parola: {
					required: true,
					minlength: 5
				},
				email: {
					required: true,
					email: true,
					remote: {
						url: "sadmin/actiuni/profil/email.php",
						type: "POST",
						data: { token: $('#token').val(), email2: $('#email2').val() }
					}
				},
				motiv: {
					required: true,
					minlength: 3,
					maxlength: 100
				}
			},
			messages: {
				username: {
					required  : "<span style='color:#EF5350'>Introduceți username-ul!</span>",
					minlength : "<span style='color:#EF5350'>Username-ul trebuie să conțină minim 3 caractere!</span>",
					maxlength : "<span style='color:#EF5350'>Username-ul trebuie să conțină maxim 15 caractere!</span>",
					remote    : "<span style='color:#EF5350'>Acest username există deja!</span>"
				},
				parola: {
					required  : "<span style='color:#EF5350'>Introduceți parola!</span>",
					minlength : "<span style='color:#EF5350'>Parola trebuie să conțină minim 5 caractere!</span>"
				},
				email: {
					required : "<span style='color:#EF5350'>Introduceți adresa de email!</span>",
					email    : "<span style='color:#EF5350'>Introduceți o adresă de email validă!</span>",
					remote   : "<span style='color:#EF5350'>Această adresă de email există deja!</span>"
				},
				telefon: {
					number   : "<span style='color:#EF5350'>Introduceți doar cifre!</span>",
					tel  : "<span style='color:#EF5350'>Introduceți un număr valid!</span>"
				},
				motiv: {
					required   : "<span style='color:#EF5350'>Introduceți un motiv!</span>",
					minlength   : "<span style='color:#EF5350'>Motivul este prea scurt!</span>",
					maxlength  : "<span style='color:#EF5350'>Motivul conține prea multe caractere!</span>"
				}
			}, 
			submitHandler: function () {
				if($('#username').val() == '<?php echo $username; ?>' && $('#parola').val() == '<?php echo $parola; ?>' && $('#email').val() == '<?php echo $email; ?>' && 
					$('#avertizari').val() == '<?php echo $avertizari; ?>' && $('#activ').val() == '<?php echo $activ; ?>' && $('#acces_up').val() == '<?php echo $acces; ?>'){
						swal({ 
							title: "Avertizare", 
							text: "Ne pare rău dar nu ați facut nicio modificare!", 
							type: "warning",
						});
				} else {
					$("button").prop('disabled', true);
					$.ajax({
						type: "POST",
						url: "sadmin/actiuni/profil/update.php?x2=<?php echo e_d('encrypt',$parola); ?>&x9=<?php echo e_d('encrypt',$activ); ?>&x4=<?php echo e_d('encrypt',$avertizari); ?>&x5=<?php echo e_d('encrypt',$acces); ?>",
						data: $("#principal").serialize(),
						success: function() {
							$(document).keyup(function(e) {
								 if (e.keyCode == 27) 
									location.reload();
							});
							
							$("input").prop('disabled', true);
							swal({ 
								title: "Felicitări!", 
								text: "Datele au fost actualizate cu succes! Pagina va fi reîncărcată în câteva momente.", 
								type: "success",
								showConfirmButton: false
							});
								
							setTimeout(function() {
								location.reload();
							}, 2000);
						}
					});
				}
			}
		});
	});
	
	$('#submit2').click(function(){
		jQuery.validator.addMethod("special_chars", function(value, element) {
			 return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value );
		}, "<span style='color:#EF5350'>Ați introdus caractere interzise!</span>.");
		
			
		$( "#secundar" ).validate( {
			rules: {
				stare: {
					maxlength: 15,
					special_chars : true
				},
				credit: {
					required: true,
					digits: true
				}
			},
			messages: {
				stare: {
					maxlength : "<span style='color:#EF5350'>Starea trebuie să conțină maxim 15 caractere!</span>"
				},
				credit: {
					required  : "<span style='color:#EF5350'>Introduceți creditul!</span>",
					digits    : "<span style='color:#EF5350'>Trebuie să introduceți numai cifre!</span>"
				}
			}, 
			submitHandler: function () {
				if($('#stare').val() == '<?php echo $stare; ?>' && $('#credit').val() == '<?php echo $credit; ?>'){;
					swal({ 
						title: "Avertizare", 
						text: "Ne pare rău dar nu ați facut nicio modificare!", 
						type: "warning",
					});
				} else {
					$("button").prop('disabled', true);
					$.ajax({
						type: "POST",
						url: "sadmin/actiuni/profil/update2.php",
						data: $("#secundar").serialize(),
						success: function() {
							$(document).keyup(function(e) {
								 if (e.keyCode == 27) 
									location.reload();
							});
							
							$("input").prop('disabled', true);
							$("button").prop('disabled', true);
							swal({ 
								title: "Felicitări!", 
								text: "Datele au fost actualizate cu succes! Pagina va fi reîncărcată în câteva momente.", 
								type: "success",
								showConfirmButton: false
							});
							
							setTimeout(function() {
								location.reload();
							}, 2000);
						}
					});
				}
			}
		});
	});
	
	$('#submit3').click(function(){
		$( "#server" ).validate( {
			submitHandler: function () {
				if($('#grad').val() == '<?php echo $ac_sv['access']; ?>'){;
					swal({ 
						title: "Avertizare", 
						text: "Ne pare rău dar nu ați facut nicio modificare!", 
						type: "warning",
					});
				} else {
					$("button").prop('disabled', true);
					$.ajax({
						type: "POST",
						url: "sadmin/actiuni/profil/update3.php",
						data: $("#server").serialize(),
						success: function() {
							$(document).keyup(function(e) {
								 if (e.keyCode == 27) 
									location.reload();
							});
							
							$("input").prop('disabled', true);
							$("button").prop('disabled', true);
							swal({ 
								title: "Felicitări!", 
								text: "Datele au fost actualizate cu succes! Pagina va fi reîncărcată în câteva momente.", 
								type: "success",
								showConfirmButton: false
							});
							
							setTimeout(function() {
								location.reload();
							}, 2000);
						}
					});
				}
			}
		});
	});
	
});



$("input[name='avertizari']").TouchSpin({
	min: 0,
    max: 4,
    prefix: '<i class="fa fa-warning"></i>'
});

$("input[name='credit']").TouchSpin({
	min: 0,
    max: 50,
    prefix: '€'
});
</script>
	
<?php
		}
	} else
		header("Location: admin-lista-utilizatori");
} else
	header("Location: admin-lista-utilizatori");
 
?>