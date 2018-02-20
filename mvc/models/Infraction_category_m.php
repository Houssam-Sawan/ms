<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction_category_m extends MY_Model {

	protected $_table_name = 'infraction_category';
	protected $_primary_key = 'infraction_categoryID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "infraction_categoryID desc";

	function __construct() {
		parent::__construct();
	}

	function get_infraction_category($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_infraction_category($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_infraction_category($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_infraction_category($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_infraction_category($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_infraction_category($id){
		parent::delete($id);
	}
}

/* End of file infraction_category_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/infraction_category_m.php */