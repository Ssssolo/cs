<?php
define('PERMIS', TRUE);
include ('core/init.php');
protectie_nelogat();
include('includes/head.php');
include('includes/header.php');
include('includes/meniu.php');
?>
<link href="css/pages/pricing-page.css" rel="stylesheet">
  <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row pricing-plan">
                                    <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                        <div class="pricing-box">
                                            <div class="pricing-body b-l">
                                                <div class="pricing-header">
                                                    <h4 class="text-center">Silver</h4>
                                                    <h2 class="text-center"><span class="price-sign">$</span>3</h2>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-diamond"></i> Bonus <span class="label label-primary">20</span> puncte</div>
                                                    <div class="price-row"><i class="icon-user-following"></i> Membru V.I.P : <span class="label label-default">Nu</span></div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Numărul de avertizări pe care vi le puteți șterge"><i class="icon-close"></i> Avertizări : <span class="label label-default">0</span></div>
                                                    <div class="price-row">
                                                        <button class="btn btn-success waves-effect waves-light m-t-20">Cumpără</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                        <div class="pricing-box b-l">
                                            <div class="pricing-body">
                                                <div class="pricing-header">
                                                    <h4 class="text-center">Gold</h4>
                                                    <h2 class="text-center"><span class="price-sign">$</span>4</h2>
                                                </div>
                                                <div class="price-table-content">
                                                 <div class="price-row"><i class="icon-diamond"></i> Bonus <span class="label label-primary">25</span> puncte</div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Veți beneficia de câteva accese pe website"><i class="icon-user-following"></i> Membru V.I.P : <span class="label label-info">2 zile</span></div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Numărul de avertizări pe care vi le puteți șterge"><i class="icon-close"></i> Avertizări : <span class="label label-default">1</span></div>
                                                    <div class="price-row">
                                                        <button class="btn btn-success waves-effect waves-light m-t-20">Cumpără</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                        <div class="pricing-box featured-plan">
                                            <div class="pricing-body">
                                                <div class="pricing-header">
                                                    <h4 class="price-lable text-white bg-warning"> Popular</h4>
                                                    <h4 class="text-center">Platinum</h4>
                                                    <h2 class="text-center"><span class="price-sign">$</span>5</h2>
                                                </div>
                                                <div class="price-table-content">
                                                   <div class="price-row"><i class="icon-diamond"></i> Bonus <span class="label label-primary">35</span> puncte</div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Veți beneficia de câteva accese pe website"><i class="icon-user-following"></i> Membru V.I.P : <span class="label label-info">3 zile</span></div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Numărul de avertizări pe care vi le puteți șterge"><i class="icon-close"></i> Avertizări : <span class="label label-default">2</span></div>
                                                    <div class="price-row">
                                                        <button class="btn btn-lg btn-info waves-effect waves-light m-t-20">Cumpără</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 col-sm-6 no-padding">
                                        <div class="pricing-box">
                                            <div class="pricing-body b-r">
                                                <div class="pricing-header">
                                                    <h4 class="text-center">Diamond</h4>
                                                    <h2 class="text-center"><span class="price-sign">$</span>8</h2>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-diamond"></i> Bonus <span class="label label-primary">50</span> puncte</div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Veți beneficia de câteva accese pe website"><i class="icon-user-following"></i> Membru V.I.P : <span class="label label-info">5 zile</span></div>
                                                    <div class="price-row" data-toggle="tooltip" data-placement="bottom" title="Numărul de avertizări pe care vi le puteți șterge"><i class="icon-close"></i> Avertizări : <span class="label label-default">3</span></div>
                                                    <div class="price-row">
                                                        <button class="btn btn-success waves-effect waves-light m-t-20">Cumpără</button>
                                                    </div>
                                                </div>
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