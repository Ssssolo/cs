<?php
include('includes/head.php');
if(isset($_POST['submit'])){
	$username = curatare(strtolower($_POST['username']));
	$parola   = curatare($_POST['password']);
	
	if(empty($username) || empty($parola))
		$erori[] = 'Vă rugăm să completați toate câmpurile!';
	else {
		// Verificam daca utilizatorul exista in baza de date
		$sql = mysqli_query($con, "SELECT `username`, `parola` FROM `utilizatori` WHERE `username` = '". $username ."' AND `parola` = '". $parola ."'");	
		$exista = mysqli_num_rows($sql);
		// Daca acest cont exista, executam
		if($exista == 1){
			/* --------- Utilizatori online --------- */
			$session_id = session_id();
			$timp = time();
			$sql = mysqli_query($con, "SELECT `username` FROM `utilizatori_online` WHERE `username` = '$username'");
			
			// Verificam daca exista in `utilizatori_online` un utilizator cu acelasi username si afisam o eroare
			if(mysqli_num_rows($sql)){
				$erori[] = 'Ne pare rău dar altcineva este deja conectat pe acest cont, încercați din nou!';
			} else { // Altfel, daca nu este nimeni conectat, se efectueaza
				// Daca datele sunt corecte
				// Preluam din baza de date `id`
				$sql = mysqli_query($con, "SELECT `id` FROM `utilizatori` WHERE `username` = '". $username ."'");	
				$rand = mysqli_fetch_array($sql);
				//Preluare id
				$id = $rand['id'];

				
				/* --------- Utilizatori online --------- */
		
				mysqli_query($con, "INSERT INTO `utilizatori_online` (`id`, `username`, `session_id`, `timp`) VALUES ('$id', '$username', '$session_id', '$timp')
				  ON DUPLICATE KEY UPDATE `session_id` = '$session_id', `timp` = '$timp'");
				
				/* --------- Sfarsit utilizatori online --------- */
				
				// Creare sesiune cu id
				$_SESSION['id'] = $id;
				
				// Actualizare 'accesari site'
				mysqli_query($con, "UPDATE `general` SET `accesari` = `accesari` + 1");
				
				// Adaugam ip-ul utilizatorului in lista de ip-uri
				$sql = mysqli_query($con, "SELECT `logIP` FROM `utilizatori` WHERE `id` = $id");	
				while($rand = mysqli_fetch_array($sql)){
					$logIP = json_decode($rand['logIP'], true);
					array_unshift($logIP, $_SERVER['REMOTE_ADDR']);
					$logIP = array_unique($logIP);
					mysqli_query($con, "UPDATE `utilizatori` SET `logIP` = '". json_encode($logIP) ."' WHERE `id` = $id");
				}
				
				// Redirectionare catre index
				header('Location: ./');
			}
		} else
			if($exista == 0)
				$erori[] = 'Numele de utilizator sau parola sunt greșite!';
			else
				if($exista > 1)
					$erori[] = 'Vă rugăm să copiați codul erorii și contactați administratorul! #6V971X35';
	}	
}

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;
?>
    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(assets/images/background/login-register.jpg);">
        <div class="login-box card">
			<div class="card-body">
				<div class="card-body">
				<?php
				if(!empty($erori))
					echo afisare_erori($erori);
				?>
				<!-- Logare -->
                <form class="form-horizontal form-material" id="loginform" action="" method="POST">
                    <center><h1 style="font-family: Georgia, serif	;font-style: italic;">Solo</h1></center>
                   
				   <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required name="username" placeholder="Username" autocomplete="off">
                        </div>
                    </div>
					
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required name="password" placeholder="Password" autocomplete="off">
                        </div>
                    </div>
					
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit" name="submit">Log In</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            Nu aveți un cont? <a href="javascript:void(0)" id="to-register" class="text-primary m-l-5"><b>Înregistrează-te</b></a>
                        </div> 
						<div class="col-sm-12 text-center">
                            V-ați uitat parola? <a href="javascript:void(0)" id="to-recover" class="text-primary m-l-5"><b>Recuperați-o</b></a>
                        </div>
                    </div>
                </form>
				

     
				<!-- Inregistrare -->
				<form class="form-horizontal form-material" id="registerform" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
                    <h3 class="box-title m-t-40 m-b-0">Înregistrează-te!</h3><small>Creează-ți chiar acum un cont!</small>
					<div class="form-group m-t-20">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="Username" id="username" name="username">
						</div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="email" placeholder="Email" id="email" name="email">
						</div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password"  placeholder="Password" id="parola" name="parola" autocomplete="off">
						</div>
                    </div>
					
                    <div class="form-group" style="">
                        <div class="col-xs-12">
							<input class="form-control" type="password"  placeholder="Confirm Password" id="parola2" name="parola2" autocomplete="off">
						</div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit" id="submit">Înregistrare</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Aveți deja un cont? <a href="javascript:void(0)" id="to-login" class="text-info m-l-5"><b>Logați-vă!</b></a></p>
                        </div>
                    </div>
                </form>
				
				<!-- Recuperare -->
                <form class="form-horizontal" id="recoverform" action="" method="POST">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recuperați parola</h3>
                            <p class="text-muted">Introduceți adresa de email și vă vom trimite instrucțiunile de resetare.</p>
                        </div>
                    </div>
					
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
					
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="reset">Reset</button>
                        </div>
                    </div>
					
					<div class="form-group m-b-0"> 
						<div class="col-sm-12 text-center">
                           Înapoi la pagina de<a href="javascript:void(0)" id="to-login2" class="text-primary m-l-5"><b>logare</b></a>
                        </div>
                    </div>
                </form>
				
            </div>
        </div>
    </section>
		<script type="text/javascript">
		$( document ).ready( function () {
			jQuery.validator.addMethod("special_chars", function(value, element) {
				 return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value );
			}, "<span style='color:#EF5350'>Ați introdus caractere interzise!</span>.");
				
			$( "#registerform" ).validate( {
				rules: {
					username: {
						required: true,
						minlength: 3,
						maxlength: 15,
						remote: {
							url: "actiuni/inregistrare/username.php",
							type: "POST",
							data: { token: $('#token').val() }
						},
						special_chars : true
					},
					parola: {
						required: true,
						minlength: 5
					},
					parola2: {
						required: true,
						minlength: 5,
						equalTo: "#parola"
					},
					email: {
						required: true,
						email: true,
						remote: {
							url: "actiuni/inregistrare/email.php",
							type: "POST",
							data: { token: $('#token').val() }
						}
					}
				},
				messages: {
					username: {
						required  : "<span style='color:#EF5350'>Introduceți username-ul!</span>",
						minlength : "<span style='color:#EF5350'>Username-ul trebuie să conțină minim 3 caractere!</span>",
						maxlength : "<span style='color:#EF5350'>Username-ul trebuie să conțină maxim 15 caractere!</span>",
						remote    : "<span style='color:#EF5350'>Acest username există deja!</span>"
					},
					parola: {
						required  : "<span style='color:#EF5350'>Introduceți parola!</span>",
						minlength : "<span style='color:#EF5350'>Parola trebuie să conțină minim 5 caractere!</span>"
					},
					parola2: {
						required  : "<span style='color:#EF5350'>Introduceți parola!</span>",
						minlength : "<span style='color:#EF5350'>Parola trebuie să conțină minim 5 caractere!</span>",
						equalTo   : "<span style='color:#EF5350'>Parolele nu corespund!</span>"
					},
					email: {
						required : "<span style='color:#EF5350'>Introduceți adresa de email!</span>",
						email    : "<span style='color:#EF5350'>Introduceți o adresă de email validă!</span>",
						remote   : "<span style='color:#EF5350'>Această adresă de email există deja!</span>"
					}
				},
				submitHandler: function () {
					$.ajax({
						type: "POST",
						url: "actiuni/inregistrare/creare.php",
						data: $("#registerform").serialize(),
						success: function() {
							$(document).keyup(function(e) {
								 if (e.keyCode == 27)
									window.location ='index';
							});
							
							$("input").prop('disabled', true);
							$("button").prop('disabled', true);
							swal({ 
								title: "Felicitări!", 
								text: "Contul dvs. a fost creat cu succes! Verificați-vă email-ul (și în spam) pentru a vă activa contul. Veți fi redirecționat în câteva momente spre pagina de logare.", 
								type: "success",
								showConfirmButton: false
							});
							
							setTimeout(function() {
								location.reload();
							}, 8000);
						}
					});
				}
			});
		});
	</script>
	<!-- Sweet alert -->
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
    <link href="assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	<script src="js/animatii_index.js"></script>
	<script src="js/ie_disable.js"></script>


</body>


</html>