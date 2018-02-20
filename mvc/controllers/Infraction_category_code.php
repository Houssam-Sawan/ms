<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction_category_code extends Admin_Controller {
/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
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
		$this->load->model("infraction_category_code_m");
		$this->load->model("infraction_category_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('infraction_category_code', $language);
	}

	public function index() {
		$this->data['infraction_category_codes'] = $this->infraction_category_code_m->get_join_infraction_category_code();
		$this->data["subview"] = "infraction_category_code/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'infraction_categoryID',
				'label' => $this->lang->line("infraction_category"),
				'rules' => 'trim|required|xss_clean|max_length[11]|callback_allcategory'
			),
			array(
				'field' => 'infraction_category_code',
				'label' => $this->lang->line("infraction_category_code"),
				'rules' => 'trim|max_length[200]|xss_clean|callback_unique_category_code'
			)
		);
		return $rules;
	}

	public function add() {
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/select2/css/select2.css',
				'assets/select2/css/select2-bootstrap.css'
			),
			'js' => array(
				'assets/select2/select2.js'
			)
		);
		$this->data["infraction_categories"] = $this->infraction_category_m->get_infraction_category();
		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "infraction_category_code/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				$array = array(
					"infraction_categoryID" => $this->input->post("infraction_categoryID"),
					"infraction_category_code" => $this->input->post("infraction_category_code")
				);
                $array['created_at'] = date("Y-m-d");
                $array['schoolyearID'] = $this->data['siteinfos']->school_year;

                $this->infraction_category_code_m->insert_infraction_category_code($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("infraction_category_code/index"));
			}
		} else {
			$this->data["subview"] = "infraction_category_code/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
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
		if((int)$id) {
			$this->data['infraction_category_code'] = $this->infraction_category_code_m->get_infraction_category_code($id);
            if($this->data["infraction_category_code"]) {
                $this->data["infraction_categories"] = $this->infraction_category_m->get_infraction_category();
                if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "infraction_category_code/edit";
						$this->load->view('_layout_main', $this->data);
					} else {
                        $array = array(
                            "infraction_categoryID" => $this->input->post("infraction_categoryID"),
                            "infraction_category_code" => $this->input->post("infraction_category_code")
                        );

						$this->infraction_category_code_m->update_infraction_category_code($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("infraction_category_code/index"));
					}
				} else {
					$this->data["subview"] = "infraction_category_code/edit";
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
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->infraction_category_code_m->delete_infraction_category_code($id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			redirect(base_url("infraction_category_code/index"));
		} else {
			redirect(base_url("infraction_category_code/index"));
		}
	}

	function unique_category_code(){
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$code = $this->infraction_category_code_m->get_order_by_infraction_category_code(array("infraction_category_code" => $this->input->post("infraction_category_code"), "infraction_categoryID" => $this->input->post("infraction_categoryID"), "infraction_category_codeID !=" => $id));
			if(count($code)) {
				$this->form_validation->set_message("unique_category_code", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$code = $this->infraction_category_code_m->get_order_by_infraction_category_code(array("infraction_category_code" => $this->input->post("infraction_category_code"), "infraction_categoryID" => $this->input->post("infraction_categoryID")));

			if(count($code)) {
				$this->form_validation->set_message("unique_category_code", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}

	function allcategory() {
		if($this->input->post('infraction_categoryID') == 0) {
			$this->form_validation->set_message("allcategory", "The %s field is required");
	     	return FALSE;
		}
		return TRUE;
	}
}

/* End of file infraction_category_code.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/infraction_category_code.php */