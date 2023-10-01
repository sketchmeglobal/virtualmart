<?php
 
$table = 'tbl_child_category LEFT JOIN tbl_parent_category ON tbl_child_category.tc_parent_cat_id = tbl_parent_category.p_cid';
$primaryKey = 'tccid';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes

$columns = array(
    array('db' => 'p_c_status','dt' => 0),
    array( 'db' => 'tc_name', 'dt' => 1 ),
    array( 'db' => 'tc_status',  
        'dt' => 2, 
        'formatter' => function( $d, $row ) { 
            return $d == 0 ? '<i class="fa fa-circle text-warning" aria-hidden="true"></i>' : '<i class="fa fa-circle text-success" aria-hidden="true"></i>'; 
        } 
    ),
    array( 'db' => 'p_c_name', 'dt' => 3 ),
    array( 'db' => 'p_c_status',  
        'dt' => 4, 
        'formatter' => function( $d, $row ) { 
            return $d == 0 ? '<i class="fa fa-circle text-warning" aria-hidden="true"></i>' : '<i class="fa fa-circle text-success" aria-hidden="true"></i>'; 
        } 
    ),

    array( 
        'db'        => 'tccid', 
        'dt'        => 5, 
        'formatter' => function( $d, $row ) { 
            return ' 
            <a href="child-category-form-edit.php?id='.$d.'" class=""><i class="fa fa-edit"></i></a>
            <a href="#" onClick="soft_delete('.$d.')"><i class="text-warningxt fa fa-times"></i></a>

            '; 
        } 
    ) 
);

require( '../../function/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details='', $table, $primaryKey, $columns, 'tbl_child_category.row_status = 1 ' )
);