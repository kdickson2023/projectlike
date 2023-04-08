<?php 

include('connection.php');

$query = "SELECT invoice_no FROM invoice_details ORDER BY invoice_no DESC";
$result = mysqli_query($con,$query);
$row = mysqli_fetch_array($result);
$lastid = $row['invoice_no'];
if(empty($lastid))
{
    $number = "E-0000001";
}
else
{
    $idd = str_replace("E-", "", $lastid);
    $id = str_pad($idd + 1, 7, 0, STR_PAD_LEFT);
    $number = 'E-'.$id;
}


 ?>