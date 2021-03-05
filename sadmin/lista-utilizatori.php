<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;
?>
<link href="css/pages/footable-page.css" rel="stylesheet">
<div id="adaugare" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Adăugare utilizator</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
             </div>
             <div class="modal-body">
				<form class="form-horizontal form-material" id="adauga" action="" method="POST">
					<input type="text" id="token" name="token" hidden value="<?php echo $_SESSION['token']; ?>"/>
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="text" placeholder="Username" id="username" name="username">
						</div>
					</div>
					
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="password" placeholder="Parola" id="parola" name="parola">
						</div>
					</div>
					
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="password" placeholder="Rescrie parola" id="parola2" name="parola2">
						</div>
					</div>
					
					<div class="form-group ">
						<div class="col-xs-12">
							<input class="form-control" type="text" placeholder="Email" id="email" name="email">
						</div>
					</div>
					<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Înapoi</button>
                <button type="submit" id="submit" name="submit" class="btn btn-info waves-effect waves-light">Adăugați</button>
            </div>
				</form>
			</div>
		</div>
    </div>
</div>

<div class="card">
	<div class="card-body">
		<h4 class="card-title">Listă utilizatori</h4>
        <h6 class="card-subtitle">Puteți adăuga, șterge sau edita orice utilizator</h6>
		<div class="table-responsive">
			<table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle responsive" data-page-size="10">
				<thead>
					<tr>
						<th data-toggle="true">ID</th>
						<th>Username</th>
						<th>Email</th>
						<th>Parola</th>
						<th>Status</th>
						<th class="min-width">Delete</th>
					</tr>
				</thead>
				<div class="m-t-40">
					<div class="d-flex">
						<div class="mr-auto">
							<div class="form-group">
								<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#adaugare"><i class="icon wb-plus" aria-hidden="true" ></i>Adăugați
								</button>
								<small>Puteți adăuga un nou membru.</small>
							</div>
						</div>
						<div class="ml-auto">
							<div class="form-group">
								<input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
				<tbody>
					<?php 
					$sql = mysqli_query($con, "SELECT * FROM `utilizatori` ORDER BY `id` DESC");
					$i=0;
					while($rand = mysqli_fetch_assoc($sql)){
						$i++;
						$idmod = 'sterge'. $i;
					?>
							<div id="<?php echo $idmod; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h4 class="modal-title">Șterge utilizator</h4>
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										 </div>
										 <div class="modal-body">
											<p style="font-size: 20px;">Sunteți sigur că vreți să stergeți utilizatorul <i style="color: #5DBCD2">'<?php echo $rand['username']; ?>'</i> ?</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Anulare</button>
											
											<a href="admin-lista-utilizatori-sterge&id=<?php echo $rand['id']; ?>"><button class="btn btn-danger">Șterge</button></a>
										</div>
									</div>
								</div>
							</div>
							<tr>
							<td><?php echo $rand['id']; ?></td>
							<td><?php echo $rand['username']; ?></td>
							<td><?php echo $rand['email']; ?></td>
							<td><?php echo cript($rand['parola']); ?></td>
							<td>
							<?php if($rand['activ']) {?>
								<span class="label label-table label-success">Activ</span>
							<?php } else {?>
								<span class="label label-table label-danger">Inactiv</span>
							<?php }?>
							</td>
							<td>
								<a class="btn btn-sm btn-icon btn-pure btn-outline" data-toggle="tooltip" data-original-title="Șterge"><i class="ti-close" aria-hidden="true" data-toggle="modal" data-target="#<?php echo $idmod; ?>"></i></a>
								<a href="admin-lista-utilizatori-editare&id=<?php echo $rand['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-outline" data-toggle="tooltip" data-original-title="Editează"><i class="fa fa-edit" aria-hidden="true"></i></a>
							</td>
						</tr>
						<?php
						}
						?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="text-right">
								<ul class="pagination"></ul>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
	
    <script src="assets/plugins/footable/js/footable.all.min.js"></script>
    <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="js/footable-init.js"></script>

	<script type="text/javascript">
$( document ).ready( function () {
	jQuery.validator.addMethod("special_chars", function(value, element) {
		 return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value );
	}, "<span style='color:#EF5350'>Ați introdus caractere interzise!</span>.");
		
	$( "#adauga" ).validate( {
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
			$("button").prop('disabled', true);
			$.ajax({
				type: "POST",
				url: "actiuni/inregistrare/creare.php",
				data: $("#adauga").serialize(),
				success: function() {
					$(document).keyup(function(e) {
						 if (e.keyCode == 27)
							window.location ='admin-lista-utilizatori';
					});
					$('#adaugare').modal('hide');
					swal({ 
						title: "Felicitări!", 
						text: "Contul a fost creat cu succes! Pagina va fi reîncărcată în câteva momente.", 
						type: "success",
						showConfirmButton: false
					});
					setTimeout(function() {
						location.reload();
					}, 2000);
				}
			  });
		}
	} );
} );
</script>