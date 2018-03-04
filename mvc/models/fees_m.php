<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Invoice_m extends MY_Model {



	protected $_table_name = 'invoice_items';

	protected $_primary_key = 'invoiceitemID';

	protected $_primary_filter = 'intval';

	protected $_order_by = "invoiceitemID desc";

	



	function __construct() {

		parent::__construct();

    }

    
    
}

?>