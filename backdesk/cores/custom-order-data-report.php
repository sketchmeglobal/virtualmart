<?php 
include '../../function/functions.php';

$and = false;
if ($_POST['from_date']!='' || $_POST['to_date']!='' || $_POST['vendor']!='' ||  $_POST['shipment_status']) {
  $where = " WHERE ";
}

if ($_POST['from_date']!='' && $_POST['to_date']!='') {
  $and = true;
	$where .= " tbl_order_hdr.added_on BETWEEN '" . $_POST['from_date'] . "' AND '" . $_POST['to_date'] . "'";
  }

  if ($_POST['vendor']!='') {
    if ( $and == true) {
        $where .= " && tbl_product_hdr.vendor_id = ".$_POST['vendor'];
    }else{
      $and = true;
      $where .= " tbl_product_hdr.vendor_id = ".$_POST['vendor'];
    }
  }

    if ($_POST['shipment_status']!='') {
    if ( $and == true) {
        $where .= " && tbl_order_dtl.shipment_status = ".$_POST['shipment_status'];
    }else{
      $where .= " tbl_order_dtl.shipment_status = ".$_POST['shipment_status'];
    }
  }
	



?>
<table id="example" class="table table-bordered">
                      <thead>
                         <tr>
                          <th>Sl. No</th>
                          <th>Order ID</th>
                          <th>Product</th>
                          <th>Customer Name</th>
                          <th>Email ID</th>
                          <th>Vendor</th>
                          <th>GST Rate</th>
                          <th>Vendor Net amount (without tax)</th>
                          <th>Vendor gross amount (with tax)</th>
                          <th>Vendor Payable</th>
                          <th>Admin Commission (%)</th>
                          <th>Admin Commission</th>
                          <th>Shipping Charges(Coll.)</th>
                          <th>Order Amount (Gross)</th>
                          <th>Adjustment from Reward Point (%)</th>
                          <th>Adjustment from Reward Amount</th>
                          <th>Customer payable amount</th>
                          <th>Vendor Tax  = (DP + Shipping Amt.)</th>
                          <th>Consultant Seller Name</th>
                          <th>Consultant Seller Commission %</th>
                          <th>Consultant Seller Amt.</th>
                          <th>Consultant supplier name</th>
                          <th>Consultant Supplier Commission %</th>
                          <th>Consultant Supplier  Amount</th>
                          <th>Order Placed (Date)</th>
                          <th>Customer gateway Paid</th>
                          <th>Gateway Charges base amt.</th>
                          <th>gateway charges gst amt.</th>
                          <th>Reserve for Promotion  % </th>
                          <th>Reserve for Promotion Amt.</th>
                          <th>Admin Profit</th>
                          <th>Order intemation to vendor</th>
                          <th>Invoice generation status</th>
                          <th>invoice number</th>
                          <th>Pickup status</th>
                          <th>shipping agent name</th>
                          <th>Shipping reference number</th>
                          <th>Shipment status</th>
                          <th>vendor payable staus</th>
                          <th>vendor TXN ID</th>
                          <th>consultant seller payable status</th>
                          <th>Consultant Seller TXN ID</th>
                          <th>consultant supplier payable status</th>
                          <th>Consultant Supplier TXN ID</th>
                          <th>Amount paid to shipping agent</th>
                          <th>shipping agent payable status</th>
                          <th>shipping TXN ID</th>
                          <th>Gateway sattlement status</th>
                          <th>admin banking status with bank name</th>
                          <th>gst amount</th>
                          <th>gst payment status (customer paid amt.)</th>
                          <th>gst challan Number</th>
                          <th>customer gst number (optional)</th>
                          <th>total collection amt.</th>
                          <th>actual refundable amt.</th>
                          <th>reverse base amt.</th>
                          <th>reverse gst amt.</th>
                          <th>return charges amt.</th>
                          <th>customer review</th>
                        </tr>
                     </thead>
                     <tbody>
                      <?php 
                        
                       // customer name, email id, vendor amt, gross amount, 
                        
                      $data = all_data("SELECT
                                    *, seller.f_name AS SELLER_F_NAME,
    seller.l_name AS SELLER_L_NAME,
    supplier.f_name AS SUPPLIER_F_NAME,
    supplier.l_name AS SUPPLIER_L_NAME,
    tbl_order_hdr.order_hdr_id,
    tbl_order_dtl.f_name AS order_f_name,
    tbl_order_dtl.l_name AS order_l_name,
    tbl_order_dtl.email AS order_email
    
                                FROM
                                    tbl_order_hdr
                                INNER JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id
                                LEFT JOIN tbl_product_hdr ON tbl_product_hdr.phid = tbl_order_dtl.product_id
                                LEFT JOIN vendors ON vendors.id = tbl_product_hdr.vendor_id

                               LEFT JOIN users seller ON seller.id = tbl_order_dtl.cons_seller_id
                                LEFT JOIN users supplier ON supplier.id = tbl_order_dtl.cons_supplier_id
                                LEFT JOIN tbl_order_amt_master ON tbl_order_hdr.order_amt_master_id = tbl_order_amt_master.master_id
                                $where
                                ORDER BY
                                    tbl_order_hdr.order_hdr_id
                                DESC
                                ");

                      $cnt = 1;
                      if (!empty($data['data'])) {
                        $order_id_array = [];
                        foreach($data['all_data'] AS $od){

                          // if, order id repeated, then, some value will show zero
                          if (!in_array($od['order_id'], $order_id_array)) {
                              $repeater = false;
                          }else{
                            $repeater = true;
                          }

                          // store order id, for checking id repeated or not
                          array_push($order_id_array , $od['order_id']);

                          //calculate all price
                         
                          
                          $product_taxpercent = $od['product_tax'];

                          $product_final_tax = ($product_taxpercent+$product_taxpercent);

                          $calc1 = (($od['product_actual_amt']*$product_final_tax)/100);

                          $vendor_tax_amt = number_format(($od['product_actual_amt']*$calc1)/($od['product_actual_amt']+$calc1),2);
                        
                            $vendor_payable_amt = $od['product_actual_amt']-$vendor_tax_amt;
                            
                          $admin_commission_percen = $od['product_admin_commi'];
                          $admin_commission_amt = ((($od['product_actual_amt'])*$admin_commission_percen)/100);

                         

                          $gst_base_rate = (100/(100+$product_final_tax)*$product_final_tax);

                          $product_price = ($od['product_actual_amt']);

                          // customer bonus amt calculation
                          $bonus_percentage = $od['customer_bonus_percent'];
                          $bonus_amt = (($od['product_price']*$bonus_percentage)/100);

                          // customer payable amt
                          $customer_payable_amt = (($od['product_price']+$od['shipping_charges'])-$bonus_amt);
                          
                          // vedor tax = dp + shipping charges
                          $display_vendor_tax = number_format((($customer_payable_amt*$gst_base_rate)/100),2);
                          
                          //consultant seller calc
                          $cons_amt = ($customer_payable_amt-($display_vendor_tax+$od['shipping_charges']));
                          
                          
                          // cosultant seller amount
                          $seller_amt = number_format((($cons_amt*$od['cons_seller_percent'])/100),2);
                          
                          // consultant supplier amount
                          $supplier_amt = number_format((($cons_amt*$od['cons_supplier_percent'])/100),2);
                          
                         /*gateway charges amount calc
                            both are provided by razorpay gateway */
                            
                            $gateway_amt = 0; 
                            $gateway_gst = 0;
                            
                            $gateway_base_amt = ($gateway_amt-$gateway_gst);// gateway base amt without gst
                            
                          // admin profit
                         //($admin_commission_amt-($seller_amt+$supplier_amt+$od['shipping_charges']+$bonus_amt));
                         
                        
                         //echo $customer_payable_amt . ' .. ' . $vendor_payable_amt  .' .. '.  $seller_amt .'..'. $supplier_amt .'..'.  $od['shipping_charges'] .'..'. $display_vendor_tax.'..'.  $gateway_base_amt;die;   
                         $admin_profit = ($customer_payable_amt-($vendor_payable_amt+$seller_amt+$supplier_amt+$od['shipping_charges']+$display_vendor_tax+$gateway_base_amt));
                          
                          // gst amount = vendor tax(dp + shipping)
                           $gst_amt = $display_vendor_tax;
                      ?>
                       <tr>
                           

                          <td><?=$cnt++;?></td>
                          <td><?=$od['order_master_id']?></td>
                          <td>
                             <a href="update-order-product.php?id=<?=$od['order_dtl_id']?>" target="_blank"><?=$od['ph_title']?></a>
                          </td>
                          <td><?=$od['order_f_name'] . ' ' . $od['order_l_name']?></td>
                          <td><?=$od['order_email']?></td>
                          <td>
                            <a href="update-order-vendor.php?id=<?=$od['order_hdr_id']?>" target="_blank"><?=$od['company_name']?></a>
                            </td>

                            <!-- gst rate  -->
                            <td><?=number_format($product_final_tax,2)?></td>
                          <!-- vendor amount without tax -->
                          <td><?=$od['product_actual_amt']-$vendor_tax_amt?></td> 

                          <!-- vendor actual amt -->
                          <td><?=$od['product_actual_amt']?></td>

                          <!-- vendor paybale amt -->
                           <td><?=$vendor_payable_amt?></td>

                          <!-- admin commission percentage -->
                          <td><?=$admin_commission_percen?></td>

                          <!-- admin commission amt. -->
                          <td><?=$admin_commission_amt?></td>

                          <!-- if, order not repeater, the show shipping charges -->
                          <td>
                            <?= ($repeater==false) ? $od['shipping_charges'] : 'Nill'; ?> 
                          </td>

                          <!-- order amount gross-->
                          <td><?=$od['product_price']?></td>

                          <!-- customer bonus percentage -->
                          <td><?=$bonus_percentage?></td>

                          <!-- customer bonus amt -->
                          <td><?=$bonus_amt?></td>

                          <!-- customer payable (product_price - bonus amt) -->
                          <td><?=$customer_payable_amt;?></td> 

                          <!-- vendor tax  = (DP + Shipping Amt.)-->
                          <td><?=($repeater==false) ? $display_vendor_tax : 'Nill'?></td> 

                          <!-- Consultant Seller Name -->
                          <td><?= ($od['cons_seller_id']==0) ? 'Nill':$od['SELLER_F_NAME'] . ' ' . $od['SELLER_L_NAME']?></td>

                          <!-- Consultant Seller Commission % -->
                          <td><?= ($od['cons_seller_id']==0) ? 'Nill':$od['cons_seller_percent']?></td>

                          <!-- Consultant Seller Amt. -->
                          <td><?= ($od['cons_seller_id']==0) ? $seller_amt = 0: $seller_amt;?></td>


                          <!-- Supplier Seller Name -->
                          <td><?= ($od['cons_supplier_id']==0) ? 'Nill':$od['SUPPLIER_F_NAME'] . ' ' . $od['SUPPLIER_L_NAME']?></td>

                          <!-- Supplier Seller Commission % -->
                          <td><?= ($od['cons_supplier_id']==0) ? 'Nill':$od['cons_seller_percent']?></td>

                          <!-- Supplier Seller Amt. -->
                          <td><?= ($od['cons_supplier_id']==0) ? $supplier_amt =  0: $supplier_amt;?></td>

                          <!-- Order Placed (Date) -->
                          <td><?=$od['added_on']?></td>

                          <!-- Customer gateway Paid -->
                          <td><?=($repeater==false)? $od['customer_paid_amt'] : 'Nill'?></td>

                          <!-- Gateway Charges base amt. -->
                          <td><?=$gateway_amt?></td>

                          <!-- gateway charges gst amt.  -->
                          <td><?=$gateway_gst?></td>

                          <!-- Reserve for Promotion  %  -->
                          <td>
                            <?php echo $od['reserve_amt_percent'] ?>
                            
                          </td>

                          <!-- Reserve for Promotion Amt. -->
                          <td>
                            
                            <?php 

                            

                            echo number_format((($admin_profit*$od['reserve_amt_percent'])/100),2);
                             ?>

                          </td>

                          <!-- Admin Profit -->
                          <td><?=($repeater==false)? $admin_profit : 'Nill'?></td>
                          
                          <!-- Order intemation to vendor -->
                          <td>
                            <?php 

                            if ($repeater==false) {
                                
                                if ($od['admin_process']==0) {
                                  echo '<a href="?order_id='.$od['order_hdr_id'].'" >To be Transferred</a>';
                                }else{
                                  echo '<a href="demo-invoice-details.php?id='.$od['order_hdr_id'].'" target="_blank">Invoice Generated</a>';
                                }
                            }
                             ?>
                             
                          </td>

                          <!-- Invoice generation status -->
                          <td><?=($repeater==false)? $od['admin_process_date'] : '';?></td>

                          <!-- invoice number. (gateway invoice number) -->
                          <td><?=$od['order_id']?></td>

                          <!-- Pickup status -->
                          <td><?=$od['pickup_status']==0? 'Pending':'Picked up' ?></td>

                          <!-- shipping agent name -->
                          <td><?=$od['shipping_agent_name']?></td>

                          <!-- Shipping reference number -->
                          <td><?=$od['shipping_track_number']?></td>

                          <!-- shippment status -->
                          <td><?=$od['shipment_status']?></td>

                          <!-- vendor payable staus -->
                          <td><?=$od['vendor_payable_status']==0? 'Pending':'paid' ?></td>

                          <!-- vendor TXN ID -->
                          <td><?=$od['vendor_txn_id']?></td>

                          <!-- consultant seller payable status -->
                          <td><?=$od['seller_pay_status']==0? 'Pending':'paid' ?></td>

                          <!-- Consultant Seller TXN ID -->
                          <td><?=$od['seller_txn_id']?></td>

                          <!-- consultant supplier payable status -->
                          <td><?=$od['supplier_pay_status']==0? 'Pending':'paid' ?></td>

                          <!-- Consultant Supplier TXN ID -->
                          <td><?=$od['supplier_txn_id']?></td>

                          <!-- Amount paid to shipping agent -->
                          <td><?=$od['amt_paid_shipping_agent']?></td>

                          <!-- shipping agent payable status -->
                          <td><?=$od['amt_paid_shipping_agent']<0? 'Pending':'paid' ?></td>

                          <!-- shipping TXN ID -->
                          <td><?=$od['shipping_txn_id']?></td>

                          <!-- Gateway sattlement status -->
                          <td><?=$od['gateway_sattlement_status']==0? 'Pending':'paid' ?></td>

                          <!-- admin banking status with bank name -->
                          <td><?=$od['credit_bank_name']?></td>

                          <!-- gst amount -->
                          <td><?=$gst_amt?></td>

                          <!-- gst payment status (customer paid amt.) -->
                          <td><?=$od['gst_pay_status']==0? 'Pending':'paid' ?></td>

                          <!-- gst challan Number -->
                          <td><?=$od['gst_challan_number']?></td>

                          <!-- customer gst number (optional) -->
                          <td><?=$od['customer_gst_number']?></td>

                          <!-- total collection amt. -->
                          <td><?=$od['product_price']?></td>

                          <!-- actual refundable amt. -->
                          <td><?=$od['actual_refundable_amt']?></td>

                          <!-- reverse base amt. -->
                          <td><?=$od['reverse_base_amt']?></td>

                          <!-- reverse gst amt. -->
                         <td><?=$od['reverse_gst_amt']?></td>

                          <!-- return charges amt. -->
                          <td><?=$od['return_charges_amt']?></td>

                          <!-- customer review -->
                          <td></td>
                        </tr>
                        <?php }}else{ ?>
                          <tr>
                            <td colspan="59">No data found</td>
                          </tr>
                        <?php } ?>

                        </tbody>
                      </table>


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