<?php include('connection.php');

$sql = "SELECT * FROM categories ";
$query = mysqli_query($con,$sql);
$total_all_rows = mysqli_num_rows($query);

if(isset($_POST['search']['value']))
{
	$search_value = $_POST['search']['value'];
	$sql .= " WHERE category_name like '%".$search_value."%'";

}

if(isset($_POST['order']))
{
	$column_name = $_POST['order'][0]['column'];
	$order = $_POST['order'][0]['dir'];
	$sql .= " ORDER BY ".$columns[$column_name]." ".$order."";
}
else
{
	$sql .= " ORDER BY cid desc";
}

if($_POST['length'] != -1)
{
	$start = $_POST['start'];
	$length = $_POST['length'];
	$sql .= " LIMIT  ".$start.", ".$length;
}	


$data = array();
$run_query = mysqli_query($con,$sql);
$count_rows = mysqli_num_rows($run_query);

while($row = mysqli_fetch_assoc($run_query))
{
	$sub_array = array();
	$sub_array[] = $row['cid'];
	$sub_array[] = $row['category_name'];
	$sub_array[] = $row['status'];
	$sub_array[] = '<a href="javascript:void();" class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
	$data[] = $sub_array;
}

$output = array(

	'data'=>$data,
	'draw'=> intval($_POST['draw']),
	'recordsTotal' =>$count_rows,
	'recordsFiltered'=> $total_all_rows,
	
);
echo  json_encode($output);