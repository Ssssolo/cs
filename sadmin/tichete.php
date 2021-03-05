<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');
?>
<link href="css/pages/contact-app-page.css" rel="stylesheet">
		<link href="css/pages/footable-page.css" rel="stylesheet">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Listă tichete deschise</h4>
                                <h6 class="card-subtitle">Listă cu tichetele deschise de utilizatori</h6>
                                <div class="row m-t-40">
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box bg-info text-center">
                                                <h1 class="font-light text-white">
												<?php
												$sql = mysqli_query($con, "SELECT * FROM `tichete`");
												echo mysqli_num_rows($sql);
												?>
												</h1>
                                                <h6 class="text-white">Tichete totale</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box bg-primary text-center">
                                                <h1 class="font-light text-white">
												<?php
												$sql = mysqli_query($con, "SELECT * FROM `tichete`, `tichete_raspuns` WHERE tichete.id = tichete_raspuns.id_tichet");
												echo mysqli_num_rows($sql);
												?>
												</h1>
                                                <h6 class="text-white">Tichete cu răspuns</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box bg-success text-center">
                                                <h1 class="font-light text-white">
												<?php
												$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `stare` = 2");
												echo mysqli_num_rows($sql);
												?>
												</h1>
                                                <h6 class="text-white">Tichete rezolvate</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-3 col-xlg-3">
                                        <div class="card">
                                            <div class="box bg-dark text-center">
                                                <h1 class="font-light text-white">
												<?php
												$sql = mysqli_query($con, "SELECT * FROM `tichete` WHERE `stare` = 0");
												echo mysqli_num_rows($sql);
												?>
												</h1>
                                                <h6 class="text-white">Tichete în așteptare</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
                                <div class="table-responsive">
                                    <table id="demo-foo-addrow" class="table m-t-30 table-hover no-wrap contact-list" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>#ID</th>
                                                <th>Username</th>
                                                <th>Subiect</th>
                                                <th>CEVA</th>
                                                <th>Prioritate</th>
                                                <th>Stare</th>
                                                <th>Categorie</th>
                                                <th>Dată</th>
                                                <th>Acțiune</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$sql = mysqli_query($con, "SELECT * FROM `tichete`");
											$i = 0;
												while($rand = mysqli_fetch_assoc($sql)){
													$i++;
													$idmod = 'sterge'. $i;
											?>
											<div id="<?php echo $idmod; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Șterge tichet</h4>
															<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														 </div>
														 <div class="modal-body">
															<p style="font-size: 20px;">Sunteți sigur că vreți să stergeți tichetul cu ID-ul <i style="color: #5DBCD2">'<?php echo $rand['id']; ?>'</i> ?</p>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Anulare</button>
															
															<a href="admin-tichete-sterge&id=<?php echo $rand['id']; ?>"><button class="btn btn-danger">Șterge</button></a>
														</div>
													</div>
												</div>
											</div>
                                            <tr>
                                                <td><?php echo $rand['id']; ?></td>
                                                <td><?php echo $rand['username']; ?></td>
                                                <td><?php echo $rand['subiect']; ?></td>
                                                <td>
												<?php
												if($rand['stare'] == 0)
													echo '<span class="text- label label-danger">NOU</span>';
												else
													echo '<span class="text- label label-success">Văzut</span>';
												?>
												</td>
												<td>
												<?php
												if($rand['prioritate'] == 3)
													echo '<span class="text- label label-danger"> Urgent</span>';
												else
													if($rand['prioritate'] == 2)
														echo '<span class="text- label label-warning"> Mediu</span>';
												else
													if($rand['prioritate'] == 1)
														echo '<span class="text- label label-info"> Scăzut</span>';
												else
													if($rand['prioritate'] == 0)
														echo '<span class="text- label label-danger">EROARE</span>';
												?>
												</td>
												<td>
													<?php
													$sql2 = mysqli_query($con, "SELECT `id` FROM `tichete_raspuns` WHERE `id_tichet` = '". $rand['id'] ."' LIMIT 2");
													if(mysqli_num_rows($sql2)){
															if($rand['stare'] == 1)
																echo '<span class="text-warning text-bold"><i class="fa fa-dot-circle-o"></i> Cu răspuns</span>';
														else
															if($rand['stare'] == 2)
																echo '<span class="text-success text-bold"><i class="fa fa-dot-circle-o"></i> Rezolvat</span>';
														else
															if($rand['stare'] == 3)
																echo '<span class="text-danger text-bold"><i class="fa fa-dot-circle-o"></i> Închis</span>';
														else
																echo '<span class="text- label label-danger">EROARE (#4N388V40)</span>';
													} else {
														if($rand['stare'] == 0)
															echo '<span class="text-info text-bold"><i class="fa fa-dot-circle-o"></i> În așteptare</span>';
														else
															if($rand['stare'] == 1)
																echo '<span class="text-warning text-bold"><i class="fa fa-dot-circle-o"></i> Cu răspuns</span>';
														else
															if($rand['stare'] == 2)
																echo '<span class="text-success text-bold"><i class="fa fa-dot-circle-o"></i> Rezolvat</span>';
														else
															if($rand['stare'] == 3)
																echo '<span class="text-danger text-bold"><i class="fa fa-dot-circle-o"></i> Închis</span>';
														else
																echo '<span class="text- label label-danger">EROARE (#4N388V40)</span>';
													}
													?>
												</td>
                                                <td>
													<?php
													if($rand['categorie'] == 5)
														echo 'Altele';
													else
														if($rand['categorie'] == 4)
															echo 'Plată';
													else
														if($rand['categorie'] == 3)
															echo 'Website/cont';
													else
														if($rand['categorie'] == 2)
															echo 'Server';
													else
														if($rand['categorie'] == 1)
															echo 'Bug\'s';
													else
														if($rand['categorie'] == 0)
															echo '<span class="text- label label-danger">EROARE</span>';
													?>
												</td>
                                                <td><?php echo date("d-m-Y", strtotime($rand['data'])); ?></td>
                                                <td>
													<a class="btn btn-sm btn-icon btn-pure btn-outline" data-toggle="tooltip" data-original-title="Șterge"><i class="ti-close" aria-hidden="true" data-toggle="modal" data-target="#<?php echo $idmod; ?>"></i></a>
													<a href="tichet-<?php echo $rand['id']; ?>" class="btn btn-sm btn-icon btn-pure btn-outline" data-toggle="tooltip" data-original-title="Editează"><i class="fa fa-edit" aria-hidden="true"></i></a>
											   </td>
                                            </tr>
											<?php } ?>
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
                    </div>
                </div>