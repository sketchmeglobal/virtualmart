<?php
include 'cores/comm-head.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Order Details</title>
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
    <!--Data Tables -->
    <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
    
  </head>
  <body>
    <!-- Start wrapper-->
    <div id="wrapper">
      
      <?php include 'cores/menu.php' ?>
      <div class="clearfix"></div>
      
      <div class="content-wrapper">
        <div class="container-fluid">
          <!--Start Dashboard Content-->
          
          <div class="row mt-3">
            
            <div class="col-lg-12">
              <div class="card">
                <!-- <p><a href="child-category-form.php" class="btn btn-success btn-md col-1">+ Add New</a></p> -->
                <div class="card-header"><i class="fa fa-table"></i> Order Details</div>
                <div class="card-body">
                  <div class="d-flex justify-content-center">
                        <h4><u>Invoice Details</u></h4>
                      </div>
                    <div class="row bg-light p-1 d-flex" style="justify-content:space-evenly">

                      <label> Order ID: <b>OD00225540</b> <br><br>Order Status: <br> Invoice Generated - 2023-02-15 <br> Pickup - <b>Pending</b><br> Shipped - <b>Pending</b><br> Delivery - <b>Pending</b></label>
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="float-left">
                        <p>
                          <b><u>Seller Details:</u></b>
                          <br>
                          Name: <b> Vendor 2</b>
                          <br>
                          Email: <b>103@gmail.com</b>
                          <br>
                          Mobile: <b>103</b>
                        </p>
                        <p>
                          Address:
                          <br>
                          Demo Company PVT LTD, India, Kolkata, Barasat,
                          <br>
                          Kolkata, 700125, West Bengal
                        </p>
                        
                      </div>
                      <div class="float-right">
                        <p>
                          <b><u>Shipping Details:</u></b>
                          <br>
                          Order Generated: <b>2023-02-15 14:0:53</b>
                          <br>
                          Name: <b> Sayub Ali</b>
                          <br>
                          Email: <b>105@gmail.com</b>
                          <br>
                          Mobile: <b>105</b>
                        </p>
                        <p>
                          Address:
                          <br>
                          Delivery company name (optional), India, Kolkata, Building 42/A,
                          <br>
                          Kolkata, 700056, West Bengal
                        </p>
                      </div>
                      
                    </div>
                    <div class="col-md-12">
                      <table class="table-bordered w-100">
                        <tr>
                          <td>Product</td>
                          <td>QTY.</td>
                          <td>Color</td>
                          <td>Size</td>
                          <th>Amt.</th>
                          <td class="text-right">Total</td>

                        </tr>
                        <tr>
                          <td><a href="demo-product-form-edit.php" >Bhagalpuri Art Silk Saree</a></td>
                          <td>1</td>
                          
                          <td>Multicolor</td>
                          <td>5.5m</td>
                          <td>360.00</td>
                          <td class="text-right">360.00</td>
                        </tr>
                          <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Subtotal: 360.00</span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Discount: 0.00</span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Total: 360.00</span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Shipping Charges: 50.00</span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Tax = DP(CGST + SGST)+Shipping Charge: 17.50</span></th>
                        </tr>
                       
                        <!-- <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Total: 00</span></th>
                        </tr> -->
                      </table>
                    </div>

                    <div class="col-md-12 py-3">
                      <div class="d-flex justify-content-center">
                        <h4><u>Payment Summary</u></h4>
                      </div>
                      Customer Paid Amount: <b>410.00</b>
                      <br>
                      Admin Commission: <b>60.00</b>
                      <br>
                      John Doe: <b>03.60</b> (Consultant Seller)
                      <br>
                      John 2: <b>07.20</b> (Consultant Supplier)
                      <br>
                      Gateway Charges: <b>8.28</b>
                      <br>
                      Shipping Charges: <b>50.28</b>
                      <br>
                      TAX: <b>17.50</b>
                      <br>
                      Admin Profit: <b>42.72</b>

                      <div class="d-flex justify-content-center">
                        ---
                      </div>
                      <h5>Payout Status</h5>
                      <table class="table-bordered w-100">
                        <tr>
                          <th>Member</th>
                          <th>Type</th>
                          <th>Pending Amout</th>
                          <th>Paid Amount</th>
                        </tr>
                        <tr>
                          <td>John Doe</td>
                          <td>Consultant (Seller)</td>
                          <td>3.60</td>
                          <td>0.00</td>
                        </tr>
                        <tr>
                          <td>John 2</td>
                          <td>Consultant (Supplier)</td>
                          <td>7.20</td>
                          <td>0.00</td>
                        </tr>
                        <tr>
                          <td>Vendor 2</td>
                          <td>Vendor</td>
                          <td>300.00</td>
                          <td>0.00</td>
                        </tr>
                      </table>
                      <small><b>N.B.: Pending amount = gross amount on the listed members from all orders</b></small>
                    </div>
                  </div>
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
          <!--Data Tables js-->
          <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
          <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>
          <script>
          $(document).ready(function() {
          //Default data table
          $('#default-datatable').DataTable();
          var table = $('#example').DataTable( {
          lengthChange: false,
          buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
          } );
          
          table.buttons().container()
          .appendTo( '#example_wrapper .col-md-6:eq(0)' );
          
          } );
          </script>
          
        </body>
      </html>
      <?php
      if (isset($_GET['did'])) {
      $delete_sql = "DELETE FROM tbl_child_category WHERE tccid = '".$_GET['did']."' ";
      $data = delete($delete_sql);
      if ($data==true) {
      echo '<script>alert("Data deleted");window.location.href="child-category.php";</script>';
      }else{
      //echo '<script>alert("Please try again");window.location.href="";</script>';
      }
      }
      ?>