<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Fees_m extends MY_Model {



	protected $_table_name = 'invoice_items';

	protected $_primary_key = 'invoiceitemID';

	protected $_primary_filter = 'intval';

	protected $_order_by = "invoiceitemID desc";

	



	function __construct() {

		parent::__construct();

	}

	
	function insert_fees($array) {

		$error = parent::insert($array);

		return $error;

	}

	function insert_fees_invoice($array, $id){
		$error;
		foreach($array as $value){
			$data = array(
				'invoiceID' => $id,
				'feeID' => $value
			);

			$error += $this->insert_fees($data);
		}
		
		return $error;

	}

    
}

?>