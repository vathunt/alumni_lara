<?php
$table = 'tbl_alumni';
$primaryKey = 'id';
$no = 0;

$columns = array(
    array( 'db' => 'nim','dt' => 0 ),
    array( 'db' => 'nama_alumni','dt' => 1 ),
    array( 'db' => 'tmp_lahir','dt' => 2 ),
    array( 'db' => 'tgl_lahir', 'dt' => 3 ),
    array( 'db' => 'jenis_kelamin', 'dt' => 4 ),
    array( 'db' => 'alamat', 'dt' => 5 ),
    array( 'db' => 'id', 'dt' => 6 ),
);
 
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'db_alumni_lara',
    'host' => 'localhost'
);
require('ssp.class.php');
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);