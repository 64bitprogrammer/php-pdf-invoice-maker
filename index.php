<?php
require_once('connect.php');
$result = mysqli_query($conn,"select * from tbl_invoice");

$table = "<table border=\"1\" cellspacing=\"0\" cellpadding=\"5\">
            <tr>
                <th> Order No </th>
                <th> Date </th>
                <th> Number </th>
                <th> Quantity </th>
                <th> Unit Price </th>
                <th> Discount </th>
                <th> Gross_Total </th>
                <th> Generate Invoce </th>
            </tr>";

while($row = mysqli_fetch_assoc($result)){
    $table.= "<tr>
                <td> $row[order_number] </td>
                <td> $row[date] </td>
                <td> $row[recharge_number] </td>
                <td> $row[quantity] </td>
                <td> $row[unit_price] </td>
                <td> $row[discount] </td>
                <td> $row[gross_total]</td>
                <td> <a target='_blank' href='print.php?id=$row[invoice_id]' >Print</a> </td>
            </tr>";
}

$table .= "</table>";

echo $table;

?>