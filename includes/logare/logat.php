<?php
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');

if(isset($_GET['x1'], $_GET['x2']) && !empty($_GET['x2'])){
	$sql = mysqli_query($con, "SELECT `cod_activare` FROM `utilizatori` WHERE `username` = '". e_d('decrypt', $_GET['x1']) ."' AND `cod_activare` = '". $_GET['x2'] ."'");
	if(mysqli_num_rows($sql)){
?>
		<script type="text/javascript">
		$( document ).ready( function () {
			$(document).keydown(function(e) {
				if (e.keyCode == 27) 
					return false;
			 });
			swal({ 
				title: "CONT ACTIV!", 
				text: "Contul dvs. a fost activat cu succes! Pagina v-a fi reîncărcată în câteva momente", 
				type: "success",
				showConfirmButton: false
			});
			window.setTimeout(function() {
				window.location.href = './';
			}, 3500);
		});
		</script>
<?php
		mysqli_query($con, "UPDATE `utilizatori` SET `activ` = 1, `cod_activare` = '' WHERE `username` = '". e_d('decrypt', $_GET['x1']) ."'");
	} else {
?>
	<script type="text/javascript">
		$( document ).ready( function () {
			$(document).keydown(function(e) {
				if (e.keyCode == 27) 
					return false;
			 });
			swal({ 
				title: "EROARE!", 
				text: "Ne pare rău dar link-ul pe care l-ați accesat este greșit!", 
				type: "error",
				showConfirmButton: false
			});

		});
		</script>
<?php
	}
}
?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="stats">
                                        <h6 class="text-white">Număr utilizatori</h6>
                                        <h1 class="text-white">
											<?php
											echo numar_utilizatori();
											?>
										</h1>
                                    </div>
                                    <div class="stats-icon text-right ml-auto"><i class="fa fa-users display-5 op-3 text-dark"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="stats">
                                        <h6 class="text-white">Accesări website</h6>
                                        <h1 class="text-white">
										<?php
											echo numar_accesari();
										?>
										</h1>
                                    </div>
                                    <div class="stats-icon text-right ml-auto"><i class="fa fa-bounce fa-angle-double-up display-5 op-3 text-dark"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="stats">
                                        <h6 class="text-white">Tichete deschise</h6>
                                        <h1 class="text-white">
										<?php
											echo numar_tichete();
										?>
										</h1>
                                    </div>
                                    <div class="stats-icon text-right ml-auto"><i class="fa fa-spin fa-gear display-5 op-3 text-dark"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><span class="lstick"></span>Anunțuri</h4>
                            </div>
							<?php
							if(numar_anunturi()){
								$sql = mysqli_query($con, "SELECT * FROM `anunturi`");
								while($rand = mysqli_fetch_assoc($sql)){
							?>
                            <div class="comment-widgets">
                                <div class="d-flex flex-row comment-row">
									<div class="p-2"><img src="assets/images/news.png" width="60"></div>
                                    <div class="comment-text w-100">
                                        <h5 style="color: #337ABE"><?php echo $rand['titlu']; ?></h5>
                                        <p class="m-b-5"><?php echo $rand['text']; ?></p>
                                        <div class="comment-footer">
											<span class="text-muted pull-right"><?php echo date("d-m-Y , H:i", strtotime($rand['data'])); ?></span> 
											<span class="label label-rounded label-info"><?php echo $rand['username']; ?></span> 
											<?php if($date_utilizator['acces'] == 1){ ?>
											<span class="action-icons">
												<a href="javascript:void(0)"><i class="ti-pencil-alt"></i></a>
												<a href="javascript:void(0)"><i class="ti-check"></i></a>
												<a href="javascript:void(0)"><i class="ti-heart"></i></a>    	
											</span>
											<?php } ?>
										</div>
                                    </div>
								</div>
                            </div>
							<?php
								} 
							} else { 
							?>
							 <div class="activity-box">
                                <div class="card-body">
									<center>
										<div class="alert alert-danger alert-rounded"> 
											<i class="fa fa-exclamation-triangle"></i> Ne pare rău, dar momentan nu există niciun anunț!
										</div>
									</center>
								</div>
							</div>
							<?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h4 class="card-title"><span class="lstick"></span>Stări recent actualizate</h4>
                                </div>
                            </div>
                            <div class="activity-box">
                                <div class="card-body">
									<?php 
									$sql = mysqli_query($con,"SELECT `username`, `stare`, `data_actualizare` FROM `utilizatori` WHERE `stare` <> '' AND `data_actualizare` > '". date('Y-m-d H:i', strtotime('-2 day')) ."'");
									if(mysqli_num_rows($sql)){
										while($rand = mysqli_fetch_assoc($sql)){
									?>
										<div class="activity-item">
											<div class="round m-r-20"><img src="assets/images/users/default.png" width="50" /></div>
											<div class="m-t-10">
												<h5 class="m-b-0 font-medium">
													<?php 
													echo $rand['username'];
													?>
													<span class="text-muted font-14 m-l-10">
													
													| &nbsp; 
													<?php
														$azi              = new DateTime("now");
														$data_actualizare = new DateTime($rand['data_actualizare']);
														$interval 		  = $azi->diff($data_actualizare);
														$zile     		  = $interval->format('%a');															
														$ora_actualizare  = date('H:i', strtotime($rand['data_actualizare']));
														
														if($zile == 0)
															echo 'Astăzi, ora '. $ora_actualizare;
														elseif($zile == 1)
															echo 'Ieri, '. $ora_actualizare;
														?>
													</span>
												</h5>
												<blockquote> <?php echo $rand['stare']; ?> </blockquote>
											</div>
										</div>
									<?php
										}
									} else 
										echo '
										<center>
											<div class="alert alert-danger alert-rounded"> 
												<i class="fa fa-exclamation-triangle"></i> În ultimele 48 de ore nu s-a actualizat nicio stare!
											</div>
										</center>';
									?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
include('includes/footer.php');
?>