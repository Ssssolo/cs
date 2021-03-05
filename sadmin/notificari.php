<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');
?>
<link href="css/pages/timeline-vertical-horizontal.css" rel="stylesheet">
<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 align-self-center">
                        <h3 class="text-themecolor">Notificari administrator</h3>
                    </div>
                </div>
<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="timeline">
								<?php
								$sql = mysqli_query($con, "SELECT * FROM `notificari` ORDER BY `id` DESC");
								if(mysqli_num_rows($sql)){
									while($rand = mysqli_fetch_assoc($sql)){
										if($rand['id']%2==0) {
								?>
                                    <li>
                                        <div class="timeline-badge <?php echo $rand['culoare']; ?>">
											<div class="btn btn-circle"><i class="<?php echo $rand['imagine']; ?>"></i></div>
										</div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><?php echo $rand['titlu']; ?></h4>
                                                <p>
													<small class="text-muted">
														<i class="fa fa-clock-o"></i> 
														<?php
															$sql2 = "SELECT * FROM `notificari` WHERE `id` = '". $rand['id'] ."'";
															data($sql2);
														?>
													</small>
												</p>
                                            </div>
                                            <div class="timeline-body">
                                                <p><?php echo $rand['text']; ?></p>
                                            </div>
                                        </div>
                                    </li>
								<?php } else { ?>
                                    <li class="timeline-inverted">
                                       <div class="timeline-badge <?php echo $rand['culoare']; ?>">
											<div class="btn btn-circle"><i class="<?php echo $rand['imagine']; ?>"></i></div>
										</div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title"><?php echo $rand['titlu']; ?></h4>
												<p>
													<small class="text-muted">
														<i class="fa fa-clock-o"></i> 
														<?php
															$sql2 = "SELECT * FROM `notificari` WHERE `id` = '". $rand['id'] ."'";
															data($sql2);
														?>
													</small>
												</p>
                                            </div>
                                            <div class="timeline-body">
                                                <p><?php echo $rand['text']; ?></p>
                                            </div>
                                        </div>
                                    </li>
								<?php 
										}
									}
								} else {
								?>
									<li>
                                        <div class="timeline-badge info">
											<div class="btn btn-circle"><i class="fa fa-info"></i></div>
										</div>
                                        <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h4 class="timeline-title">Notificări</h4>
                                                <p>
													<small class="text-muted">
														<i class="fa fa-clock-o"></i> 
														Chiar acum
													</small>
												</p>
                                            </div>
                                            <div class="timeline-body">
                                                <p>Ne pare rău dar nu există nicio notificare!</p>
                                            </div>
                                        </div>
                                    </li>
								<?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                </div>