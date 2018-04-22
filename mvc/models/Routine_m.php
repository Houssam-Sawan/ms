<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Routine_m extends MY_Model {



	protected $_table_name = 'routine';

	protected $_primary_key = 'routineID';

	protected $_primary_filter = 'intval';

	protected $_order_by = "classesID asc";

	protected $_order_by_start_time = "startTime_asc";



	function __construct() {

		parent::__construct();

	}



	function get_classes() {

		$this->db->select('*')->from('classes')->order_by('classes_numeric asc');

		$query = $this->db->get();

		return $query->result();

	}

	function get_start_times() {

		$this->db->select('*')->from('routine')->order_by('start_time');

		$query = $this->db->get();

		return $query->result();

	}



	function get_subject($id) {

		$query = $this->db->get_where('subject', array('classesID' => $id));

		return $query->result();

	}



	function get_join_all($id) {

		$this->db->select('*');

		$this->db->from('routine');

		$this->db->where(array('routine.classesID' => $id ));

		$this->db->join('teacher', 'teacher.teacherID = routine.teacherID', 'LEFT');

		$this->db->join('classes', 'classes.classesID = routine.classesID', 'LEFT');

		$this->db->join('section', 'section.sectionID = routine.sectionID', 'LEFT');

		$this->db->join('subject', 'subject.subjectID = routine.subjectID AND subject.classesID = routine.classesID', 'LEFT');

		$query = $this->db->get();

		return $query->result();

	}



	function get_join_all_wsection($id, $sectionID) {

		$this->db->select('*');

		$this->db->from('routine');

		$this->db->order_by('routine.start_time_sec', 'ASC');

		$this->db->order_by('routine.sectionID', 'ASC');

		$this->db->where(array('routine.classesID' => $id, 'routine.sectionID' => $sectionID));

		$this->db->join('teacher', 'teacher.teacherID = routine.teacherID', 'LEFT');

		$this->db->join('classes', 'classes.classesID = routine.classesID', 'LEFT');

		$this->db->join('section', 'section.sectionID = routine.sectionID', 'LEFT');

		$this->db->join('subject', 'subject.subjectID = routine.subjectID AND subject.classesID = routine.classesID', 'LEFT');



		$query = $this->db->get();

		return $query->result();

	}



	function get_routine($array=NULL, $signal=FALSE) {

		$query = parent::get($array, $signal);

		return $query;

	}



	function get_order_by_routine($array=NULL) {

		$query = parent::get_order_by($array);

		return $query;

	}


	function get_order_by_times($array=NULL) {

		$query = parent::get_order_by($array);

		return $query;

	}



	function insert_routine($array) {

		$error = parent::insert($array);

		return TRUE;

	}



	function update_routine($data, $id = NULL) {

		parent::update($data, $id);

		return $id;

	}



	public function delete_routine($id){

		parent::delete($id);

	}


	public function get_routine_old(){

		//$query = $this->db->get('routine_old');
		$query = $this->db->get_where('routine', array('start_time_sec' => 0));

		return $query->result();
	}

	//Helper function to convert time to seconds

	public function timetosecond($str_time = "00:00 AM")
	{
		//$str_time = "3:50 PM";

		sscanf($str_time, "%d:%d %s", $hours, $minutes, $mm);

		$hours = (($mm == "AM")? $hours :$hours+=12);

		$time_seconds =  ($hours * 3600 + $minutes * 60 ) ;

		//echo $hours;
		//echo $time_seconds;

		return $time_seconds;
	}

}



/* End of file routine_m.php */

/* Location: .//D/xampp/htdocs/school/mvc/models/routine_m.php */