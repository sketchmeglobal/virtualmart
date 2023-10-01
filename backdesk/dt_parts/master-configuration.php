<?php
$get_dt_data = json_decode(decode($_GET['data']));
$table = $get_dt_data['table'];
$primaryKey = 'p_cid';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes



require( '../../function/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details='', $table, $primaryKey, $get_dt_data['columns'] )
);