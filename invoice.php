<?php
include_once 'function/functions.php';
if (isset($_GET['order']) && isset($_SESSION['id'])) {

$order_id = $_GET['order'];
$where1 = ['tbl_order_hdr.user_id'=>$_SESSION['id'], 'tbl_order_hdr.order_id' => $order_id];

$user_data = conditon_data('tbl_order_hdr JOIN tbl_order_dtl ON tbl_order_hdr.order_hdr_id = tbl_order_dtl.order_hdr_id','*',$where1);
if ($user_data['data']==true) {


$user = $user_data['all_data'];

if (!empty($user['company'])) {
   $company_name =  $user['company'];
}else{
    $company_name = null;
}

$country = ($user['country']=='')? null:  ', '.$user['country'];

$street_addrs = ($user['street_addrs']=='')? null:  ', '.$user['street_addrs'];

$apartment = ($user['apartment']=='')? null:  ', '.$user['apartment'];

$town = ($user['town']=='')? null:  ', '.$user['town'];

$state = ($user['state']=='')? null:  ', '.$user['state'];

$zip = ($user['zip']=='')? null:  ', '.$user['zip'];

$user_address = $company_name.$country.$street_addrs.$apartment.$town.$state.$zip;




if ($_SERVER['HTTP_HOST']=='localhost') {
    $weburl = site_url;
}else{
    $weburl = site_url;
}



require_once __DIR__ . '/mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

$html = '<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Invoice</title>
</head>
<body>
<div class="paper-size" id="">
<style>
.company-header{
line-height: 1.4;
}

.invoice-start{
margin: auto;
border: 1px solid #000000;
height: auto;
width: 210mm;
}

.company-address{

}
.company-information{
float: right;
margin-right: 17px;
}
.company-header hr{
margin-top: 117px;
}
.text-cap{}
.text-und{text-decoration: underline;}
.text-center{text-align: center;}
.ml-5{margin-left: 5px;}
.mr-5{margin-right: 5px;}
.mt-5{margin-top: 5px;}
.mb-5{margin-bottom: 5px;}
.ml-10{margin-left: 10px;}
.mr-10{margin-right: 10px;}
.mt-10{margin-top: 10px;}
.mb-10{margin-bottom: 10px;}
.ml-20{margin-left: 20px;}
.mr-20{margin-right: 20px;}
.mt-20{margin-top: 20px;}
.mb-20{margin-bottom: 20px;}
.ml-30{margin-left: 30px;}
.mr-30{margin-right: 30px;}
.mt-30{margin-top: 30px;}
.mb-30{margin-bottom: 30px;}
.invoice-date{float: right;}
.p-5{padding: 5px;}
.invocie-no{position: absolute;}
.customer-note{border: 2px solid #000000;}
.f-600{font-weight: 600;}
.f-500{font-weight: 500;}
.table1{width: 97.5%;border-spacing: 0;}
.table1 td{
border-spacing: 0;
padding: 5px;
}
.border{border: 1px solid #000000;}
.border-bottom td{
border-bottom: 1px solid #000000;
}
.border-top td{
border-top: 1px solid #000000;
}
.border-left{
border-left: 1px solid #000000;
}
.border-right{
border-right: 1px solid #000000;
}
.border-bottom{
border-bottom: 1px solid #000000;
}
.padding-50{
padding-bottom: 50px !important;
}
.padding-30{
padding-bottom: 30px !important;
}
.padding-20{
padding-bottom: 20px !important;
}
.padding-10{
padding-bottom: 10px !important;
}
</style>
<div class="invoice-start">
<div class="company-header">
<div style="text-align: center;font-weight:500;text-transform: uppercase;">Sryahva Enterprises Private Limited</div>
<div><img src="'.$weburl.'/assets/images/logo.png" alt="" style="height: 50px; position: absolute; margin-left: 11px; margin-top: 11px;"></div>

<div style="float:left; margin-left:11px;">
Sachimata Enclave, Flat No B, 2<sup>nd</sup> floor<br>
Kolkata, West Bengal, India<br>
Pin - 700-116<br>
</div>
<div style="float:right !important; margin-left:450px;margin-top:-100px">
GSTIN: 6546546546<br>
Contact No.: +91 8910-611-106<br>
Contact No.: +91 9681-685-823<br>
Email: info@sryahva.com<br>
Website: www.virtualmart.co.in<br>
</div>
<hr/>
</div>
<div class="invoiuce-body ml-10 mr-10">
<div class="body-head text-cap text-und text-center">TAX INVOICE</div>
<div class="customer-name text-cap"> Name: '.$user['f_name'].' '.$user['l_name'].'</div>
<div class="invocie-no text-cap"> Invoice No.: '.$user['order_id'].' </div>
<div class="invoice-date" style="float:right !important;margin-left:450px;margin-top:-30px;">
Mobile: '.$user['phone'].'<br>
Date: '.date("d M, Y - h:i:s", strtotime($user['added_on'])).'</div>
<div class="customer-note  mt-30 mb-20 p-5">
Address: '.$user_address.'
</div>
<div class="f-600 text-center">Invoice Description</div>
</div>
<table class="ml-10 mr-10 table1 " cellspacing="0">
<tr class="text-center border-top border-bottom">
<td class="border-left">Sr.#</td>
<td class="border-left">Description / Specification</td>
<td class="border-left">QTY.</td>
<td class="border-left">Price</td>
<td class="border-left border-right">Total Amount</td>
</tr>
';
$order_details_query = "SELECT * FROM tbl_order_dtl
                        JOIN tbl_product_hdr ON tbl_order_dtl.product_id = tbl_product_hdr.phid
                      WHERE tbl_order_dtl.user_id = '".$_SESSION['id']."' && tbl_order_dtl.order_id = '".$user['order_id']."' ";
                        $order_det_data = all_data($order_details_query);
                        
                        $total_amt = 0;
                        foreach ($order_det_data['all_data'] as $key => $value) {
                            $p_price = ($value['product_price']*$value['product_qty']);
                            $total_amt +=$p_price;


$html .='<tr class="border-bottom">
<td class="text-center border-left padding-10">'.++$key.'.</td>
<td class="border-left padding-10">'.$value['ph_title'].'</td>
<td class="border-left padding-10">'.$value['product_qty'].'</td>
<td class="border-left padding-10">'.number_format($value['product_price'],2).'</td>

<td class="border-left border-right padding-10"><span style="float: right;">'.number_format($p_price,2).'</span></td>
</tr>';
}
$html .='
<tr class="border-bottom">
<td colspan="4" class="border-left padding-10"><span style="float: right;">Sub Total</span></td>
<td class="border-left border-right padding-10"><span style="float: right;">'.number_format($total_amt,2).'</span></td>
</tr>
<tr class="border-bottom">
<td colspan="4" class="border-left padding-10"><span style="float: right;">Discount</span></td>
<td class="border-left border-right padding-10"><span style="float: right;">'.number_format(($user['discount_amt']),2).'</span></td>
</tr>
<tr class="border-bottom ">
<td colspan="4" class="border-left padding-10"><span class="text-right" style="float: right;">Total</span></td>
<td class="border-left border-right padding-10"><span class="text-right" style="float: right;">'.number_format($total_amt-$user['discount_amt'],2).'</span></td>
</tr>
</table>
<br/>
</div>

</div>
</body>
</html>';

$mpdf->WriteHTML($html);

$mpdf->Output();
}
else{
     header('location:account.php');
}
}
else{
    header('location:account.php');
}
?>


