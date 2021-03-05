<?php
define('PERMIS', TRUE);
include_once('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');
?>
<div id="main-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="container">
				<div class="jumbotron" style="background: rgba(0,0,0,0.3);">
					<h1>Contul dvs. a fost supendat!</h1>
					<p>Ne pare rău dar contul dvs. a fost supendat, dacă aceasta a fost o greșeală vă rugăm să  <a href="adauga-tichet">contactați administratorul</a> !</p>
						<code>
						<?php
						if(empty($date_utilizator['motiv_banare']))
							echo 'EROARE! Contactați administratorul, cod eroare: #1L665Y48';
						else
							echo 'Motiv: '.$date_utilizator['motiv_banare']; 
						?>
						</code>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>