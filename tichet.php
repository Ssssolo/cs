<?php
define('PERMIS', TRUE);
include ('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');

$id = $_GET['id'];
//Verificam daca id-ul exista
$sql = mysqli_query($con, "SELECT `id` FROM `tichete` WHERE `id` = '$id'");
if(mysqli_num_rows($sql)){
	
	$sql2 = mysqli_query($con, "SELECT * FROM `tichete` WHERE `id` = '$id'");
	$rand = mysqli_fetch_assoc($sql2);
	if($date_utilizator['username'] == $rand['username'] || $date_utilizator['acces'] == 1){
		$token = time();
		if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
			$_SESSION['token'] = $token;
		
		if($date_utilizator['acces'] == 1)
			mysqli_query($con, "UPDATE `tichete_raspuns` SET `vazut_admin` = 1 WHERE `id_tichet` = '$id'");
		else
			mysqli_query($con, "UPDATE `tichete_raspuns` SET `vazut` = 1 WHERE `id_tichet` = '$id'");
			
		
		$sql5 = mysqli_query($con, "SELECT `username` FROM `tichete` WHERE `id` = '$id'");
		$rand5 = mysqli_fetch_assoc($sql5);
		if($date_utilizator['username'] == $rand5['username'])
			mysqli_query($con, "UPDATE `tichete_raspuns` SET `vazut` = 1 WHERE `username` = '". $rand5['username'] ."' AND `id_tichet` = '$id'");
		
		if($date_utilizator['acces'] == 1)
			mysqli_query($con, "UPDATE `tichete` SET `vazut` = 1 WHERE `username` = '". $rand5['username'] ."' AND `id` = '$id'");
?>
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Tichet #<i><?php echo base64_encode($rand['id']); ?></i></h3>
    </div>
</div>
    <script type="text/javascript">
    $(function() {
        $('.edit').editable({
			 validate: function(value) {
                if ($.trim(value) == '') return 'Vă rugăm să completați acest câmp!';
            },
            mode: 'inline'
        });
		$('#edit').editable({
			 validate: function(value) {
                if ($.trim(value) == '') return 'Vă rugăm să completați acest câmp!';
            },
            mode: 'inline'
        });
		$('#editare_subiect').editable({
			 validate: function(value) {
                if ($.trim(value) == '') return 'Vă rugăm să completați acest câmp!';
            },
            mode: 'inline'
        });
 
    });
    </script>
<div class="row">
	<div class="col-lg-8">
	
		<!-- TICHET PRINCIPAL -->
		<div class="card text-center">
			<div class="card-header">
			<?php if($date_utilizator['acces'] == 1) { ?>
						<a id="editare_subiect" data-type="text" data-pk="<?php echo $rand['id'] ?>" data-url="sadmin/actiuni/tichet/actualizare_tichet_subiect.php" ><?php echo htmlspecialchars($rand['subiect']); ?></a>
					<?php
						} else 
							echo htmlspecialchars($rand['subiect']);
					?>
			</div>
			<div class="card-body">
                <p class="card-text">
					<?php if($date_utilizator['acces'] == 1) { ?>
						<a id="edit" data-type="textarea" data-pk="<?php echo $rand['id']; ?>" data-url="sadmin/actiuni/tichet/actualizare_tichet_text.php" ><?php echo htmlspecialchars($rand['text']); ?></a>
					<?php
						} else 
							echo htmlspecialchars($rand['text']);
					?>
				</p>
                <p class="card-text" align="right">- <?php echo ucfirst(strtolower($rand['username'])); ?></p>
            </div>
            <div class="admin card-footer text-muted">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<?php 
						$sql = "SELECT `data` FROM `tichete` WHERE `id` = '$id'";
						data($sql);
						?>
					</div>
					<div class="col-md-2">
						<?php if($date_utilizator['acces'] == 1){ ?>
							<div class="meniu">
								<a href="sadmin/actiuni/tichet/sterge_tichet?x=<?php echo e_d('encrypt',$id); ?>"><i class="ti-trash"></i></a>    	
							</div>
						<?php } ?>
					</div>
				</div>
            </div>
		</div>
		<!-- SFARSIT TICHET PRINCIPAL -->
		
		<div class="row">
			<!-- RASPUNSURI TICHET-->
			<?php
			$sql3 = mysqli_query($con, "SELECT * FROM `tichete_raspuns` WHERE `id_tichet` = '$id'");
			while($rand2 = mysqli_fetch_assoc($sql3)){
			?>
            <div class="col-md-12">
				<div class="card text-center">
					<div class="card-header "><?php echo htmlspecialchars($rand['subiect']); ?></div>
					<div class="card-body">
						<?php if($date_utilizator['acces'] == 1) { ?>
						<a class="edit" data-type="text" data-pk="<?php echo $rand2['id'] ?>" data-url="sadmin/actiuni/tichet/actualizare_raspuns.php"><?php echo htmlspecialchars($rand2['text']); ?></a>
						<?php
						} else 
							echo htmlspecialchars($rand2['text']);
						if($rand2['admin'])
							echo '<p class="card-text" align="right">Cu respect,</p> <p class="card-text" align="right"> '. ucfirst(strtolower($rand2['username'])) .'</p>';
						else
							echo '<p class="card-text" align="right">- '. ucfirst(strtolower($rand2['username'])) .'</p>';
						?>
					</div>
					<div class="admin card-footer text-muted">					
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
							<?php

								$sql = "SELECT `data` FROM `tichete_raspuns` WHERE `text` = '". $rand2['text'] ."'";
								data($sql);

							?>
							</div>
							<div class="col-md-2">
								<?php if($date_utilizator['acces'] == 1){ ?>
								<div class="meniu">
									<a href="sadmin/actiuni/tichet/sterge_raspuns?x=<?php echo e_d('encrypt',$rand2['id']); ?>&x5=<?php echo e_d('encrypt',$rand['id']); ?>"><i class="ti-trash"></i></a>    	
								</div>
								<?php } ?>
							</div>
						</div>
					</div>	
				</div>
			</div>
			<?php 
				} 
			echo '<!-- SFARSIT RASPUNSURI TICHET-->';
			if($rand['stare'] == 1 || $rand['stare'] == 0){
			?>
			
			<!-- MODIFICARE UN RASPUNS-->
			<div class="col-md-12">
				<div class="card text-center">
					<div class="card-header"><?php echo htmlspecialchars($rand['subiect']); ?></div>
					<div class="card-body">
						<form class="form-horizontal p-t-20" id="tichet" action="" method="POST">
							<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>							
						
							<div class="form-group row m-b-0">
								<div class=" col-sm-12">
									<div class="form-group row">
										<label class="col-sm-3 control-label">Răspuns <?php if($date_utilizator['acces'] == 1) echo '(administrator)'; ?></label>
										<div class="col-sm-9">
											<div class="input-group">
												<textarea class="form-control" rows="5" id="raspuns" name="raspuns"></textarea>
											</div>
										</div>
									</div>
									<button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light">Trimiteți</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- SFARSIT MODIFICARE UN RASPUNS-->
			<?php } ?>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="row">
			<?php if($date_utilizator['acces'] == 1) { ?>
			<!-- MODIFICARE STARE TICHET-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header bg-info">
						<h4 class="m-b-0 text-white">Opțiuni administrator</h4>
					</div>
					<div class="card-body">
					<form class="form-horizontal p-t-20" id="admin" action="" method="POST">
						<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
						
						<div class="form-group row">
							<label class="col-sm-3 control-label">Stare</label>
							<div class="col-sm-9">
								<select class="selectpicker" data-style="form-control btn-secondary" id="stare" name="stare">
									<option value="0">Selectare</option>
									<?php
									if($rand['stare'] == 0 || $rand['stare'] == 1){
									?>
									<option value="2">Rezolvat</option>
									<option value="3">Închis</option>
									<?php } else { ?>
									<option value="0">Deschis</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="form-group row m-b-0">
							<div class="offset-sm-3 col-sm-9">
								<button type="submit" id="submit2" name="submit2" class="btn btn-success waves-effect waves-light">Trimiteți</button>
							</div>
						</div>
					</form>
					</div>
				</div>
			</div>
			<!-- SFARSIT MODIFICARE STARE TICHET-->
			<?php } ?>
			
			<!-- DETALII TICHET-->
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header bg-info">
						<h4 class="m-b-0 text-white">Informații tichet</h4>
					</div>
					<div class="card-body">
					<style>
					tr {
						border-bottom: 1px dotted #5B5B5B;
					}
					</style>
						<table class="table">
							<tr>
								<th>ID tichet</th>		
								<th>:</th>
								<th>#<?php echo base64_encode($rand['id']); ?></th>
							</tr>
							<tr>
								<th>Username</th>
								<th>:</th>
								<th><?php echo $rand['username']; ?></th>
							</tr>
							<tr>
								<th>Prioritate</th>
								<th>:</th>
								<th>
									<?php
									if($rand['prioritate'] == 3)
										echo '<span class="text- label label-danger"> Urgent</span>';
									else
										if($rand['prioritate'] == 2)
											echo '<span class="text- label label-warning"> Mediu</span>';
									else
										if($rand['prioritate'] == 1)
											echo '<span class="text- label label-info"> Scăzut</span>';
									else
										if($rand['prioritate'] == 0)
											echo '<span class="text- label label-danger">EROARE</span>';
									?>
								</th>
							</tr>
							<tr>
								<th>Categorie</th>
								<th>:</th>
								<th>
									<?php
									if($rand['categorie'] == 5)
										echo 'Altele';
									else
										if($rand['categorie'] == 4)
											echo 'Plată';
									else
										if($rand['categorie'] == 3)
											echo 'Website/cont';
									else
										if($rand['categorie'] == 2)
											echo 'Server';
									else
										if($rand['categorie'] == 1)
											echo 'Bug\'s';
									else
										if($rand['categorie'] == 0)
											echo '<span class="text- label label-danger">EROARE</span>';
									?>
								</th>
							</tr>
							<tr>
								<th>Data</th>
								<th>:</th>
								<th><?php echo date("d-m-Y", strtotime($rand['data'])). ', ora '. date("H:i", strtotime($rand['data'])); ?></th>
							</tr>
							<tr>
								<th>Stare</th>
								<th>:</th>
								<th>
									<?php
									$sql = mysqli_query($con, "SELECT `id` FROM `tichete_raspuns` WHERE `id_tichet` = '$id' LIMIT 2");
									if(mysqli_num_rows($sql)){
										if($rand['stare'] == 0 || $rand['stare'] == 1)
											echo '<span class="text-warning text-bold"><i class="fa fa-dot-circle-o"></i> Cu răspuns</span>';
										else
											if($rand['stare'] == 2)
												echo '<span class="text-success text-bold"><i class="fa fa-dot-circle-o"></i> Rezolvat</span>';
										else
											if($rand['stare'] == 3)
												echo '<span class="text-danger text-bold"><i class="fa fa-dot-circle-o"></i> Închis</span>';
										else
												echo '<span class="text- label label-danger">EROARE (#4N388V40)</span>';
										} else {
											if($rand['stare'] == 0)
												echo '<span class="text-info text-bold"><i class="fa fa-dot-circle-o"></i> În așteptare</span>';
											else
												if($rand['stare'] == 1)
													echo '<span class="text-warning text-bold"><i class="fa fa-dot-circle-o"></i> Cu răspuns</span>';
											else
												if($rand['stare'] == 2)
													echo '<span class="text-success text-bold"><i class="fa fa-dot-circle-o"></i> Rezolvat</span>';
											else
												if($rand['stare'] == 3)
													echo '<span class="text-danger text-bold"><i class="fa fa-dot-circle-o"></i> Închis</span>';
											else
												echo '<span class="text- label label-danger">EROARE (#4N388V40)</span>';
										}
										?>
								</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<!-- SFARSIT DETALII TICHET-->
			
		</div>
	</div>
	
</div>
<script type="text/javascript">
$( document ).ready( function () {
	$('#submit').on("click", function (){
		$( "#tichet" ).validate( {
			rules: {
				raspuns: {
					required: true,
					minlength: 6,
					maxlength: 200
				}
			},
			messages: {
				raspuns: {
					required  : "<span style='color:#EF5350'>Introduceți răspunsul</span>",
					minlength : "<span style='color:#EF5350'>Răspunsul trebuie să conțină minim 6 caractere!</span>",
					maxlength : "<span style='color:#EF5350'>Răspunsul trebuie să conțină maxim 200 caractere!</span>"
				}
			},
			submitHandler: function () {
				$("button").prop('disabled', true);
				$.ajax({
					type: "POST",
					url: "actiuni/tichete/inserare_raspuns.php?x7=<?php echo e_d('encrypt',$date_utilizator['username']); ?>&x5=<?php echo e_d('encrypt',$id); ?>",
					data: $("#tichet").serialize(),
					success: function() {
						$(document).keyup(function(e) {
							 if (e.keyCode == 27) 
								location.reload();
						});
								
						
						$("input").prop('disabled', true);
						swal({ 
							title: "Felicitări!", 
							text: "Mesajul a fost trimis cu succes! Pagina va fi reîncărcată în câteva momente.", 
							type: "success",
							showConfirmButton: false
						});
						setTimeout(function() {
							location.reload();
						}, 2000);
					}
				});
			}
		});
	});
	<?php if($date_utilizator['acces'] == 1) { ?>
	$('#submit2').click(function(){
		jQuery.validator.addMethod("selectare", function(value, element) {
			 return ($("#stare option:selected").text() == "Selectare") ? false : true
		}, "<span style='color:#EF5350'>Selectați starea!</span>");
		$( "#admin" ).validate( {
			rules: {
				stare: {
					selectare: true
				}
			},
			submitHandler: function () {
				$.ajax({
					type: "POST",
					url: "actiuni/tichete/update.php?x2=<?php echo e_d('encrypt',$id); ?>&x1=<?php echo e_d('encrypt',$date_utilizator['username']); ?>&x6=<?php echo e_d('encrypt',$rand['stare']); ?>",
					data: $("#admin").serialize(),
					success: function() {
						$(document).keyup(function(e) {
							 if (e.keyCode == 27) 
								location.reload();
						});
								
						$("input").prop('disabled', true);
						$("button").prop('disabled', true);
						swal({ 
							title: "Felicitări!", 
							text: "Mesajul a fost trimis cu succes! Pagina va fi reîncărcată în câteva momente.", 
							type: "success",
							showConfirmButton: false
						});
									
						setTimeout(function() {
							location.reload();
						}, 2000);
					}
				});
			}
		});
	});
	
	
	<?php } ?>
});

</script>
<?php
	} else
		header('Location: ./');
} else
	header('Location: ./');
include('includes/footer.php');
?>