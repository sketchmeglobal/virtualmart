<?php
include 'cores/comm-head.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
$data = all_data("SELECT
*, seller.f_name AS SELLER_F_NAME,
seller.l_name AS SELLER_L_NAME,
supplier.f_name AS SUPPLIER_F_NAME,
supplier.l_name AS SUPPLIER_L_NAME
FROM
tbl_order_hdr
INNER JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
LEFT JOIN tbl_product_hdr ON tbl_product_hdr.phid = tbl_order_dtl.product_id
LEFT JOIN vendors vendor ON vendor.id = tbl_product_hdr.vendor_id
LEFT JOIN users seller ON seller.id = tbl_order_dtl.cons_seller_id
LEFT JOIN users supplier ON supplier.id = tbl_order_dtl.cons_supplier_id
LEFT JOIN tbl_order_amt_master ON tbl_order_hdr.order_amt_master_id = tbl_order_amt_master.master_id
LEFT JOIN vendor_kyc ON vendor_kyc.vendor_id = vendor.id
LEFT JOIN tbl_payments ON tbl_payments.tpid = tbl_order_hdr.payment_id
WHERE tbl_order_hdr.order_hdr_id = $id
ORDER BY
tbl_order_hdr.order_hdr_id
DESC")['all_data'];

  if (empty($data[0]['order_hdr_id'])) {
    header('location:checkout-order-data.php');
  }

}else{
  header('location:checkout-order-data.php');
}




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

                      <!-- <label> Order ID: <b>OD00225540</b>  -->
                        <!-- <br><br>Order Status: <br> Invoice Generated - 2023-02-15 <br> Pickup - <b>Pending</b><br> Shipped - <b>Pending</b><br> Delivery - <b>Pending</b> -->
                      <!-- </label> -->
                    </div>
                  <hr>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="float-left">
                        <p>
                          <b><u>Company Details:</u></b>
                          <br>
                          Company Name: <b> Sryahva PVT. LTD.</b>
                          <br>
                          Email: <b>sryahva@gmail.com</b>
                          <br>
                          GST Number: <b>19123456789012</b>
                          <br>
                          Order ID: <b><?=$data[0]['order_id']?></b>
                        </p>
                        <p>
                          Address:
                          <br>
                          Sryahva PVT. LTD., India, Kolkata, Barasat,
                          <br>
                          Kolkata, 700125, West Bengal
                        </p>
                        
                      </div>
                      <div class="float-right">
                        <p>
                          <b><u>Invoice from:</u></b>
                          <br>
                          Vendor Name: <b><?=$data[0]['company']?></b>
                          <br>
                          Email: <b><?=$data[0]['email']?></b>
                          <br>
                          GST Number: <b><?=$data[0]['gst_number']?></b>
                          <br>
                          Invoice Number: <b><?=$data[0]['raz_pay_id']?></b>
                        </p>
                        <p>
                          Address:
                          <br>
                          

                          vendor company name, Building 42/A, <br>Kolkata, 700056, West Bengal, India
                        </p>
                      </div>

                      <div class="float-left">
                        <hr>
                        <p>
                          <b><u>Invoice to:</u></b>
                          <br>
                         Name: <b> <?=$data[0]['f_name'] . ' ' . $data[0]['l_name']?></b>
                          <br>
                          Email: <b><?=$data[0]['email']?></b>
                          <br>
                          Mobile: <b><?=$data[0]['phone']?></b>
                          <br>
                          GST Number: <b><?=$data[0]['customer_gst_number']?></b>
                        </p>
                        <p>
                          Address:
                          <?php
                          if (!empty($data[0]['company'])) {
                          echo $data[0]['company'] . ',';
                          }
                          ?>
                          <?=$data[0]['country']?>, <?=$data[0]['street_addrs']?>, <?=$data[0]['apartment']?>,
                          <br>
                          <?=$data[0]['town']?>, <?=$data[0]['state']?>, <?=$data[0]['zip']?>

                        </p>
                        
                      </div>
                      <div class="float-right">
                        <hr>
                        <p>
                          <b><u>Shipped to:</u></b>
                          <br>
                          Order Generated: <b><?=$data[0]['added_on']?></b>
                          <br>
                          Name: <b> <?=$data[0]['f_name'] . ' ' . $data[0]['l_name']?></b>
                          <br>
                          Email: <b><?=$data[0]['email']?></b>
                          <br>
                          Mobile: <b><?=$data[0]['phone']?></b>
                        </p>
                        <p>
                          Address:
                          <?php
                          if (!empty($data[0]['company'])) {
                          echo $data[0]['company'] . ',';
                          }
                          ?>
                          <?=$data[0]['country']?>, <?=$data[0]['street_addrs']?>, <?=$data[0]['apartment']?>,
                          <br>
                          <?=$data[0]['town']?>, <?=$data[0]['state']?>, <?=$data[0]['zip']?>
                        </p>
                      </div>
                      
                    </div>
                    <br>
                    <hr>
                    <div class="col-md-12">

                      <br><hr><br>
                      <h5><u>Product Details</u></h5>
                      <table class="table-bordered w-100">
                        <tr>
                          <td>Product</td>
                          <td>QTY.</td>
                          <td>Color</td>
                          <td>Size</td>
                          <th>GST %</th>
                          <th>Amt.</th>
                          
                          <td class="text-right">Total</td>

                        </tr>
                        <?php 
                        $total = 0;
                        $tax_calc = 0;
                        foreach ($data as $val) {
                          ?>
                        <tr>
                          <td><?=$val['ph_title']?></td>
                          <td><?=$val['product_qty']?></td>
                          
                          <td><?=$val['product_color']?></td>
                          <td><?=$val['product_size']?></td>
                          <td><?=$val['product_tax']?> + <?=$val['product_tax']?></td>
                          <td>&#8377;<?=$val['product_price']?></td>
                          
                          <td class="text-right">
                            &#8377;<?php $total += $val['product_price']*$val['product_qty'];
                            echo $p_price = $val['product_price']*$val['product_qty'];
                            ?>
                              
                            </td>
                        </tr>


                      <?php 
                      $tax_calc += ((($p_price*$val['product_tax'])/100)*2);
                    } ?>
                          <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">Subtotal: &#8377;<?=$total?></span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">Discount: &#8377;<?=$discount = $data[0]['discount_amt']+0?></span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">Shipping Charges: &#8377;<?=$shipping_charges = $data[0]['shipping_charges']?></span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">Customer Bonus: &#8377;<?=$customer_bonus = $data[0]['customer_bonus_amt']?></span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">Tota: &#8377;<?=(($shipping_charges+$total)-($discount+$customer_bonus))?></span></th>
                        </tr>
                        <tr>
                          <th class="p-2" colspan="7"><span style="float: right;">
                            <?php 

                            
                            if ($data[0]['customer_state_tin']==$data[0]['state_tin']) {

                              echo 'Tax = (SGST &#8377;'.$tax_calc/2 .' + ' . 'CGST &#8377;' . $tax_calc/2 . ')';
                            }else{
                               echo 'Tax = (IGST &#8377;'.$tax_calc. ')';
                            }
                            
                             ?>
                          : <?=$tax_calc?></span>
                        </th>
                        </tr>
                       
                        <!-- <tr>
                          <th class="p-2" colspan="6"><span style="float: right;">Total: 00</span></th>
                        </tr> -->
                      </table>
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