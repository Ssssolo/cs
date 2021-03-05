<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']) {
  die('direct access is forbidden');
}
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
					<h1>Oops, pagina nu a fost gasită!</h1>
					<p>Ne pare rău dar pagina pe care încercați să o accesați nu există! </p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>