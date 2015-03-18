<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE); 
class Invoices extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// index done by sunny for get invoices reports & get Clients
	$data="";
		$this->load->model('invoice_model');
		$data['clientQry']=$this->invoice_model->getClient();
		$this->load->view('invoice_report',$data);
	}

	public function reports()
	{
		// Reports done by sunny for get invoices from database
	$this->load->model('invoice_model');
	$relativedate = $this->input->post('relativedate');
	$selClient = $this->input->post('selClient');
	$data['productData'] = $this->invoice_model->getallProducts($selClient);
	$data['query']=$this->invoice_model->getallFromDate($relativedate,$selClient);
	$data['countdata']=mysql_num_rows($this->invoice_model->getallFromDate($relativedate,$selClient));
	//print_r($data['query']);
	//echo $relativedate;
	$this->load->view('invoice_records',$data);
	}
	public function getuser($id)
	{
		//	echo $id;
		$this->load->model('invoice_model');
		$data['datahtml'] = $this->invoice_model->getallProducts($id);
		echo 'Products :: <select id="selectProduct">';
		foreach($data['datahtml'] as $result):
		
		
				  echo '<option value="'.$result->product_id.'">"'.$result->product_description.'"</option>';

		
		
		endforeach;
						echo '</select>';

	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */