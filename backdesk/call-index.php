<?php
//include 'cores/comm-head.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard</title>
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- simplebar CSS-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="assets/css/app-style.css" rel="stylesheet"/>
    
  </head>
  <body>
    <!-- Start wrapper-->
    <div id="wrapper">
      
      <?php include 'cores/menu.php' ?>
      <div class="clearfix"></div>
      
      <div class="content-wrapper">
        <div class="container-fluid">
          <!--Start Dashboard Content-->
          <div class="row mt-3 d-flex justify-content-center">
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-bloody">
                <div class="card-body">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="text-white">Total Orders</p>
                      <?php
                      $query1 = "SELECT * FROM tbl_order_hdr  ";
                      $func1 = check($query1);
                      ?>
                      <h4 class="text-white line-height-5"><?=number_format($func1['count'])?></h4>
                    </div>
                    <div class="w-circle-icon rounded-circle border border-white">
                    <i class="fa fa-cart-plus text-white"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-blooker">
                <div class="card-body">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="text-white">Today Orders</p>
                      <?php
                      $query1 = "SELECT * FROM tbl_order_hdr  ";
                      $func1 = check($query1);
                      ?>
                      <h4 class="text-white line-height-5"><?=number_format($func1['count'])?></h4>
                    </div>
                    <div class="w-circle-icon rounded-circle border border-white">
                    <i class="fa fa-cart-plus text-white"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-scooter">
                <div class="card-body">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="text-white">Total Revenue</p>
                      <?php
                      $query2 = "SELECT SUM(customer_paid_amt) AS pay_amnt FROM tbl_order_amt_master";
                      $func2 = single_data($query2);
                      ?>
                      <h4 class="text-white line-height-5">&#x20b9;<?=number_format($func2['all_data']['pay_amnt'],2)?></h4>
                    </div>
                    <div class="w-circle-icon rounded-circle border border-white">
                    <i class="fa fa-money text-white"></i></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 col-xl-3">
              <div class="card gradient-ohhappiness">
                <div class="card-body">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <p class="text-white">Today Revenue</p>
                      <?php
                      $query3 = "SELECT SUM(vendor_amt) AS pay_amnt FROM tbl_order_hdr ";
                      $func3 = single_data($query3);
                      ?>
                      <h4 class="text-white line-height-5">&#x20b9;<?=number_format($func3['all_data']['pay_amnt'],2)?></h4>
                    </div>
                    <div class="w-circle-icon rounded-circle border border-white">
                    <i class="fa fa-money text-white"></i></div>
                  </div>
                </div>
              </div>
            </div>

            </div><!--End Row-->
            <!-- <div class="row d-flex justify-content-center">
              <div class="col-md-12 col-lg-8">
                <div class="card">
                  <div class="card-header">
                    Last 7 Days Report
                    <div class="card-action">
                      <div class="dropdown">
                        <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">
                          <i class="icon-options"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="javascript:void();">Action</a>
                          <a class="dropdown-item" href="javascript:void();">Another action</a>
                          <a class="dropdown-item" href="javascript:void();">Something else here</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="javascript:void();">Separated link</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <canvas id="dashboard-chart-1"></canvas>
                  </div>
                </div>
              </div>
            </div> -->
            <!--End Row-->
            <div class="row d-flex justify-content-center">
              <div class="col-12 col-lg-8">
                <div class="card">
                  <div class="card-header border-0">
                    New Vendor Registration
                    <!--<div class="card-action">-->
                    <!--  <div class="dropdown">-->
                    <!--    <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">-->
                    <!--      <i class="icon-options"></i>-->
                    <!--    </a>-->
                    <!--    <div class="dropdown-menu dropdown-menu-right">-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Action</a>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Another action</a>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Something else here</a>-->
                    <!--      <div class="dropdown-divider"></div>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Separated link</a>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Company</th>
                          <th>Mobile</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                        $v_q = "SELECT * FROM vendors JOIN vendor_kyc ON vendors.id = vendor_kyc.vendor_id
                        JOIN users ON users.vendor_id = vendors.id
                        WHERE users.status = 2
                        LIMIT 0,10
                        ";
                        $v_q_f = all_data($v_q);
                        if ($v_q_f['data']==true) {
                        foreach($v_q_f['all_data'] as $vq_k => $vq_v){
                        ?>
                        <tr>
                          <td><?=++$vq_k?></td>
                          <td><?=$vq_v['company_name']?></td>
                          <td><?=$vq_v['contact']?></td>
                          <td><?=$vq_v['email']?></td>
                          <td><a href="new-vendor-check.php?vid=<?=$vq_v['vendor_id']?>" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a></td>
                        </tr>
                        <?php } }else{ ?>
                        <tr>
                          <td colspan="5">No data found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div><!--End Row-->

            <div class="row d-flex justify-content-center">
              <div class="col-12 col-lg-8">
                <div class="card">
                  <div class="card-header border-0">
                    New Customer List
                    <!--<div class="card-action">-->
                    <!--  <div class="dropdown">-->
                    <!--    <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">-->
                    <!--      <i class="icon-options"></i>-->
                    <!--    </a>-->
                    <!--    <div class="dropdown-menu dropdown-menu-right">-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Action</a>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Another action</a>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Something else here</a>-->
                    <!--      <div class="dropdown-divider"></div>-->
                    <!--      <a class="dropdown-item" href="javascript:void();">Separated link</a>-->
                    <!--    </div>-->
                    <!--  </div>-->
                    <!--</div>-->
                  </div>
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead>
                        <tr>
                          <th>Sl. No.</th>
                          <th>Name</th>
                          <th>Mobile</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tr>
                        <td>1</td>
                        <td>Sayub Ali</td>
                        <td>105</td>
                        <td>105@gmail.com</td>
                      </tr>
                      <tbody>
                        <?php
                        $query3 = "SELECT * FROM tbl_order_hdr
                        JOIN users ON tbl_order_hdr.user_id = users.id
                        GROUP BY tbl_order_hdr.user_id
                        ORDER BY tbl_order_hdr.order_hdr_id DESC
                        LIMIT 0,10
                        ";
                        $func3 = all_data($query3);
                        if ($func3['data']==true) {
                        foreach($func3['all_data'] as $key => $cl){
                        ?>
                        <tr>
                          <td><?=++$key?></td>
                          <td><?=$cl['f_name'] . ' '.$cl['l_name']?></td>
                          <td><?=$cl['contact']?></td>
                          <td><?=$cl['email']?></td>
                        </tr>
                        <?php } }else{ ?>
                        <tr>
                          <td colspan="4">No data found</td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div><!--End Row-->
              <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-header border-0">
                      Recent Orders Table
                      <!--<div class="card-action">-->
                      <!--  <div class="dropdown">-->
                      <!--    <a href="javascript:void();" class="dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown">-->
                      <!--      <i class="icon-options"></i>-->
                      <!--    </a>-->
                      <!--    <div class="dropdown-menu dropdown-menu-right">-->
                      <!--      <a class="dropdown-item" href="javascript:void();">Action</a>-->
                      <!--      <a class="dropdown-item" href="javascript:void();">Another action</a>-->
                      <!--      <a class="dropdown-item" href="javascript:void();">Something else here</a>-->
                      <!--      <div class="dropdown-divider"></div>-->
                      <!--      <a class="dropdown-item" href="javascript:void();">Separated link</a>-->
                      <!--    </div>-->
                      <!--  </div>-->
                      <!--</div>-->
                    </div>
                    <div class="table-responsive">
                      
                      <table class="table align-items-center table-flush">
                        <thead>
                          <tr>
                            <th>SL. No</th>
                            <th>ORDER ID</th>
                            <th>AMT.</th>
                            <th>Order Placed</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $query4 = "SELECT * FROM tbl_order_hdr
                          JOIN users ON tbl_order_hdr.user_id = users.id
                          ORDER BY tbl_order_hdr.order_hdr_id DESC
                          LIMIT 0,10";
                          $func4 = all_data($query4);
                          if ($func4['data']==true) {
                          foreach($func4['all_data'] as $key4 => $od){
                          ?>
                          <tr>
                            <td><?=++$key4?></td>
                            <td><?=$od['order_id']?></td>
                            <td><?=$od['vendor_amt']?></td>
                            <td><?=$od['added_on']?></td>
                            <?php } }else{ ?>
                            <tr>
                              <td colspan="4">No data found</td>
                            </tr>
                            <?php } ?>
                          </tbody>
                          
                        </table>
                      </div>
                    </div>
                  </div>
                  </div><!--End Row-->
                  <!--End Dashboard Content-->
                </div>
                <!-- End container-fluid-->
                
                </div><!--End content-wrapper-->
                <?php include 'cores/footer.php' ?>
                
                </div><!--End wrapper-->
                <!-- Bootstrap core JavaScript-->
                <script src="assets/js/jquery.min.js"></script>
                <script src="assets/js/popper.min.js"></script>
                <script src="assets/js/bootstrap.min.js"></script>
                
                <!-- simplebar js -->
                <script src="assets/plugins/simplebar/js/simplebar.js"></script>
                <!-- waves effect js -->
                <script src="assets/js/waves.js"></script>
                <!-- sidebar-menu js -->
                <script src="assets/js/sidebar-menu.js"></script>
                <!-- Custom scripts -->
                <script src="assets/js/app-script.js"></script>
                <!-- Chart js -->
                <script src="assets/plugins/Chart.js/Chart.min.js"></script>
                <!--Peity Chart -->
                <script src="assets/plugins/peity/jquery.peity.min.js"></script>
                <!-- Index js -->
                <!-- <script src="assets/js/index.js"></script> -->
                <script type="text/javascript">
                $(function() {
                "use strict";
                // chart 1
                var ctx = document.getElementById("dashboard-chart-1").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: [1, 2, 3, 4, 5, 6, 7],
                datasets: [
                {
                label: 'Orders',
                data: [40, 30, 60, 35, 60, 25, 50, 40],
                borderColor: '#11cdef',
                backgroundColor: '#11cdef',
                hoverBackgroundColor: '#11cdef',
                pointRadius: 0,
                fill: false,
                borderWidth: 1
                },
                {
                label: 'Pending',
                data: [50, 60, 40, 70, 35, 75, 30, 20],
                borderColor: '#e8e8e8',
                backgroundColor: '#e8e8e8',
                hoverBackgroundColor: '#e8e8e8',
                pointRadius: 0,
                fill: false,
                borderWidth: 1
                }
                ]
                },
                options:{
                legend: {
                position: 'bottom',
                display: true,
                labels: {
                boxWidth:12
                }
                },
                scales: {
                xAxes: [{
                stacked: true,
                barPercentage: .5
                }],
                yAxes: [{
                stacked: true
                }]
                },
                tooltips: {
                displayColors:true,
                }
                }
                });
                });
                
                </script>
              </body>
            </html>