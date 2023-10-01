<?php
require( '../../function/ssp.class.php' );
if (isset($_POST['color_code_id'])) {
    $transfer_data = [];
    $data_q = single_data("SELECT * FROM tbl_color WHERE tcid = '".$_POST['color_code_id']."' ")['all_data'];
    $transfer_data['color_code'] = $data_q['color_code'];
    $transfer_data['id'] = $data_q['tcid'];
    echo json_encode($transfer_data);
}

if (!isset($_POST['color_code_id'])){


$table = 'tbl_color';
$primaryKey = 'tcid';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array('db' => 'tcid','dt' => 0),
    array( 'db' => 'color_code', 'dt' => 1 ),
    array( 'db' => 'color_code',  
        'dt' => 2, 
        'formatter' => function( $d, $row ) { 
            return '<span style="padding: 5px;background:'.$d.';border-radius: 5px"> &nbsp;&nbsp;&nbsp;&nbsp;</span>'; 
        } 
    ),

    array( 
        'db'        => 'tcid', 
        'dt'        => 3, 
        'formatter' => function( $d, $row ) { 
            return ' 
            <a class="" href="#" data-toggle="modal" data-target="#staticBackdropEDIT" onclick="edit('.$d.')">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
            <a href="#" onClick="soft_delete('.$d.')"><i class="text-warningxt fa fa-times"></i></a>'; 
        } 
    ) 
);


 
echo json_encode(
    SSP::simple( $_GET, $sql_details='', $table, $primaryKey, $columns, 'row_status = 1 ' )
);
}