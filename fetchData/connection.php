<?php
$con  = mysqli_connect('localhost','root','','dickson');
if(mysqli_connect_errno())
{
    echo 'Database Connection Error';
    exit;
}
