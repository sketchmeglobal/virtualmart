<?php
require( '../../function/ssp.class.php' );
if (isset($_POST['size_id'])) {
    $transfer_data = [];
    $data_q = single_data("SELECT * FROM tbl_size WHERE tsid = '".$_POST['size_id']."' ")['all_data'];
    $transfer_data['size'] = $data_q['size_name'];
    $transfer_data['id'] = $data_q['tsid'];
    echo json_encode($transfer_data);
}

if (!isset($_POST['size_id'])){


$table = 'tbl_size';
$primaryKey = 'tsid';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array('db' => 'tsid','dt' => 0),
    array( 'db' => 'size_name', 'dt' => 1 ),
    
    array( 
        'db'        => 'tsid', 
        'dt'        => 2, 
        'formatter' => function( $d, $row ) { 
            return ' 
            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#staticBackdropEDIT" onclick="edit('.$d.')"> <i class="zmdi zmdi-edit"></i> </a>
            <a href="#" onClick="soft_delete('.$d.')"><i class="text-warningxt fa fa-times"></i></a>'; 
        } 
    ) 
);


 
echo json_encode(
    SSP::simple( $_GET, $sql_details='', $table, $primaryKey, $columns, 'row_status = 1 ' )
);
}