<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;
?>
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h3 class="text-themecolor">Jocuri de noroc</h3>
    </div>
</div>

<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<h3>Slots 777</h3>
				<p>Presupun că acesta este printre cele mai cunoscute jocuri de noroc și nu mai este nevoie de o descriere aparte. Aceasta este o versiune simplificată dar care îți oferă aceleași senzații, have fun & good luck at credits 😎</p>
				<a href="jocuri-777">>> ACCESEAZĂ <<</a>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header bg-info">
						<h4 class="m-b-0 text-white">Informații jocuri</h4>
					</div>
					<div class="card-body">
					<style>
					
					</style>
						<table class="table">
							<tr>
								<th>Investiție totală</th>		
								<th>:</th>
								<th># X</th>
							</tr>
							<tr>
								<th>Câștig/pagubă</th>		
								<th>:</th>
								<th># X</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>