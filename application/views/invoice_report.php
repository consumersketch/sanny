<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<meta charset="utf-8">
	<title>Invoice Report  // done by sunny</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<?php
//$attributes = array('class' => 'invoicefrm', 'id' => '');

//echo form_open('invoices/reports', $attributes);

?>
<script language="javascript">
$(document).ready(function(){   
 // done by sunny
    $("#btnReport").click(function()
    {  // done by sunny
		if(jQuery("select[name=relativedate]").val() == 0)
		{ // done by sunny
			alert("Please Select Relative Date");return false;
		}else{
		 // done by sunny
  		 $.ajax({
         type: "POST",
         url: "index.php/invoices/reports", 
         data: {relativedate: $("#relativedate").val(),
		 		selClient: $("#selClient").val()},
         dataType: "text",  
         cache:false,
         success: 
              function(data){
               // alert(data);  //as a debugging message.
			   document.getElementById('divReport').innerHTML =data;
              }
          });// you have missed this bracket
     return false;
	 }
	}
	);
	
 });
 function funcSend(str)
 {
 // done by sunny
   if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","index.php/invoices/getuser/"+str,true);
        xmlhttp.send();
}		
</script>
<form id="invoicefrm" method="post">
<div id="container">
	<h1>Invoice Report</h1>

	<div id="body">
	<p>
    		Relative Date 
            <select name="relativedate" id="relativedate">
            <option value="0">Select Date</option>
            <option value="LMTD">Last Month To Date</option>
            <option value="TM">This Month</option>
            <option value="TY">This Year</option>
            <option value="LY">Last Year</option>
            </select>
            <?php
		//	print_r($clientQry);
			?>
            Client 
           <select name="selClient" id="selClient" onChange="javascript:funcSend(this.value);">
		   <option value="">Select Client</option>
           <?php
		   foreach($clientQry as $Qryclient):
		   ?>
         <option value="<?php echo $Qryclient->client_id;?>"><?php echo $Qryclient->client_name;?></option>
           <?php
		   endforeach;
		   ?>
           </select>
    </p>
    <p>
    <input type="button" name="btnReport" id="btnReport" value="Submit"/>
    </p>		
	</div>
<div id="txtHint">

</div>
<div id="divReport">
</div>

</form>
</body>
</html>