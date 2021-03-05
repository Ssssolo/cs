<?php
define('PERMIS', TRUE);
include_once('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;
?>	
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Adăugare tichet</h3>
    </div>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-header bg-info">
				<h4 class="m-b-0 text-white">Informații principale</h4>
            </div>
            <div class="card-body">
				<form class="form-horizontal p-t-20" id="tichet" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Subiect</label>
                        <div class="col-sm-9">
							<input type="text" class="form-control" id="subiect" name="subiect" placeholder="Introduceti subiectul">
						</div>
                    </div>
					
                    <div class="form-group row">
						<label class="col-sm-3 control-label">Prioritate</label>
						<div class="col-sm-9">
							<select class="selectpicker" data-style="form-control btn-secondary" id="prioritate" name="prioritate">
								<option value="0">Selectare</option>
								<option value="1">Scazută</option>
								<option value="2">Medie</option>
								<option value="3">Urgentă</option>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Categorie</label>
						<div class="col-sm-9">
							<select class="selectpicker" data-style="form-control btn-secondary" id="categorie" name="categorie">
								<option value="0">Selectare</option>
								<?php if($date_utilizator['acces'] != -1){?>
								<option value="1">Bug's</option>
								<option value="2">Server</option>
								<option value="4">Plată</option>
								<option value="3">Website/cont</option>
								<option value="5">Altele</option>
								<?php } else { ?>
								<option value="3">Website/cont</option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-3 control-label">Descriere</label>
                        <div class="col-sm-9">
							<div class="input-group">
								<textarea class="form-control" rows="5" id="descriere" name="descriere"></textarea>
							</div>
                        </div>
					</div>
				
					<div class="form-group row m-b-0">
						<div class="offset-sm-3 col-sm-9">
							<button type="submit" id="submit" name="submit" class="btn btn-success waves-effect waves-light">Trimiteți</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<?php 
		$sql = mysqli_query($con, "SELECT `subiect`, `id` FROM `tichete` WHERE `username` = '". $date_utilizator['username'] ."' ORDER BY `id` DESC LIMIT 5");
		if(mysqli_num_rows($sql)){
		?>
		<div class="col-lg-12">	
			<div class="card">
				<div class="card-header bg-info">
					<h4 class="m-b-0 text-white">Tichete deschise</h4>
				</div>
				<div class="card-body">
		<?php
			while($rand = mysqli_fetch_assoc($sql)){
		?>
		
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0"> 
								<a href="tichet-<?php echo $rand['id']; ?>">							
									<i class="fa fa-angle-double-right"></i> 
									<?php
									echo $rand['subiect'];
									$sql2 = mysqli_query($con, "SELECT `vazut` FROM `tichete_raspuns` WHERE `id_tichet` = '". $rand['id'] ."' AND `vazut` = 0");
									$nr = mysqli_num_rows($sql2);
									if($nr)
										echo ' <span class="label label-rouded label-themecolor pull-right">'. $nr .'</span>';
									?>
								</a>
							</h5>		      	    
						</li>
					</ul>	
		<?php } ?>
				</div>
			</div>
		</div>		
		<?php } ?>
		<div class="col-lg-12">	
			<div class="card">
				<div class="card-header bg-info">
					<h4 class="m-b-0 text-white">Categorii</h4>
				</div>
				<div class="card-body">
					<style>
					ul {
						list-style-type: none;
					}
					</style>
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0">    			
								<i class="fa fa-angle-double-right"></i> 
								Bug's
								<span class="pull-right">
									( 
									<i class="fa fa-file-text-o"></i> 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `categorie` = '1'");
									echo mysqli_num_rows($sql);
									?>
									)
								</span>
							</h5>		      	    
						</li>
					</ul>
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0">    			
								<i class="fa fa-angle-double-right"></i> 
								Server
								<span class="pull-right">
									( 
									<i class="fa fa-file-text-o"></i> 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `categorie` = '2'");
									echo mysqli_num_rows($sql);
									?>
									)
								</span>
							</h5>		      	    
						</li>
					</ul>
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0">    			
								<i class="fa fa-angle-double-right"></i> 
								Website/cont
								<span class="pull-right">
									( 
									<i class="fa fa-file-text-o"></i> 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `categorie` = '3'");
									echo mysqli_num_rows($sql);
									?>
									)
								</span>
							</h5>		      	    
						</li>
					</ul>
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0">    			
								<i class="fa fa-angle-double-right"></i> 
								Plată
								<span class="pull-right">
									( 
									<i class="fa fa-file-text-o"></i> 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `categorie` = '4'");
									echo mysqli_num_rows($sql);
									?>
									)
								</span>
							</h5>		      	    
						</li>
					</ul>
					<ul class="kn-list ctg-list">  			      	    
						<li class=" p-10  ">
							<h5 class="m-0">    			
								<i class="fa fa-angle-double-right"></i> 
								Altele
								<span class="pull-right">
									( 
									<i class="fa fa-file-text-o"></i> 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `categorie` = '5'");
									echo mysqli_num_rows($sql);
									?>
									)
								</span>
							</h5>		      	    
						</li>
					</ul>	
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$( document ).ready( function () {
	$('#submit').click(function(){
		jQuery.validator.addMethod("selectare", function(value, element) {
			 return ($("#prioritate option:selected").text() == "Selectare") ? false : true
		}, "<span style='color:#EF5350'>Selectați prioritatea!</span>");
		
		jQuery.validator.addMethod("selectare2", function(value, element) {
			 return ($("#categorie option:selected").text() == "Selectare") ? false : true
		}, "<span style='color:#EF5350'>Selectați categoria!</span>");
		
		$( "#tichet" ).validate( {
			rules: {
				subiect: {
					required: true,
					minlength: 6,
					maxlength: 50
				},
				prioritate: {
					required: true,
					selectare: true
				},
				categorie: {
					required: true,
					selectare2: true
				},
				descriere: {
					required: true,
					minlength: 10,
					maxlength: 200
				}
			},
			messages: {
				subiect: {
					required  : "<span style='color:#EF5350'>Introduceți subiectul</span>",
					minlength : "<span style='color:#EF5350'>Subiectul trebuie să conțină minim 6 caractere!</span>",
					maxlength : "<span style='color:#EF5350'>Subiectul trebuie să conțină maxim 50 caractere!</span>"
				},
				prioritate: {
					required  : "<span style='color:#EF5350'>Selectați prioritatea!</span>"
				},
				categorie: {
					required  : "<span style='color:#EF5350'>Selectați categoria!</span>"
				},
				descriere: {
					required  : "<span style='color:#EF5350'>Introduceți descrierea!</span>",
					minlength : "<span style='color:#EF5350'>Trebuie să introduceți minim 6 caractere!</span>",
					maxlength : "<span style='color:#EF5350'>Trebuie să introduceți maxim 200 caractere!</span>"
				}
			},
			submitHandler: function () {
				$("button").prop('disabled', true);
				$.ajax({
					type: "POST",
					url: "actiuni/tichete/inserare.php?x5=<?php echo e_d('encrypt',$date_utilizator['username']); ?>",
					data: $("#tichet").serialize(),
					success: function() {
						$(document).keyup(function(e) {
							 if (e.keyCode == 27) 
								location.reload();
						});
								
						$("input").prop('disabled', true);
						swal({ 
							title: "Felicitări!", 
							text: "Tichetul a fost trimis cu succes! Pagina va fi reîncărcată în câteva momente.", 
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
});

</script>

<?php include('includes/footer.php'); ?>