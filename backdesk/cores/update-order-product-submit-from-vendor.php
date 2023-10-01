<?php
include '../../function/functions.php';

/*start update query*/
if (isset($_POST['order_update'])) {
  extract($_POST);
  conditon_update('tbl_order_dtl',['pickup_status' => $pickup_status, 'shipping_agent_name' => $shipping_agent_name,'shipping_track_number' => $shipping_track_number,'shipment_status' => $shipment_status,  'amt_paid_shipping_agent' => $amt_paid_shipping_agent, 'shipping_txn_id' => $shipping_txn_id, 'actual_refundable_amt' => $actual_refundable_amt,'reverse_base_amt' => $reverse_base_amt,'reverse_gst_amt' => $reverse_gst_amt,'return_charges_amt' => $return_charges_amt],['order_dtl_id' => $order_id]);

  // if, this product delivered, then distribute consultant commission
  if ($shipment_status == 'Product Delivered') {
      $order_data = conditon_data('tbl_order_dtl','*',['order_dtl_id' => $order_id])['all_data'];

      $order_value = $order_data['order_value'];


      if ($order_data['cons_seller_id']>0) {
        $seller_id = $order_data['cons_seller_id'];
        $seller_percent = $order_data['cons_seller_percent'];
        $seller_amt = (($order_value*$seller_percent)/100);

         bind_insert('tbl_commission_added', ['consultant_id'=>$seller_id, 'consultant_type'=> 'SELLER', 'order_dtl_id'=>$order_id, 'purchase_usr_id'=> $order_data['user_id'], 'product_dtl_id'=> $order_data['product_dtl_id'], 'product_qty'=>  $order_data['product_qty'], 'product_price'=>  $order_data['product_price'], 'total_price'=>  $order_data['order_value'],  'commission_amt'=>  $seller_amt, 'commission_percen' =>  $order_data['cons_seller_percent']]);
         update("UPDATE users SET ewallet = ewallet+$seller_amt WHERE id = $seller_id");
      }

      if ($order_data['cons_supplier_id']>0) {
        $supplier_id = $order_data['cons_supplier_id'];
        $supplier_percent = $order_data['cons_supplier_percent'];
        $supplier_amt = (($order_value*$supplier_percent)/100);

        bind_insert('tbl_commission_added', ['consultant_id'=>$supplier_id, 'consultant_type'=> 'SUPPLIER', 'order_dtl_id'=>$order_id, 'purchase_usr_id'=> $order_data['user_id'], 'product_dtl_id'=> $order_data['product_dtl_id'], 'product_qty'=>  $order_data['product_qty'], 'product_price'=>  $order_data['product_price'], 'total_price'=>  $order_data['order_value'],  'commission_amt'=>  $supplier_amt, 'commission_percen' =>  $order_data['cons_supplier_percent']]);
        update("UPDATE users SET ewallet = ewallet+$supplier_amt WHERE id = $supplier_id");
      }
      

  }

header('location:../vendor.php?page=order-data-details&order='.encode($order_id).'&msg=Order Updated');
}
 ?>