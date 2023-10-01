<?php

$table = 'tbl_brands';
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 'db' => 'logo', 
        'dt' => 0,
        'formatter' => function($d, $row){
            return '<img src="../vendor-images/'.$d.'" style="width:100px">';
        }
     ),
    array( 'db' => 'brand_name',  'dt' => 1 ),
    array( 'db' => 'brand_title',   'dt' => 2 ),
    array( 'db' => 'website',     'dt' => 3 ),
    array(
        'db'        => 'status',
        'dt'        => 4,
        'formatter' => function( $d, $row ) {
            return ($d == 0 ? 'No' : 'Yes');
        }
    ),
    array( 
        'db'        => 'id', 
        'dt'        => 5, 
        'formatter' => function( $d, $row ) {
            return ' 
                <a class="btn btn-primary" href="brands_edit.php?id='.$d.'"><i class="zmdi zmdi-edit"></i></a>&nbsp; 
                <a class="btn btn-danger"  href="#" onClick="soft_delete('.$d.')"><i class="zmdi zmdi-minus-circle"></i></a> 
            '; 
        } 
    ) 
);

require( '../../function/ssp.class.php' );
$where = "tbl_brands.row_status = 1 ";
echo json_encode(
    SSP::simple( $_GET, $sql_details='', $table, $primaryKey, $columns, $where )
);