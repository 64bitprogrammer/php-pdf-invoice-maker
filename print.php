<!doctype html>
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
td.pad { 
    padding: 8px;
    text-align:center;
}
th.pad { 
    padding: 8px;
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

table{
    padding:0px;
    height:40%;   
}

#table0{
    border-top:0.5px;
    border-bottom:0.5px;
    width: 100%;
    padding:0px;
    
}
#table1{
    border:solid 0.5px;
    border-collapse:collapse;  
}
#table2{
    border-collapse:collapse; 
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

    <br>

	<div class="tables-block">
    <table cellspacing="0" id="table0"  style="padding:0px;">
    <tr>
        <td style="width:50%">
        <table  cellspacing="0" style="width:100%" align="left" id="table1">
        <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th class="pad" style="width:50%;text-align:left;"> Order ID: </th>
                <th class="pad" style="width:10%;text-align:center;">: </th>
                <td class="pad" style="width:40%;text-align:left;"> <?= $row['order_number'] ?> </td>

            </tr>
            <tr>
                <th class="pad" style="width:50%;text-align:left;"> Recharge Date: </th>
                <th class="pad" style="width:10%;text-align:center;">: </th>
                <td class="pad" style="width:40%;text-align:left;"> <?= $row['date'] ?> </td>
            </tr>
            <tr>
                <th class="pad" style="width:50%;text-align:left;"> Recharge No: </th>
                <th class="pad" style="width:10%;text-align:center;">: </th>
                <td class="pad" style="width:40%;text-align:left;"> <?= $row['recharge_number'] ?> </td>
            </tr>
            
        </table>
        </td>
        <td style="width:50%">
        <table  border="0.4px" cellspacing="0" style="width:100%" align="right" id="table2">
            <tr>
                <th class="pad" style="width:20%"> S.No </th>
                <th class="pad" style="width:50%"> Particulars </th>
                <th class="pad" style="width:30%"> Amount </th>
            </tr>
            <tr>
                <td class="pad" style="width:20%"> 1 </td>
                <td class="pad" style="width:50%"> Recharge Amt </td>
                <td class="pad" style="width:30%">Rs. <?=$row['unit_price']?> </td>
            </tr>
            <tr>
                <td class="pad" style="width:20%"> 2 </td>
                <td class="pad" style="width:50%"> Discount </td>
                <td class="pad" style="width:30%">Rs. -<?=$row['discount']?> </td>
            </tr>
            <tr>
                <td class="pad" style="width:70%;text-align:right;" colspan="2"> Total Amount</td>
                
                <td class="pad" style="width:30%;text-align:center;">Rs. <?= $row['gross_total'] ?> </td>
            </tr>
        </table>
        </td>
        </tr>
    </table>
    </div>
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
