 <?php
 // done by sunny
 //print_r($productData);
// if(count($productData)>0):
/*
Products: <select id="selectProduct">
 <?php
	foreach($productData as $Dataproduct):
 ?>
 <option value="<?php echo $Dataproduct->product_id;?>"><?php echo $Dataproduct->product_description;?></option>
 <?php
 	endforeach;
?>
</select>
*/
 ?>

<?php
 //endif;
 ?><br clear="all"><br clear="all">
  <table width="90%" border="1" style=" border:#666666 dotted;">
  <tr>
    <td>Invoice Num</td>
    <td>Invoice Date</td>
    <td>Product</td>
    <td>Qty</td>
    <td>Price</td>
    <td>Total</td>
  </tr>
 <?php
 
//$rowsCount= mysql_num_rows(mysql_fetch_array($query));
 // done by sunny countdata & display listing of the main frame invoices
 
	if($countdata>0)
	{
		while($row = mysql_fetch_array($query))
		{
	//	print_r($row);
 ?>
  <tr>
    <td><?php echo $row['invoice_num'];?></td>
    <td><?php echo $row['invoice_date'];?></td>
    <td><?php echo $row['product_description'];?></td>
    <td><?php echo $row['qty'];?></td>
    <td><?php echo $row['price'];?></td>
    <td><?php $total = $row['qty']*$row['price'];
			echo number_format($total,2);
	?></td>
  </tr>
 <?php
 		}
	
 ?>
 
 <?php	
 }	else{
 ?> 
 <tr>
    <td colspan="6">No Record(s) Found.</td>
  </tr>
 <?php
 }
 ?>
</table>

 