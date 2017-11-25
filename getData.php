<?php

include 'config.php';

$min = $_POST['min'];
$max = $_POST['max'];

$query = 'select * from employee where salary>='.$min.' and salary<='.$max;
$result = mysql_query($query);

$html = '';
while( $row=mysql_fetch_array($result) ){
    $emp_name = $row['emp_name'];
    $email = $row['email'];
    $salary = $row['salary'];
    $city = $row['city'];

    $html .='<tr>';
    $html .='<td>'.$emp_name.'</td>';
    $html .='<td>'.$email.'</td>';
    $html .='<td>'.$salary.'</td>';
    $html .='<td>'.$city.'</td>';
    $html .='</tr>';
}

echo $html;