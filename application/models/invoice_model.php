<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invoice_model extends CI_Model
{

  function getallFromDate($DateSelection,$selClient)
  {
  // getallFromDate done by sunny for get all from date selection & client selection
  		//echo $DateSelection."--".$selClient;
       $this->load->database();
		if($DateSelection=='TM')
		{
			$whereAs =  " AND MONTH(i.invoice_date) = MONTH(CURRENT_DATE) AND  YEAR(i.invoice_date) = YEAR(CURRENT_DATE)";
		}
		else if($DateSelection == 'LMTD')
		{
			$whereAs =  " AND (year(i.invoice_date) = year(CURDATE() - INTERVAL 1 MONTH) and month(i.invoice_date) = month(CURDATE() - INTERVAL 1 MONTH) OR (year(i.invoice_date) = year(CURDATE()) and month(i.invoice_date) = month(CURDATE()))) ";
		}
		else if($DateSelection == 'TY')
		{
			$whereAs =  "  AND  YEAR(i.invoice_date) = YEAR(CURRENT_DATE) ";
		}
		else if($DateSelection == 'LY')
		{
				$whereAs =  "  AND  YEAR(i.invoice_date) = YEAR(CURDATE() - INTERVAL 1 YEAR) ";
		}
		if($selClient != "")
		{
			$whereClient = " AND c.client_id = '".$selClient."' ";
		}
		 $sql =  "SELECT i.*,ii.*,c.*,p.* FROM invoices i, invoicelineitems ii, clients c, products p  WHERE ii.invoice_num = i.invoice_num AND c.client_id = i.client_id  AND p.product_id = ii.product_id AND p.client_id = i.client_id ".$whereAs." ".$whereClient." ";	
		$result = mysql_query($sql);   
      // $query=$this->db->get('invoices');//employee is a table in the database
	  // print_r($query->result());
       return $result;
  }
  function getClient()
  {
   // getClient done by sunny for get all from client selection
   $this->load->database(); 
  	$query=$this->db->get('clients');//employee is a table in the database
	 return $query->result();
  }
  function getallProducts($clients)
  {
    // getallProducts done by sunny for get products from clients
   $this->load->database(); 
   $this->db->where('client_id ', $clients);
  	$query=$this->db->get('products');//employee is a table in the database
	
	 return $query->result();
  }
}