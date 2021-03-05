<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');
?>
<link href="css/pages/footable-page.css" rel="stylesheet">
<div class="card">
	<div class="card-body">
		<h4 class="card-title">Listă utilizatori online</h4>
        <h6 class="card-subtitle">Puteți deconecta orice utilizator (va dura câteva secunde până să il deconectăm).</h6>
		<div class="table-responsive">
			<table id="demo-foo-addrow2" class="table table-bordered table-hover toggle-circle responsive" data-page-size="10">
				<thead>
					<tr>
						<th data-toggle="true">ID</th>
						<th>Username</th>
						<th>ID sesiune</th>
						<th>Timp</th>
						<th class="min-width">Șterge sesiune</th>
					</tr>
				</thead>
				<div class="m-t-40">
					<div class="d-flex">
						<div class="ml-auto">
							<div class="form-group">
								<input id="demo-input-search2" type="text" placeholder="Search" autocomplete="off">
							</div>
						</div>
					</div>
				</div>
				<tbody>
					<?php 
					$sql = mysqli_query($con, "SELECT * FROM `utilizatori_online` ORDER BY `id` DESC");
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
											<p style="font-size: 20px;">Sunteți sigur că vreți să stergeți sesiunea utilizatorului <i style="color: #5DBCD2">'<?php echo $rand['username']; ?>'</i> ?</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Anulare</button>
											
											<a href="admin-utilizatori-online-sterge&id=<?php echo $rand['id']; ?>"><button class="btn btn-danger">Șterge</button></a>
										</div>
									</div>
								</div>
							</div>
							<tr>
							<td><?php echo $rand['id']; ?></td>
							<td><?php echo $rand['username']; ?></td>
							<td><?php echo $rand['session_id']; ?></td>
							<td><?php echo $rand['timp']; ?></td>
							<td>
								<button <?php if($rand['id'] == $date_utilizator['id']) echo 'disabled'; ?> class="btn btn-danger" data-toggle="modal" data-target="#<?php if($rand['id'] != $date_utilizator['id']) echo $idmod; ?>">Deconectare</button>
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