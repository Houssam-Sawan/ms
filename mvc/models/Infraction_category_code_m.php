<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction_category_code_m extends MY_Model {

	protected $_table_name = 'infraction_category_code';
	protected $_primary_key = 'infraction_category_codeID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "infraction_categoryID asc";

	function __construct() {
		parent::__construct();
	}

	function get_join_infraction_category_code() {
		$this->db->select('*');
		$this->db->from('infraction_category_code');
		$this->db->join('infraction_category', 'infraction_category_code.infraction_categoryID = infraction_category.infraction_categoryID', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	function get_infraction_category_code($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_infraction_category_code($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_infraction_category_code($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_infraction_category_code($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_infraction_category_code($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_infraction_category_code($id){
		parent::delete($id);
	}
}

/* End of file infraction_category_code_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/infraction_category_code_m.php */