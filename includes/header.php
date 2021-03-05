<?php
if(!defined('PERMIS'))
	die('Direct access not permitted');
?>		
			<header class="topbar">
				<nav class="navbar top-navbar navbar-expand-md navbar-light">
					<div class="navbar-header">
						<a class="navbar-brand" href="./">
							<!-- Logo icon --><b>
								<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
								<img src="assets/images/logo.png" alt="homepage" class="light-logo" />
							</b>
							<!--End Logo icon -->
							<span style="color:white; font-size: 100%; font-weight:bold;">SOLO	</span> 
						</a>
					</div>
					<div class="navbar-collapse">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
							<li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
							<li class="nav-item hidden-sm-down"><span></span></li>
						</ul>
						<ul class="navbar-nav my-lg-0">
							<?php if($date_utilizator['acces'] == 1){ ?>
							<li class="nav-item dropdown" id="notificari_admin">
								<a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
									<div class="notify"> 
										<?php
										$sql = mysqli_query($con, "SELECT `vazut` FROM `notificari` WHERE `vazut` = 0");
										$numar = mysqli_num_rows($sql);
										if($numar){
										?>
										<span class="heartbit"></span> 
										<span class="point"></span> 
										<?php }?>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
									<ul>
										<li>
											<div class="drop-title">Notificări administrator</div>
										</li>
										<li>
											<div class="message-center">
												<?php 
												$sql = mysqli_query($con, "SELECT * FROM `notificari` ORDER BY `id` DESC");
												if(mysqli_num_rows($sql)){
													$sql2 = mysqli_query($con, "SELECT * FROM `notificari` ORDER BY `id` DESC LIMIT 5");
													while($rand = mysqli_fetch_assoc($sql2)){
												?>
												<a href="admin-notificari">
													<div class="btn btn-<?php echo $rand['culoare']; ?> btn-circle"><i class="<?php echo $rand['imagine']; ?>"></i></div>
													<div class="mail-contnet">
														<h5>
															<?php
															if($rand['vazut'] == 0)
																 echo '<span class="label label-danger">NOU</span> ';
															
															echo $rand['titlu']; 
															?>
														</h5> 
														<span class="mail-desc"><?php echo $rand['text']; ?></span> 
														<span class="time pull-right">
															<?php
															$sql3 = "SELECT * FROM `notificari` WHERE `id` = '". $rand['id'] ."'";
															data($sql3);
															?>
														</span>
													</div>
												</a>
												<?php 
													} 
												} else
													echo '<br><center>Nu exista notificări!</center>';
												?>
											</div>
										</li>
										<li>
											<a class="nav-link text-center" href="admin-notificari"> <strong>Vezi toate notificările</strong> <i class="fa fa-angle-right"></i> </a>
										</li>
									</ul>
								</div>
							</li>
							<?php } ?>
							<li class="nav-item dropdown" id="notificari">
								<a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
									<div class="notify"> 
										<?php
										$sql = mysqli_query($con, "SELECT `vazut` FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' AND `vazut` = 0");
										$numar = mysqli_num_rows($sql);
										if($numar){
										?>
										<span class="heartbit"></span> 
										<span class="point"></span> 
										<?php }?>
									</div>
								</a>
								<div class="dropdown-menu mailbox dropdown-menu-right animated bounceInDown" aria-labelledby="2">
									<ul>
										<li>
											<div class="drop-title">Notificări</div>
										</li>
										
										<li>
											<div class="message-center">
												<?php 
												$sql = mysqli_query($con, "SELECT * FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' ORDER BY `id` DESC");
												if(mysqli_num_rows($sql)){
													$sql3 = mysqli_query($con, "SELECT * FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' ORDER BY `id` DESC LIMIT 5");
													while($rand = mysqli_fetch_assoc($sql3)){
												?>
												<a href="profil">
													<div class="btn btn-<?php echo $rand['culoare']; ?> btn-circle"><i class="<?php echo $rand['imagine']; ?>"></i></div>
													<div class="mail-contnet">
														<h5>
															<?php
															if($rand['vazut'] == 0)
																 echo '<span class="label label-danger">NOU</span> ';
															
															echo $rand['titlu']; 
															?>
														</h5> 
														<span class="mail-desc"><?php echo $rand['text']; ?></span> 
														<span class="time pull-right">
															<?php
															$sql = "SELECT * FROM `notificari_utilizator` WHERE `destinatar` = '". $date_utilizator['username'] ."' AND `id` = '". $rand['id'] ."'";
															data($sql);
															?>
														</span>
													</div>
												</a>
												<?php 
													} 
												} else
													echo '<br><center>Nu exista notificări!</center>';
												?>
											</div>
										</li>
										<li>
											<a class="nav-link text-center" href="javascript:void(0);"> <strong>Vezi toate notificările</strong> <i class="fa fa-angle-right"></i> </a>
										</li>
									</ul>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/default.png" alt="user" class="profile-pic" /></a>
								<div class="dropdown-menu dropdown-menu-right animated flipInY">
									<ul class="dropdown-user">
										<li>
											<div class="dw-user-box">
												<div class="u-img"><img src="assets/images/users/default.png" alt="user"></div>
												<div class="u-text">
													<h4><?php echo $date_utilizator['username']; ?></h4>
													<p class="text-muted"><?php echo $date_utilizator['email']; ?></p>
											</div>
										</li>
										<li role="separator" class="divider"></li>
										<li><a href="profil"><i class="ti-user"></i> Profil</a></li>
										<li><a href="#"><i class="fa fa-exchange"></i> Convertor credit</a></li>
										<li role="separator" class="divider"></li>
										<li><a href="logout"><i class="fa fa-power-off"></i> Logout</a></li>
									</ul>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</header>
			<script>
			var val,x;
			<?php
			if(!isset($token)){
				$token = md5(uniqid(rand(), TRUE));
			    $_SESSION['token'] = $token;
			}
			?>
			$(document).ready(function () {
				$("#notificari").click(function () {
					val = 1;
					x  = 0;
					get();
				});
				<?php if($date_utilizator['acces']){ ?>
				$("#notificari_admin").click(function () {
					val = 1;
					x   = 1;
					get();
				});
				<?php } ?>
			});
			
			function get(){
				if (val == 1){
					$.ajax({
					   type: "nedefinit",
					   url: "actiuni/general/u_n.php?x3="+x+"&x=<?php echo e_d('encrypt', $date_utilizator['username']); ?>"
					 });
				}
			}
			</script>
