<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM Express
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	function __construct() {
		parent::__construct();
		$this->load->model("infraction_m");
		$this->load->model("infraction_category_m");
		$this->load->model("infraction_category_code_m");
		$this->load->model("student_m");
		$this->load->model("student_info_m");
		$this->load->model("parents_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('infraction', $language);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'infraction_categoryID',
				'label' => $this->lang->line("infraction_categoryID"),
				'rules' => 'trim|required|xss_clean'
			), 
			array(
				'field' => 'infraction_category_codeID',
				'label' => $this->lang->line("infraction_category_codeID"),
				'rules' => 'trim|required|xss_clean'
			), 
			array(
				'field' => 'classesID',
				'label' => $this->lang->line("classesID"),
				'rules' => 'trim|required|xss_clean'
			),
            array(
				'field' => 'studentID',
				'label' => $this->lang->line("studentID"),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'infraction_created_at',
				'label' => $this->lang->line("infraction_created_at"),
				'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid'
			)
		);
		return $rules;
	}

	public function index() {
		$usertypeID = $this->session->userdata('usertypeID');
		if($usertypeID == 3) {
			$this->data['headerassets'] = array(
				'css' => array(
					'assets/select2/css/select2.css',
					'assets/select2/css/select2-bootstrap.css'
				),
				'js' => array(
					'assets/select2/select2.js'
				)
			);
			
			$schoolyearID = $this->session->userdata('defaultschoolyearID');
            $student = $this->student_info_m->get_student_info();
            if(count($student)) {
				$id = $student->studentID;
				$this->data['set'] = $id;
				$this->data['infractions'] = $this->infraction_m->join_get_infraction_by_student($id, $schoolyearID);
				$this->data["subview"] = "infraction/index_parents";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} elseif($usertypeID == 4) {
			$this->data['headerassets'] = array(
				'css' => array(
					'assets/select2/css/select2.css',
					'assets/select2/css/select2-bootstrap.css'
				),
				'js' => array(
					'assets/select2/select2.js'
				)
			);
			$schoolyearID = $this->session->userdata('defaultschoolyearID');
			$username = $this->session->userdata("username");
            $parent = $this->parents_m->get_single_parents(array('username' => $username));
            $this->data['students'] = $this->student_m->get_order_by_student(array('parentID' => $parent->parentsID, 'schoolyearID' => $schoolyearID));
            $id = htmlentities(escapeString($this->uri->segment(3)));
			if((int)$id) {
				$checkstudent = $this->student_m->get_single_student(array('studentID' => $id));
				if(count($checkstudent)) {
					$classesID = $checkstudent->classesID;
					$this->data['set'] = $id;
					$this->data['infractions'] = $this->infraction_m->join_get_infraction_by_student($classesID, $schoolyearID);
					$this->data["subview"] = "infraction/index_parents";
					$this->load->view('_layout_main', $this->data);
				} else {
					$this->data["subview"] = "error";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data['set'] = $id;
				$this->data['infractions'] = array();
				$this->data["subview"] = "infraction/index_parents";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data['headerassets'] = array(
				'css' => array(
					'assets/select2/css/select2.css',
					'assets/select2/css/select2-bootstrap.css'
				),
				'js' => array(
					'assets/select2/select2.js'
				)
			);

			$id = htmlentities(escapeString($this->uri->segment(3)));
			$this->data['classes'] = $this->classes_m->get_classes();
			if((int)$id) {
				$this->data['set'] = $id;
				$students = $this->student_m->get_order_by_student(array('classesID' => $id));
				$this->data['students'] = pluck($students, 'student', 'studentID');
				$schoolyearID = $this->session->userdata('defaultschoolyearID');
                $this->data['infractions'] = $this->infraction_m->join_get_infraction($id, $schoolyearID);
				$this->data["subview"] = "infraction/index";
				$this->load->view('_layout_main', $this->data);
			} else {
				$this->data['set'] = 0;
				$this->data['infractions'] = array();
				$this->data["subview"] = "infraction/index";
				$this->load->view('_layout_main', $this->data);
			}
		}
		
	}

	public function add() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/datepicker/datepicker.css',
				'assets/select2/css/select2.css',
				'assets/select2/css/select2-bootstrap.css'
			),
			'js' => array(
				'assets/datepicker/datepicker.js',
				'assets/select2/select2.js'
			)
		);

		$this->data['classes'] = $this->classes_m->get_classes();
        $this->data['infraction_categories'] = $this->infraction_category_m->get_infraction_category();
		$classesID = $this->input->post("classesID");
		
		if($classesID != 0) {
			$this->data['students'] = $this->student_m->get_order_by_student(array('classesID' => $classesID));
			$this->data['students'] = $this->student_m->get_order_by_student(array("classesID" => $classesID));
		} else {
			$this->data['students'] = array();
			$this->data['students'] = array();
		}

		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "infraction/add";
				$this->load->view('_layout_main', $this->data);			
			} else {
				$array = array(
					"infraction_categoryID" => $this->input->post("infraction_categoryID"),
					"infraction_category_codeID" => $this->input->post("infraction_category_codeID"),
					"infraction_created_at" => date("Y-m-d", strtotime($this->input->post("infraction_created_at"))),
					'studentID' => $this->input->post('studentID'),
					'classesID' => $this->input->post('classesID'),
					"schoolyearID" => $this->data['siteinfos']->school_year
				);

				$this->infraction_m->insert_infraction($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("infraction/index"));
			}
		} else {
			$this->data["subview"] = "infraction/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/datepicker/datepicker.css',
				'assets/select2/css/select2.css',
				'assets/select2/css/select2-bootstrap.css'
			),
			'js' => array(
				'assets/datepicker/datepicker.js',
				'assets/select2/select2.js'
			)
		);

		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$url = htmlentities(escapeString($this->uri->segment(4)));
		if((int)$id && (int)$url) {
			$this->data['classes'] = $this->classes_m->get_classes();
            $this->data['infraction'] = $this->infraction_m->get_single_infraction(array('infractionID' => $id, 'schoolyearID' => $schoolyearID));
            $this->data['infraction_categories'] = $this->infraction_category_m->get_infraction_category();
            $this->data['infraction_category_codes'] = $this->infraction_category_code_m->get_order_by_infraction_category_code(array("infraction_categoryID"=> $this->data['infraction']->infraction_categoryID));

			if($this->data['infraction']) {
				$this->data['studentID'] = json_decode($this->data['infraction']->studentID);

				if($this->input->post('classesID')) {
					$classesID = $this->input->post('classesID');
				} else {
					$classesID = $this->data['infraction']->classesID;
				}
				$this->data['students'] = $this->student_m->get_order_by_student(array("classesID" => $classesID));

				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "infraction/edit";
						$this->load->view('_layout_main', $this->data);
					} else {
                        $array = array(
                            "infraction_categoryID" => $this->input->post("infraction_categoryID"),
                            "infraction_category_codeID" => $this->input->post("infraction_category_codeID"),
                            "infraction_created_at" => date("Y-m-d", strtotime($this->input->post("infraction_created_at"))),
                            'studentID' => $this->input->post('studentID'),
                            'classesID' => $this->input->post('classesID'),
                            "schoolyearID" => $this->data['siteinfos']->school_year
                        );

						$this->infraction_m->update_infraction($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("infraction/index/$url"));
					}
				} else {
					$this->data["subview"] = "infraction/edit";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$schoolyearID = $this->session->userdata('defaultschoolyearID');
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$url = htmlentities(escapeString($this->uri->segment(4)));
		if((int)$id && (int)$url) {
			$infraction = $this->infraction_m->get_single_infraction(array('infractionID' => $id, 'schoolyearID' => $schoolyearID));
			if(count($infraction)) {
				$this->infraction_m->delete_infraction($id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("infraction/index/$url"));
			} else {
				redirect(base_url("infraction/index"));
			}
		} else {
			redirect(base_url("infraction/index"));
		}
	}

	function date_valid($date) {
		if(strlen($date) <10) {
			$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     	return FALSE;
		} else {
	   		$arr = explode("-", $date);
	        $dd = $arr[0];
	        $mm = $arr[1];
	        $yyyy = $arr[2];
	      	if(checkdate($mm, $dd, $yyyy)) {
	      		return TRUE;
	      	} else {
	      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
	     		return FALSE;
	      	}
	    }
	}

	function studentCall() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$allstudent = $this->student_m->get_order_by_student(array("classesID" => $classID));
			foreach ($allstudent as $value) {
				echo "<option value=\"$value->studentID\">",$value->name,"</option>";
			}
		}
	}

	function infraction_category_code_call() {
		$infraction_categoryID = $this->input->post('id');
		if((int)$infraction_categoryID) {
			$allCategoryCode = $this->infraction_category_code_m->get_order_by_infraction_category_code(array("infraction_categoryID" => $infraction_categoryID));
			foreach ($allCategoryCode as $value) {
				echo "<option value=\"$value->infraction_category_codeID\">",$value->infraction_category_code,"</option>";
			}
		}
	}

	public function infraction_list() {
		$classID = $this->input->post('id');
		if((int)$classID) {
			$string = base_url("infraction/index/$classID");
			echo $string;
		} else {
			redirect(base_url("infraction/index"));
		}
	}
}

/* End of file class.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/class.php */