<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction_m extends MY_Model {

	protected $_table_name = 'infraction';
	protected $_primary_key = 'infractionID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "created_at desc";

	function __construct() {
		parent::__construct();
	}

	function join_get_infraction($classesID, $schoolyearID) {
		$this->db->select('*');
		$this->db->from('infraction');
		$this->db->join('student', 'student.studentID = infraction.studentID AND student.classesID = infraction.classesID', 'LEFT');
		$this->db->join('infraction_category', 'infraction.infraction_categoryID = infraction_category.infraction_categoryID', 'LEFT');
		$this->db->join('infraction_category_code', 'infraction.infraction_category_codeID = infraction_category_code.infraction_category_codeID', 'LEFT');
		$this->db->where('infraction.schoolyearID', $schoolyearID);
		$this->db->where('infraction.classesID', $classesID);
		$query = $this->db->get();
		return $query->result();
	}

	function join_get_infraction_by_student($id, $schoolyearID) {
		$this->db->select('*');
		$this->db->from('infraction');
		$this->db->join('student', 'student.studentID = infraction.studentID AND student.classesID = infraction.classesID', 'LEFT');
		$this->db->join('infraction_category', 'infraction.infraction_categoryID = infraction_category.infraction_categoryID', 'LEFT');
		$this->db->join('infraction_category_code', 'infraction.infraction_category_codeID = infraction_category_code.infraction_category_codeID', 'LEFT');
		$this->db->join('classes', 'infraction.classesID = classes.classesID', 'LEFT');
		$this->db->where('infraction.schoolyearID', $schoolyearID);
		$this->db->where('infraction.studentID', $id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_infraction($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_single_infraction($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_order_by_infraction($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function insert_infraction($array) {
		$id = parent::insert($array);
		return TRUE;
	}

	function update_infraction($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_infraction($id){
		parent::delete($id);
	}
}

/* End of file infraction_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/infraction_m.php */