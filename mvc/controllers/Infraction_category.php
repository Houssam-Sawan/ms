<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infraction_category extends Admin_Controller {
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
		$this->load->model("infraction_category_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('infraction_category', $language);
	}

	public function index() {
        $this->data['infraction_categories'] = $this->infraction_category_m->get_infraction_category();
        $this->data["subview"] = "infraction_category/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'infraction_category',
				'label' => $this->lang->line("infraction_category_name"),
				'rules' => 'trim|required|xss_clean|callback_unique_infraction_category'
			),
			array(
				'field' => 'note', 
				'label' => $this->lang->line("infraction_category_note"),
				'rules' => 'trim|max_length[200]|xss_clean'
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
		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "infraction_category/add";
				$this->load->view('_layout_main', $this->data);			
			} else {
				$array = array(
					"infraction_category" => $this->input->post("infraction_category"),
					"note" => $this->input->post("note")
				);
                $array['created_at'] = date("Y-m-d");
                $array['schoolyearID'] = $this->data['siteinfos']->school_year;

				$this->infraction_category_m->insert_infraction_category($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("infraction_category/index"));
			}
		} else {
			$this->data["subview"] = "infraction_category/add";
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
			$this->data['infraction_category'] = $this->infraction_category_m->get_infraction_category($id);
			if($this->data["infraction_category"]) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "infraction_category/edit";
						$this->load->view('_layout_main', $this->data);			
					} else {
                        $array = array(
                            "infraction_category" => $this->input->post("infraction_category"),
                            "note" => $this->input->post("note")
                        );

						$this->infraction_category_m->update_infraction_category($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("infraction_category/index"));
					}
				} else {
					$this->data["subview"] = "infraction_category/edit";
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
			$this->infraction_category_m->delete_infraction_category($id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			redirect(base_url("infraction_category/index"));
		} else {
			redirect(base_url("infraction_category/index"));
		}	
	}

	function unique_infraction_category(){
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$category = $this->infraction_category_m->get_order_by_infraction_category(array("infraction_category" => $this->input->post("infraction_category"), "infraction_categoryID !=" => $id));
			if(count($category)) {
				$this->form_validation->set_message("unique_infraction_category", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$category = $this->infraction_category_m->get_order_by_infraction_category(array("infraction_category" => $this->input->post("infraction_category")));

			if(count($category)) {
				$this->form_validation->set_message("unique_infraction_category", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}	
	}
}

/* End of file infraction_category.php */
/* Location: .//D/xampp/htdocs/school/mvc/controllers/infraction_category.php */