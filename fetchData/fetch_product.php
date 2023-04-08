<?php


$table = <<<EOT
 (
    SELECT p.pid, p.product_name, p.product_stock, p.product_price, p.product_cost, c.category_name, p.expire_date, p.pro_date FROM products p INNER JOIN categories c ON p.cid = c.cid

 ) temp
EOT;

$primaryKey = 'pid';

$columns = array(
   array( 'db' => 'pid',          'dt' => 0 ),
   array( 'db' => 'product_name',        'dt' => 1 ),
   array( 'db' => 'product_stock',    'dt' => 2 ),
   array( 'db' => 'product_price',    'dt' => 3 ),
   array( 'db' => 'product_cost',    'dt' => 4 ),
   array( 'db' => 'category_name',    'dt' => 5 ),
   array( 'db' => 'expire_date',    'dt' => 6 ),
);

$sql_details = array(
   'user' => 'root',
   'pass' => '',
   'db'   => 'dickson',
   'host' => 'localhost'
);

//require( 'ssp.class.php' );
require('ssp.php');
echo json_encode(
   SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);