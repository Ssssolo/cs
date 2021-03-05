<?php
define('PERMIS', TRUE);
include ('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;
?>    
	<div id="main-wrapper">
		<div class="container-fluid">
			<div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="assets/images/users/default.png" class="img-circle" width="150" />
                                    <h4 class="card-title m-t-10"><?php echo $date_utilizator['username']; ?></h4>
                                    <h6 class="card-subtitle">
										<?php
										if(!empty($date_utilizator['stare']))
											echo '<i>'. $date_utilizator['stare'] .'</i>'; 
										else
											echo '<i>Nu ați actualizat starea!</i>'
										?>
									</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="" class="link"><font class="font-medium"><?php echo $date_utilizator['credit']; ?> <i class="fa fa-eur"></i></font></a></div>
                                        <div class="col-4"><a href="" class="link"><i class="fa fa-warning"></i> <font class="font-medium"><?php echo $date_utilizator['avertizari']; ?></font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> 
							</div>
                            <div class="card-body"> 
								<small class="text-muted">Adresa de email</small>
                                <h6><?php echo $date_utilizator['email']; ?></h6> 
								
								<small class="text-muted p-t-30 db">Grad pe server</small>
                                <h6><?php grad($date_utilizator['username']); ?></h6> 
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#acasa" role="tab">Activitate</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profil" role="tab">Profil</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#setari_cont" role="tab">Setări</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="acasa" role="tabpanel">
                                    <div class="card-body">
                                        <div class="profiletimeline">
											<?php 
											$sql = mysqli_query($con, "SELECT * FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' ORDER BY `id` DESC");
											while($rand = mysqli_fetch_assoc($sql)){
											?>
                                            <div class="sl-item">
                                                <div class="sl-left"> 
												<img src="assets/images/suport.png" class="img-circle" /> </div>
                                                <div class="sl-right">
                                                    <div>
														<a href="#" class="link"><?php echo $rand['titlu']; ?></a> 
														<span class="sl-date">
														<?php
														$sql2 = "SELECT * FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' AND `id` = '". $rand['id'] ."'";
														data($sql2);
														?>
														</span>
                                                        <p><?php echo $rand['text']; ?></p>
														<div class="pull-right">Cu respect,</div><br>
														<div class="pull-right"><a href="">Echipa - NUME -</a></div>
                                                      
                                                    </div>
                                                </div>
                                            </div> 
											<hr>
											<?php } ?>
											<div class="sl-item">
                                                <div class="sl-left"> 
												<img src="assets/images/suport.png" class="img-circle" /> </div>
                                                <div class="sl-right">
                                                    <div><a href="#" class="link">Echipa - NUME -</a> 
													<span class="sl-date">
													<?php
															$azi             = new DateTime("now");
															$data_notificare = new DateTime($date_utilizator['data_inregistrare']);
															$interval 		 = $azi->diff($data_notificare);
															$zile     		 = $interval->format('%a');															
															$ora_notificare  = date('H:i', strtotime($date_utilizator['data_inregistrare']));
															
															if($zile == 0)
																echo 'Astăzi, ora '. $ora_notificare;
															elseif($zile == 1)
																echo 'Ieri, ora '. $ora_notificare;
															elseif($zile == 2)
																echo 'Acum 2 zile';
															elseif($zile == 3)
																echo 'Acum 3 zile';
															elseif($zile == 4)
																echo 'Acum 4 zile';
															elseif($zile == 5)
																echo 'Acum 5 zile';
															elseif($zile == 6)
																echo 'Acum 6 zile';
															elseif($zile == 7)
																echo 'Acum 7 zile';
															elseif($zile > 7)
																echo 'Peste 7 zile';
															?>
														</span>
                                                        <p>Salut, <?php echo $date_utilizator['username']; ?>! Ne bucurăm ca te-ai alaturat comunității noastre și drept recompensă ai primit 0,5€! Dacă ai întrebări nu ezita să ne contactezi și îți vom răspunde în cel mai scurt timp!
														<div class="pull-right">Cu respect,</div><br>
														<div class="pull-right"><a href="">Echipa - SOIV -</a></div>
                                                      
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <hr> -->
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profil" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r">
												<strong>Nume utilizator</strong>
                                                <br>
                                                <p class="text-muted">
													<?php echo strtoupper($date_utilizator['username'][0]).substr($date_utilizator['username'], 1); ?>
												</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> 
												<strong>Grad pe server</strong>
                                                <br>
                                                <p class="text-muted"><?php grad($date_utilizator['username']); ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> 
												<strong>Email</strong>
                                                <br>
                                                <p class="text-muted"><?php echo $date_utilizator['email']; ?></p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Locație</strong>
                                                <br>
                                                <p class="text-muted"></p>
                                            </div>
                                        </div>
                                        <hr>
										<?php 
											if($date_utilizator['avertizari'] == 0)
												$nr = '0';
											elseif($date_utilizator['avertizari'] == 1)
												$nr = '25';
											elseif($date_utilizator['avertizari'] == 2)
												$nr = '50';
											elseif($date_utilizator['avertizari'] == 3)
												$nr = '75';
											elseif($date_utilizator['avertizari'] == 4)
												$nr = '100';
											else{
												$nr = '<span style="color:red">EROARE</span>';
												$eroare = 1;
											}
										?>
                                        <h5 class="m-t-30">Avertizări<span class="pull-right"><?php echo $nr;  if(!isset($eroare)) echo '%';?></span></h5>
                                        <div class="progress">
											<?php 
                                            if(!isset($eroare))
												echo '
													<div class="progress-bar bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:'.$nr.'%; height:6px;">
													</div>';
											else
												echo '
													<div class="progress-bar bg-danger" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;">
													</div>';
											?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="setari_cont" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material" id="setari" action="" method="POST">
                                            <input type="text" id="id" name="id" hidden value="<?php echo base64_encode($date_utilizator['id']); ?>"/>
											<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input class="form-control" type="password"  placeholder="Parolă nouă" id="parola" name="parola" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <input class="form-control" type="password"  placeholder="Repetare parolă nouă" style='display:none;' id="parola2" name="parola2" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line" id="stare" name="stare" placeholder="Stare actuală"><?php echo $date_utilizator['stare']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="submit" name="submit" id="submit" class="btn btn-success" value="Salvează" />
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
			</div>
		</div>
		<script type="text/javascript">
		$( document ).ready( function () {
			$('#parola').blur(function(){
				if($('#parola').val().length >= 5 ) {
					  $('#parola2').show();
				} else {
					 $('#parola2').hide();
				}
			});
		});

		$.validator.setDefaults({
			submitHandler: function () {
				 $.ajax({
					type: "POST",
					url: "actiuni/setari/actualizare.php",
					data: $("#setari").serialize(),
					success: function() {
						$(document).keyup(function(e) {
							 if (e.keyCode == 27)
								window.location ='profil';
						});
						
						if(($('#parola').val() == '' && $('#stare').val() == '') || 
							($('#parola').val() == '' && $('#stare').val() == '<?php echo $date_utilizator['stare']; ?>')){
							swal({ 
										title: "Avertizare", 
										text: "Ne pare rău dar nu ați facut nicio modificare!", 
										type: "warning",
									});		
						} else {
								$("input").prop('disabled', true);
								$("button").prop('disabled', true);
								swal({ 
									title: "Felicitări!", 
									text: "Setările dvs. au fost actualizate! Pagina va fi reîmprospătată în câteva momente", 
									type: "success",
									showConfirmButton: false
								});
						}
					}
				});
			}
		});
		
		$( document ).ready( function () {		
			$( "#setari" ).validate( {
				rules: {
					parola: {
						minlength: 5,
						remote: { 
							url: "actiuni/setari/parola.php", 
							type: "POST",
							data: { id: $('#id').val(), token: $('#token').val() }
						}
					},
					parola2: {
						required: true,
						minlength: 5,
						equalTo: "#parola"
					},
					stare: {
						minlength: 3,
						maxlength: 20
					}
				},
				messages: {
					parola: {
						minlength : "<span style='color:#EF5350'>Parola trebuie să conțină minim 5 caractere!</span>",
						remote    : "<span style='color:#EF5350'>Parola este aceeasi cu cea actuală!</span>"
					},
					parola2: {
						required  : "<span style='color:#EF5350'>Introduceți parola!</span>",
						minlength : "<span style='color:#EF5350'>Parola trebuie să conțină minim 5 caractere!</span>",
						equalTo   : "<span style='color:#EF5350'>Parolele nu corespund!</span>"
					},
					stare: {
						minlength : "<span style='color:#EF5350'>Starea dvs. trebuie să conțină minim 3 caractere!</span>",
						maxlength : "<span style='color:#EF5350'>Starea dvs. trebuie să conțină maxim 20 caractere!</span>"
					}
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
			} );
		} );
		</script>
<?php include('includes/footer.php'); ?>