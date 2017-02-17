<?php
	require_once('vendor/autoload.php');
	require_once('connect.php');
	$result = mysqli_query($conn,"select * from tbl_invoice where invoice_id = $_GET[id]");
    $row = mysqli_fetch_assoc($result);
 ?>
<?php
ob_start(); 
?> 
<style type="text/css">
td { 
    padding: 10px;
    text-align:left;
}
th { 
    padding: 10px;
    text-align:right;
}
.gross{
    //border-top:solid 1px;
}

.logo{
    text-align:center;
}

.table-div{
    border:solid 1px;
    width:auto;
}
.receipt-header{
    height:57px;
    background-color:#4286f4;
    color:white;
    font-style:bold;
    font-size:16pt;
    border:solid 1px;;
}
.text-block{
    margin-left:25px;
    margin-right:0px;
    margin-top:18px;
}

</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
<page_header> 
</page_header> 

<page_footer> 
</page_footer>

<div  class="logo">
    <img src="logo/logo.png" alt="logo"  width="100" height="100" >
</div><br><br>
<div class="receipt-header">
    <p class="text-block">PAYMENT RECEIPT</p>
</div>
<br><br>
<div class="table-div">
	<table border="0" cellspacing="0"  align="center" frame="box">
    <tr cellpadding="10">
        <th style="width:20%;cellpadding:10;"> Date  </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;cellpadding:10;"> <?= $row['date'] ?></td>
    </tr>
	<tr>
        <th style="width:20%;"> Order ID </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;"> <?= $row['order_number'] ?> </td>
    </tr>
    <tr>
        <th style="width:20%;"> Title </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;"> <?= $row['title'] ?> </td>
    </tr>
    <tr>
        <th style="width:20%;"> Number </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;"> <?= $row['recharge_number'] ?> </td>
    </tr>
    <tr>
        <th style="width:20%;"> Quantity </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;"> <?= $row['quantity'] ?>  </td>
    </tr>
    <tr>
        <th style="width:20%;"> Unit Price </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="width:20%;"> Rs.<?= $row['unit_price'] ?> </td>
    </tr>
    <tr>
        <th style="width:20%;"> Discount </th>
        <td style="width:5%"> <strong> : </strong> </td>
        <td style="color:green;width:20%;"> Rs.<?= $row['discount'] ?> </td>
    </tr>
    <tr style="border-top:solid 1px;" >
        <th style="color:black;width:20%;" class="gross"> Gross Total </th>
        <td style="width:5%" class="gross"> <strong> = </strong> </td>
        <td style="color:red;width:20%" class="gross"> Rs.<?= $row['gross_total'] ?> </td>
    </tr>

	</table>
    </div>
</page> 
<?php
		$content = ob_get_clean(); 
		$pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(10, 10, 10, 10)); 
		$pdf->writeHTML($content); 
		ob_end_clean();
		$pdf->Output('x.pdf',''); 
?>
