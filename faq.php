<?php
define('PERMIS', TRUE);
include ('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');
?>
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Întrebările cele mai frecvente</h4>
                <div id="accordion2" role="tablist" class="minimal-faq" aria-multiselectable="true">
					<div class="card m-b-0">
						<div class="card-header" role="tab" id="headingOne11">
							<h5 class="mb-0">
								<a class="link" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne11" aria-expanded="true" aria-controls="collapseOne11">
									Q1. De ce se șterg notificările ?
								</a>
                            </h5>
						</div>
                        <div id="collapseOne11" class="collapse show" role="tabpanel" aria-labelledby="headingOne11">
							<div class="card-body">
								Deoarece notificările, dupa o anumită perioadă de timp, ocupă un volum destul de mare de memorie, am decis ca acestea să se șteargă automat dupa un interval de 20 de zile.
                            </div>
						</div>
					</div>
					<div class="card m-b-0">
						<div class="card-header" role="tab" id="headingTwo22">
							<h5 class="mb-0">
								<a class="collapsed link" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo22" aria-expanded="false" aria-controls="collapseTwo22">
									Q2. Cineva este conectat pe contul meu?
								</a>
                            </h5>
						</div>
                        <div id="collapseTwo22" class="collapse" role="tabpanel" aria-labelledby="headingTwo22">
							<div class="card-body">
								<p>Aceasă eroare o să apară dacă:</p>
								<ul>
									<li>V-ați deconectat printr-o altă metodă (EX: ștergere cookie);</li>
									<li>Erați conectat pe o fila icognito și ați inchis-o fără a vă fi deconectat;</li>
								</ul>
								<p>Eroarea va fi afișată timp de două minute. Dacă constatați că altcineva era conectat pe contul dvs. schimbați-vă parola cât mai repede și contactați administratorul! (secțiunea <a href="adauga-tichet">"Tichete"</a>)</p>
								<span class="label label-danger">IMPORTANT!</span> Nu deschideți tichet dacă nu sunteți siguri că altcineva s-a conectat pe contul dvs.! Riscați sa fiți avertizat (4 avertizări = cont suspendat permanent)
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include('includes/footer.php');
?>