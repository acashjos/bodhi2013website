<?php
include 'simplexlsx.class.php';
$xlsx = new SimpleXLSX('emails.xlsx');
list($num_cols, $num_rows) = $xlsx->dimension();
$j=0;
foreach( $xlsx->rows() as $r )
{
for( $i=0; $i < $num_cols; $i=$num_cols )
{
if($j!=0){
echo $r[1].",<br>";
}
}
$j++;
}


