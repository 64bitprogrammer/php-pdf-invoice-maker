<?php
	require_once('vendor/autoload.php');
	require_once('connect.php');
	$result = mysqli_query($conn,"select * from tbl_invoice where invoice_id = $_GET[id]");
    $row = mysqli_fetch_assoc($result);

    // Constants
    $email = "example@example.com";
    $logo_path = "logo/logo.png";
    $address = "Intecons Software Labs, Bangalore.";

 ?>
<?php
ob_start(); 
?> 
<style type="text/css">
td { 
    padding: 10px;
    text-align:center;
}
th { 
    padding: 10px;
    text-align:center;
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
    //background-color:#4286f4;
    background-color:#108796;
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
.help-text{
    font-size: 11pt;
}



</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm"> 
<page_header> 
</page_header> 

<page_footer> 
</page_footer>
<br>
<div  class="logo">
    <img src="<?=$logo_path?>" alt="logo"  width="100" height="100" >
</div><br><br><Br>
<div class="receipt-header">
    <p class="text-block">PAYMENT RECEIPT</p>
</div>
<br><br>
    <p class="help-text">
       Date: <?= $row['date'] ?>
    </p>
    <br>

	<table align="center" style="width:100%;" border="0.5" cellspacing="0">
    <tr class="header-">
        <th style="width:15%;"> Order.No. </th>
        <th style="width:29%;"> Recharged Number </th>
        <th style="width:15%;"> Quantity </th>
        <th style="width:11%;"> Price </th>
        <th style="width:15%;"> Discount </th>
        <th style="width:15%;"> Sub-Total </th>
    </tr>
    <tr>
        <td style="width:15%;"> <?= $row['order_number']?> </td>
        <td style="width:29%;"> <?= $row['recharge_number'] ?> </td>
        <td style="width:15%;"> <?= $row['quantity'] ?> </td>
        <td style="width:11%;"> <?= $row['unit_price'] ?> </td>
        <td style="width:15%;"> <?= $row['discount'] ?> </td>
        <td style="width:15%;"> <?= $row['gross_total'] ?> </td>
    </tr>
    <tr>
        <th colspan="5" style="text-align:right;"> Total </th>
        <th> <?= $row['gross_total'] ?> </th>
    </tr>

	</table>
    <br><br>
    <div class="help-text">
        <p>
           Contact: <?= $email ?>
        </p>
        <p>
            Address: <?=$address ?>
        </p>
    </div>

</page> 
<?php
		$content = ob_get_clean(); 
		$pdf = new HTML2PDF('P','A4','en', false, 'ISO-8859-15', array(10, 10, 10, 10)); 
		$pdf->writeHTML($content); 
		ob_end_clean();
		$pdf->Output('x.pdf',''); 
?>
