			</div>
				<footer class="footer"> © 2017 Stefan S.</footer>
			</div>
		</div>
		<?php if($date_utilizator['acces'] == 1 || $date_utilizator['acces'] == 2){ ?>
		<div>
			<button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
		<div class="right-sidebar">
			<div class="slimscrollright">
				<div class="rpanel-title"> Utilizatori online <span><i class="ti-close right-side-toggle"></i></span> </div>
				<div class="r-panel-body">
					<ul class="m-t-20 chatonline">
						<li><b>In ultimele 2 minute</b></li>
						<?php 
						$sql = mysqli_query($con, "SELECT * FROM `utilizatori_online`");
						while($rand = mysqli_fetch_assoc($sql)){
						?>
						<li>
							<a href="javascript:void(0)"><img src="assets/images/users/default.png" alt="user-img" class="img-circle"> <span><?php echo $rand['username']; ?> <small class="text-success">online</small></span></a>
                        </li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<?php 
		} 	
		if(!$date_utilizator['activ'] && !isset($_GET['x1'], $_GET['x2'])){ 
		?>
		<script type="text/javascript">
		$( document ).ready( function () {
			$(document).keydown(function(e) {
				if (e.keyCode == 27) 
					return false;
			 });
			swal({ 
				title: "AVERTIZARE!", 
				text: "Contul dvs. nu este activ. Pentru a-l activa, verificați-vă adresa de email!", 
				type: "warning",
				showConfirmButton: false
			});
		});
		</script>
		<?php
		}
		?>
		<!-- Bootstrap popper Core JavaScript -->
		<script src="assets/plugins/bootstrap/js/popper.min.js"></script>
		<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
		
		<!--Wave Effects -->
		<script src="js/waves.js"></script>
		
		<!--Menu sidebar -->
		<script src="js/sidebarmenu.js"></script>
		
		<!--Custom JavaScript -->
		<script src="js/custom.min.js"></script>
		<script src="js/ie_disable.js"></script>
		
		<!-- Sweet alert -->
		<script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
		<script src="assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
		<link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
		
		<!-- Footable -->
		<script src="assets/plugins/footable/js/footable.all.min.js"></script>
		<script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
		
		<!--FooTable init-->
		<script src="js/footable-init.js"></script>
		
	</body>
</html>