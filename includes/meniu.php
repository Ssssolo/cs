<?php
if(!defined('PERMIS'))
	die('Direct access not permitted');
?>
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap"> BINE AI REVENIT, <i><?php echo strtoupper($date_utilizator['username']); ?></i> !</li>
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
							<a class="waves-effect waves-dark" href="./">
								<i class="fa fa-home"></i>
								<span class="hide-menu">
									Acasă 
								</span>
							</a>
                        </li> 
						<li>
							<a class="waves-effect waves-dark" href="faq">
								<i class="fa fa-info-circle"></i>
								<span class="hide-menu">
									FAQ 
								</span>
							</a>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="adauga-tichet">
								<i class="fa fa-gear"></i>
								<span class="hide-menu">
									Adaugă tichet 
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete_raspuns`, `tichete` WHERE tichete.id = tichete_raspuns.id_tichet AND tichete_raspuns.vazut = 0 AND tichete.username = '". $date_utilizator['username'] ."'");
									$nr = mysqli_num_rows($sql);
									if($nr)
										echo '<span class="label label-rouded label-themecolor pull-right">'. $nr .'</span>';
									?>
								</span>
							</a>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="donare">
								<i class="fa fa-dollar"></i>
								<span class="hide-menu">
									Donează 
								</span>
							</a>
                        </li>
						<li>
							<a class="waves-effect waves-dark" href="jocuri-detalii">
								<i class="fa fa-gamepad"></i>
								<span class="hide-menu">
									Jocuri 
								</span>
							</a>
                        </li>
						<?php if($date_utilizator['acces'] == 1) {?>
						<li class="nav-small-cap">ADMIN CONTROL PANEL</li>
                        <li>
							<a class="waves-dark" href="admin-lista-utilizatori">
								<i class="fa fa-users"></i>
								<span class="hide-menu">
									Listă utilizatori
								</span>
							</a>
                        </li>
						<li>
							<a class="waves-dark" href="admin-utilizatori-online">
								<i class="fa fa-eye"></i>
								<span class="hide-menu">
									Utilizatori online
								</span>
							</a>
                        </li>
						<li>
							<a class=" waves-dark" href="admin-tichete">
								<i class="fa fa-gear"></i>
								<span class="hide-menu">
									Tichete
									<?php
									$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `stare` = 0");
									$nr = mysqli_num_rows($sql);
									if($nr)
										echo '<span class="label label-rouded label-themecolor pull-right">'. $nr .'</span>';
									?>
								</span>
							</a>
                        </li>
						<?php } ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
			<div class="container-fluid">
			<?php
			$session_id = session_id();
			$timp = time();
			// La fiecare 5 secunde actualizam timpul fiecarui utilizator
			?>
			<script>
			setInterval(function()
			{ 
				$.ajax({
				  type:"post",
				  url:"actiuni/update_timp.php?session_id=<?php echo $session_id?>",
				  datatype:"html",
				 success: function(data) {
					 if(data == 'sesiune'){
						 $(document).keydown(function(e) {
							if (e.keyCode == 27) 
								return false;
						 });
						swal({ 
							title: "ATENȚIE!", 
							text: "Ne pare rău dar ați fost deconectat ori din cauza inactivității ori de un administrator!", 
							type: "warning",
						}, function() {
							location.reload();
						});
					 }
				}
				});
			}, 5000)
			
			</script>