<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'email.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'assets/vendor/autoload.php';
class D_superadmin extends CI_Controller 
{
    public function index() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth/errors_403');
		} else {

            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => "Dashboard",
            );

            $data['total_sampler'] = $this->web->get_count('sampler');
            $data['total_institution'] = $this->web->get_count('institution');
            $data['total_coa'] = count($this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result());
            $data['total_quotation'] = $this->web->get_count('sk_number');

            //chart quotation
            $today = date('Y-m-d');
            $yesterday = date('Y-m-d', strtotime(date('Y-m-d') .' -1 day'));
            $yesterday2 = date('Y-m-d', strtotime(date('Y-m-d') .' -2 day'));
            $yesterday3 = date('Y-m-d', strtotime(date('Y-m-d') .' -3 day'));
            $yesterday4 = date('Y-m-d', strtotime(date('Y-m-d') .' -4 day'));
            $yesterday5 = date('Y-m-d', strtotime(date('Y-m-d') .' -5 day'));
            $yesterday6 = date('Y-m-d', strtotime(date('Y-m-d') .' -6 day'));
            $data['today'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$today'")->result_array();
            $data['yesterday'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday'")->result_array();
            $data['yesterday2'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday2'")->result_array();
            $data['yesterday3'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday3'")->result_array();
            $data['yesterday4'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday4'")->result_array();
            $data['yesterday5'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday5'")->result_array();
            $data['yesterday6'] = $this->db->query("SELECT count(*) FROM sk_number WHERE date_quotation = '$yesterday6'")->result_array();
            //end chart quotation
            
            $data['total_qtn'] = $this->db->query("SELECT count(*) FROM sk_number")->result_array();
            $data['approve'] = $this->db->query("SELECT count(*) FROM sk_number WHERE status_approve = 1")->result_array();
            $data['nonapprove'] = $this->db->query("SELECT count(*) FROM sk_number WHERE status_approve = 0")->result_array();

            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/index');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function data_analysis()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Analysis',
            );

            $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_dataanalysis');
            $this->load->view('superadmin/_layout/footer');
        }   
    }

    public function add_analysis()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_analysis();
            if($this->form_validation->run() == FALSE) {
                $this->data_analysis();
            } else {

                $data = array(
                    'name_analysis' => $this->input->post('name_analysis'),
                    'alias_analysis' => $this->input->post('alias_analysis'),
                    'standart_price' => $this->input->post('standart_price'),
                    'coa' => $this->input->post('coa'),
                );

                $this->web->insert_data($data, 'analysis');
                $this->session->set_flashdata('msg', 'Data Analysis success added.');
                redirect('D_superadmin/data_analysis');
            }
        }
    }

    public function _rules_analysis()
    {
        $this->form_validation->set_rules('name_analysis', 'Name Analysis', 'required');
        $this->form_validation->set_rules('alias_analysis', 'Alias Analysis', 'required');
        $this->form_validation->set_rules('standart_price', 'Standart Price', 'required');
        $this->form_validation->set_rules('coa', 'COA', 'required');
    }

    public function delete_analysis($id)
	{
        $where = array('id_analysis' => $id);
		$this->web->delete_data($where, 'analysis');
        $this->session->set_flashdata('msg', 'Data Analysis success deleted.');
		redirect('D_superadmin/data_analysis');
	}

    public function update_analysis($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_analysis' => $id);
        $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_dataanalysis', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_analysis_action()
    {
        $this->_rules_analysis();
        if ($this->form_validation->run() == FALSE) {
            $this->update_analysis($this->input->post('id_analysis'));
        } else {

        $data = array(
            'name_analysis' => $this->input->post('name_analysis'),
            'alias_analysis' => $this->input->post('alias_analysis'),
            'standart_price' => $this->input->post('standart_price'),
            'coa' => $this->input->post('coa'),
        );

        $where = array(
            'id_analysis' => $this->input->post('id_analysis')
        );
        $this->web->update_data('analysis', $data, $where);
        $this->session->set_flashdata('msg', 'Data analysis success changed!');
        redirect('D_superadmin/data_analysis');
		}
    }

    public function data_int()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Institution',
        );
        $data['institution'] = $this->web->get_data('institution', 'id_int')->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datainstitution');
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_int()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_int();
            if($this->form_validation->run() == FALSE) {
                $this->data_int();
            } else {

                $data = array(
                    'name_int' => $this->input->post('name_int'),
                    'int_phone' => $this->input->post('int_phone'),
                    'int_email' => $this->input->post('int_email'),
                    'int_address' => $this->input->post('int_address'),
                    'name_cp' => $this->input->post('name_cp'),
                    'title_cp' => $this->input->post('title_cp'),
                );

                $this->web->insert_data($data, 'institution');
                $this->session->set_flashdata('int', 'Data institution success added.');
                redirect('D_superadmin/data_int');
            }
        }
    }

    

    public function delete_int($id)
	{
        $where = array('id_int' => $id);
		$this->web->delete_data($where, 'institution');
        $this->session->set_flashdata('int', 'Data institution success deleted.');
		redirect('D_superadmin/data_int');
	}

    public function update_int($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_int' => $id);
        $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data institution',
        );
        $data['institution'] = $this->web->get_data('institution', 'id_int')->result();
        $data['specialInt'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datainstitution', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_int_action()
    {
        $this->_rules_int();
        if ($this->form_validation->run() == FALSE) {
            $this->update_int($this->input->post('id_int'));
        } else {

        $data = array(
            'name_int' => $this->input->post('name_int'),
            'int_phone' => $this->input->post('int_phone'),
            'int_email' => $this->input->post('int_email'),
            'int_address' => $this->input->post('int_address'),
            'name_cp' => $this->input->post('name_cp'),
            'title_cp' => $this->input->post('title_cp'),
        );

        $where = array(
            'id_int' => $this->input->post('id_int')
        );
        $this->web->update_data('institution', $data, $where);
        $this->session->set_flashdata('int', 'Data Institution success changed!');
        redirect('D_superadmin/data_int');
		}
    }

    public function _rules_int()
    {
        $this->form_validation->set_rules('name_int', 'Name Institution', 'required');
        $this->form_validation->set_rules('int_address', 'Address institution', 'required');
        $this->form_validation->set_rules('name_cp', 'Name Contact Person', 'required');
        $this->form_validation->set_rules('title_cp', 'Position Contact Person', 'required');
    }

    public function data_sampler()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Sampler',
        );
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datasampler');
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_sampler()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->_rules_sampler();
        if($this->form_validation->run() == FALSE) {
            $this->data_sampler();
        } else {

            $data = array(
                'name_smp' => $this->input->post('name_smp'),
                'gender_smp' => $this->input->post('gender_smp'),
                'phone_smp' => $this->input->post('phone_smp'),
                'email_smp' => $this->input->post('email_smp'),
            );

            $this->web->insert_data($data, 'sampler');
            $this->session->set_flashdata('msg', 'Data sampler success added.');
            redirect('D_superadmin/data_sampler');
        }
    }
    }

    public function _rules_sampler()
    {
        $this->form_validation->set_rules('name_smp', 'Name Sampler', 'required');
        $this->form_validation->set_rules('gender_smp', 'Gender Sampler', 'required');
        $this->form_validation->set_rules('phone_smp', 'Phone Sampler', 'required');
        $this->form_validation->set_rules('email_smp', 'Email Sampler', 'required');
    }

    public function delete_sampler($id)
	{
        $where = array('id_sampler' => $id);
		$this->web->delete_data($where, 'sampler');
        $this->session->set_flashdata('msg', 'Data sampler success deleted.');
		redirect('D_superadmin/data_sampler');
	}

    public function update_sampler($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_sampler' => $id);
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Sampler',
        );
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['specialSampler'] = $this->db->query("SELECT * FROM sampler WHERE id_sampler = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datasampler', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_sampler_action()
    {
        $this->_rules_sampler();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sampler($this->input->post('id_sampler'));
        } else {

        $data = array(
            'name_smp' => $this->input->post('name_smp'),
            'gender_smp' => $this->input->post('gender_smp'),
            'phone_smp' => $this->input->post('phone_smp'),
            'email_smp' => $this->input->post('email_smp')
        );

        $where = array(
            'id_sampler' => $this->input->post('id_sampler')
        );
        $this->web->update_data('sampler', $data, $where);
        $this->session->set_flashdata('msg', 'Data sampler success changed!');
        redirect('D_superadmin/data_sampler');
		}
    }

    public function data_sample()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data sample',
        );
        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datasample');
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_sample()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_sample();
            if($this->form_validation->run() == FALSE) {
                $this->data_sample();
            } else {

                $data = array(
                    'name_sample' => $this->input->post('name_sample'),
                );

                $this->web->insert_data($data, 'sample');
                $this->session->set_flashdata('msg', 'Data Sample success added.');
                redirect('D_superadmin/data_sample');
            }
        }
    }

    public function _rules_sample()
    {
        $this->form_validation->set_rules('name_sample', 'Name Sample', 'required');
    }

    public function delete_sample($id)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_sample' => $id);
		$this->web->delete_data($where, 'sample');
        $this->session->set_flashdata('msg', 'Data sample success deleted.');
		redirect('D_superadmin/data_sample');
        }
	}

    public function update_sample($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {

        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data sample',
        );

        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $data['specialSample'] = $this->db->query("SELECT * FROM sample WHERE id_sample = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datasample');
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_sample_action()
    {
        $this->_rules_sample();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sample($this->input->post('id_sample'));
        } else {

        $data = array(
            'name_sample' => $this->input->post('name_sample')
        );

        $where = array(
            'id_sample' => $this->input->post('id_sample')
        );
        $this->web->update_data('sample', $data, $where);
        $this->session->set_flashdata('msg', 'Data sample success changed!');
        redirect('D_superadmin/data_sample');
		}
    }

    public function data_regulation()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Method',
            );
            $data['regulation'] = $this->web->get_data('regulation', 'id_regulation')->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_dataregulation');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_regulation()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_regulation();
            if($this->form_validation->run() == FALSE) {
                $this->data_regulation();
            } else {

                $data = array(
                    'name_regulation' => $this->input->post('name_regulation'),
                );

                $this->web->insert_data($data, 'regulation');
                $this->session->set_flashdata('msg', 'Data regulation success added.');
                redirect('D_superadmin/data_regulation');
            }
        }
    }

    public function _rules_regulation()
    {
        $this->form_validation->set_rules('name_regulation', 'Name Regulation', 'required');
    }

    public function update_regulation($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $where = array('id_regulation' => $id);
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Regulation',
            );
            $data['regulation'] = $this->web->get_data('regulation', 'id_regulation')->result();
            $data['specialregulation'] = $this->db->query("SELECT * FROM regulation WHERE id_regulation = '$id'")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_dataregulation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_regulation_action()
    {
        $this->_rules_regulation();
        if ($this->form_validation->run() == FALSE) {
            $this->update_regulation($this->input->post('id_regulation'));
        } else {

        $data = array(
            'name_regulation' => $this->input->post('name_regulation')
        );

        $where = array(
            'id_regulation' => $this->input->post('id_regulation')
        );
        $this->web->update_data('regulation', $data, $where);
        $this->session->set_flashdata('msg', 'Data regulation success changed!');
        redirect('D_superadmin/data_regulation');
		}
    }

    public function delete_regulation($id)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_regulation' => $id);
		$this->web->delete_data($where, 'regulation');
        $this->session->set_flashdata('msg', 'Data regulation success deleted.');
		redirect('D_superadmin/data_regulation');
        }
	}

    public function data_method()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Method',
            );
            $data['method'] = $this->web->get_data('method', 'id_method')->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_datamethod');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_method()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_method();
            if($this->form_validation->run() == FALSE) {
                $this->data_method();
            } else {

                $data = array(
                    'name_method' => $this->input->post('name_method'),
                );

                $this->web->insert_data($data, 'method');
                $this->session->set_flashdata('msg', 'Data method success added.');
                redirect('D_superadmin/data_method');
            }
        }
    }

    public function _rules_method()
    {
        $this->form_validation->set_rules('name_method', 'Name method', 'required|is_unique[method.name_method]', [
            'is_unique' => 'This method already exist!'
        ]);
    }

    public function delete_method($id)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_method' => $id);
		$this->web->delete_data($where, 'method');
        $this->session->set_flashdata('msg', 'Data method success deleted.');
		redirect('D_superadmin/data_method');
        }
	}

    public function update_method($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {

            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data method',
            );
            $data['method'] = $this->web->get_data('method', 'id_method')->result();
            $data['specialmethod'] = $this->db->query("SELECT * FROM method WHERE id_method = '$id'")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_datamethod', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_method_action()
    {
        $this->_rules_method();
        if ($this->form_validation->run() == FALSE) {
            $this->update_method($this->input->post('id_method'));
        } else {

        $data = array(
            'name_method' => $this->input->post('name_method')
        );

        $where = array(
            'id_method' => $this->input->post('id_method')
        );
        $this->web->update_data('method', $data, $where);
        $this->session->set_flashdata('msg', 'Data method success changed!');
        redirect('D_superadmin/data_method');
		}
    }

    public function data_unit()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                    'company_pages' => $this->web->comp(),
                    'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Unit',
            );
            $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_dataunit');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_unit()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->_rules_unit();
        if($this->form_validation->run() == FALSE) {
            $this->data_unit();
        } else {

            $data = array(
                'name_unit' => $this->input->post('name_unit'),
            );

            $this->web->insert_data($data, 'unit');
            $this->session->set_flashdata('msg', 'Data unit success added.');
            redirect('D_superadmin/data_unit');
        }
    }
    }

    public function _rules_unit()
    {
        $this->form_validation->set_rules('name_unit', 'Name unit', 'required');
    }

    public function delete_unit($id)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_unit' => $id);
		$this->web->delete_data($where, 'unit');
        $this->session->set_flashdata('msg', 'Data unit success deleted.');
		redirect('D_superadmin/data_unit');
        }
	}

    public function update_unit($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {

        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data unit',
        );
        $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
        $data['specialunit'] = $this->db->query("SELECT * FROM unit WHERE id_unit = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_dataunit', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_unit_action()
    {
        $this->_rules_unit();
        if ($this->form_validation->run() == FALSE) {
            $this->update_unit($this->input->post('id_unit'));
        } else {

        $data = array(
            'name_unit' => $this->input->post('name_unit')
        );

        $where = array(
            'id_unit' => $this->input->post('id_unit')
        );
        $this->web->update_data('unit', $data, $where);
        $this->session->set_flashdata('msg', 'Data unit success changed!');
        redirect('D_superadmin/data_unit');
		}
    }

    public function data_coa()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {

        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Analysis',
        );

        $data['analysisCOA'] = $this->db->query("SELECT *,(SELECT count(*) FROM coa WHERE id_analysis = analysis.id_analysis) as st_account FROM analysis WHERE coa = 1 ORDER BY id_analysis DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listanalysis', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_coa($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add COA',
        );

        $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa LEFT JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method WHERE coa.id_analysis = '$id' ORDER BY id_coa DESC")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addcoa', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_coa_action()
    {
        $this->_rules_coa();
        if($this->form_validation->run() == FALSE) {
            $this->add_coa($this->input->post('id_analysis'));
        } else {

            $data = array(
                'id_analysis' => $this->input->post('id_analysis'),
                'id_unit' => $this->input->post('id_unit'),
                'id_method' => $this->input->post('id_method'),
                'params' => $this->input->post('params'),
                'category_params' => $this->input->post('category_params'),
                'sampling_time' => $this->input->post('sampling_time'),
                'reg_standart_1' => $this->input->post('reg_standart_1'),
                'reg_standart_2' => $this->input->post('reg_standart_2'),
                'reg_standart_3' => $this->input->post('reg_standart_3'),
                'reg_standart_4' => $this->input->post('reg_standart_4'),
                'year' => $this->input->post('year'),
                'capacity' => $this->input->post('capacity'),
                'sampling_location' => $this->input->post('sampling_location'),
                'noise' => $this->input->post('noise'),
                'time' => $this->input->post('time'),
            );

            $this->web->insert_data($data, 'coa');
            $this->session->set_flashdata('msg', 'Data COA success added.');
            redirect('D_superadmin/add_coa/' . $this->input->post('id_analysis'));
        }
    }

    public function _rules_coa()
    {
        $this->form_validation->set_rules('id_method', 'Method', 'required');
    }

    public function delete_coa($id, $id_anl)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_coa' => $id);
		$this->web->delete_data($where, 'coa');
        $this->session->set_flashdata('msg', 'Data COA success deleted.');
		redirect('D_superadmin/add_coa/' . $id_anl);
        }
	}

    public function update_coa($id, $id_anl) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_coa' => $id);
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data COA',
        );

        $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id_anl'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method WHERE coa.id_analysis = '$id_anl' ORDER BY id_coa DESC")->result();
        $data['specialcoa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.id_method = method.id_method WHERE id_coa = '$id'")->result();
        $data['methods'] = $this->web->get_data('method', 'id_method')->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addcoa', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_coa_action()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id = $this->input->post('id_coa');
        $id_analysis = $this->input->post('id_analysis');
        $this->_rules_coa();
        if ($this->form_validation->run() == FALSE) {
            $this->update_coa($id, $id_analysis);
        } else {

        $data = array(
            'id_coa' => $id,
            'id_analysis' => $id_analysis,
            'id_unit' => $this->input->post('id_unit'),
            'id_method' => $this->input->post('id_method'),
            'params' => $this->input->post('params'),
            'category_params' => $this->input->post('category_params'),
            'sampling_time' => $this->input->post('sampling_time'),
            'reg_standart_1' => $this->input->post('reg_standart_1'),
            'reg_standart_2' => $this->input->post('reg_standart_2'),
            'reg_standart_3' => $this->input->post('reg_standart_3'),
            'reg_standart_4' => $this->input->post('reg_standart_4'),
            'year' => $this->input->post('year'),
            'capacity' => $this->input->post('capacity'),
            'sampling_location' => $this->input->post('sampling_location'),
            'noise' => $this->input->post('noise'),
            'time' => $this->input->post('time'),
        );

        $where = array(
            'id_coa' => $id
        );
        
        $this->web->update_data('coa', $data, $where);
        $this->session->set_flashdata('msg', 'Data COA success changed!');
        redirect('D_superadmin/add_coa/' . $id_analysis);
		}
    }
    }

    public function data_quotation()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Institution',
        );
        $data['institution'] = $this->db->query("SELECT *,(SELECT count(*) FROM sk_number WHERE id_int = institution.id_int) as st_account FROM institution")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listinstitution', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function generate_sk($id_int) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        
            // create SK NUMBER
            $sql = $this->db->query("SELECT MAX(id_sk) AS maxID FROM sk_number")->result();
            foreach($sql as $sql2) {
                $code = $sql2->maxID;
            }
            $code++;
            $sk_quotation = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/QTN";
            // end SK Number
            $today = date ("Y-m-d");

            $data_sk = array(
                'sk_quotation' => $sk_quotation,
                'sk_sample' => '',
                'sk_analysis' => '',
                'id_int' => $id_int,
                'date_quotation' => $today,
            );

            $this->web->insert_data($data_sk, 'sk_number');
            $this->session->set_flashdata('msg', 'SK Quotation success generated.');
            redirect('D_superadmin/data_quotation');
        }
    }

    public function list_quotation() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array (
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' =>  'List Quotation'
            );
            if(isset($_GET['date'])) {
                $date = $_GET['date'];
                $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE date_quotation = '$date' ORDER BY id_sk DESC")->result();
                $this->load->view('superadmin/_layout/header', $data);
                $this->load->view('superadmin/_layout/sidebar');
                $this->load->view('superadmin/pages/D_listquotation', $data);
                $this->load->view('superadmin/_layout/footer');
            } else {
                $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
                $this->load->view('superadmin/_layout/header', $data);
                $this->load->view('superadmin/_layout/sidebar');
                $this->load->view('superadmin/pages/D_listquotation', $data);
                $this->load->view('superadmin/_layout/footer');
            }
        } 
    }

    public function report_quotation() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_filter();
            if($this->form_validation->run() == FALSE) {
                $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'List Quotation',
                );

                $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
                $this->load->view('superadmin/_layout/header', $data);
                $this->load->view('superadmin/_layout/sidebar');
                $this->load->view('superadmin/pages/D_reportquotation', $data);
                $this->load->view('superadmin/_layout/footer');
            } else {
                $from = $_GET['from'];
                $to = $_GET['to'];
                $data = array(
                    'company_pages' => $this->web->comp(),
                    'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                    'title' => 'List Quotation',
                    'from' => $from,
                    'to' => $to,
                );

                $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE DATE(date_quotation) >= '$from' AND DATE(date_quotation) <= '$to' ORDER BY id_sk DESC")->result();
                $this->load->view('superadmin/_layout/header', $data);
                $this->load->view('superadmin/_layout/sidebar');
                $this->load->view('superadmin/pages/D_reportquotation', $data);
                $this->load->view('superadmin/_layout/footer');
            }
        }
    }

    public function _rules_filter() {
        $this->form_validation->set_data($_GET)->set_rules('from', 'From Date', 'required');
        $this->form_validation->set_data($_GET)->set_rules('to', 'To Date', 'required');
    }

    public function add_quotation($id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_sk = $id_sk ORDER BY id_quotation DESC")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $data['sknumber'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addquotation', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_quotation_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_quotation();
        if($this->form_validation->run() == FALSE) {
            $this->add_quotation($id);
        } else {

            $id = $this->input->post('id_sk');
            $id_int = $this->input->post('id_int');
            $id_analysis = $this->input->post('id_analysis');
            $coa = $this->db->query("SELECT id_coa FROM coa WHERE id_analysis = $id_analysis")->result();

            
            $data_qtn = array(
                'id_analysis' => $id_analysis,
                'id_int' => $id_int,
                'remarks' => $this->input->post('remarks'),
                'spec' => $this->input->post('spec'),
                'qty' => $this->input->post('qty'),
                'id_sk' => $id,
                'add_price' => $this->input->post('add_price'),
            );

            foreach($coa as $c) {
                $id_coa = $c->id_coa;
                $data_result = array(
                    'id_analysis' => $id_analysis,
                    'id_int' => $id_int,
                    'id_sk' => $id,
                    'id_coa' => $id_coa
                );

                $this->web->insert_data($data_result, 'result_coa');
            }

            $this->web->insert_data($data_qtn, 'quotation');
            $this->session->set_flashdata('msg', 'Data Quotation success added.');
            redirect('D_superadmin/add_quotation/' . $id);
        }
    }

    public function _rules_quotation()
    {
        $this->form_validation->set_rules('id_analysis', 'Analysis', 'required');
        $this->form_validation->set_rules('id_int', 'Institution', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('spec', 'Specification', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');
        $this->form_validation->set_rules('id_sk', 'SK Number');
    }

    public function delete_quotation($id, $id_int, $id_analysis, $id_sk)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_quotation' => $id);
		$this->web->delete_data($where, 'quotation');
        $this->db->query("DELETE FROM result_coa WHERE id_int = $id_int AND id_analysis = $id_analysis AND id_sk = $id_sk");
        $this->session->set_flashdata('msg', 'Data Quotation success deleted.');
		redirect('D_superadmin/add_quotation/' . $id_sk);
        }
	}

    public function update_quotation($id_sk, $id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_quotation' => $id);
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = '$id_sk'")->result();
        $data['specialQuotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_quotation = '$id'")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $data['sknumber'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addquotation', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_quotation_action()
    {
		$id = $this->input->post('id_quotation');
		$id_int = $this->input->post('id_int');
		$id_sk = $this->input->post('id_sk');
        $this->_rules_quotation();
        if ($this->form_validation->run() == FALSE) {
            $this->update_quotation($id_sk, $id_int, $id);
        } else {
            $id_analysis = $this->input->post('id_analysis');
            $id_sk = $this->input->post('id_sk');

        $data = array(
            'id_analysis' => $id_analysis,
            'id_int' => $id_int,
            'remarks' => $this->input->post('remarks'),
            'spec' => $this->input->post('spec'),
            'qty' => $this->input->post('qty'),
            'id_sk' => $id_sk,
            'add_price' => $this->input->post('add_price'),
        );

        $where = array(
            'id_quotation' => $id
        );
        $this->web->update_data('quotation', $data, $where);
        $this->session->set_flashdata('msg', 'Data Quotation success changed!');
        redirect('D_superadmin/add_quotation/' . $id_sk);
		}
    }

    public function print_quotation($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Print Quotation',
            );
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
            $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis WHERE quotation.id_sk = $id")->result();
            $this->load->view('superadmin/pages/D_printquotation', $data);
        }
    }
    
    public function data_stps_index()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Quotation',
            );
            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE status_po = 1 ORDER BY id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }
    
    public function data_test_request()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Quotation',
            );
            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE status_po = 1 ORDER BY id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_stps($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int INNER JOIN analysis ON analysis.id_analysis = sampling_det.id_analysis WHERE sk_number.id_sk = $id ORDER BY id_sampling DESC")->result();
        $data['sample'] = $this->db->query("SELECT * FROM sample")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON analysis.id_analysis = quotation.id_analysis WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addstps', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function _rules_stps_date()
    {
        $this->form_validation->set_rules('date_sample', 'STPS Date', 'required');
    }

    public function add_stps_date()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_stps_date();
        if($this->form_validation->run() == FALSE) {
            $this->add_stps($id);
        } else {
            $date_sample = $this->input->post('date_sample');

            $data_stps = array(
                'date_sample' => $date_sample
            );

            $where = array(
                'id_sk' => $id
            );
            
            $this->web->update_data('sk_number', $data_stps, $where);
            $this->session->set_flashdata('msg', 'STPS Date updated.');
            redirect('D_superadmin/add_stps/' . $id);
        }
    }

    public function add_stps_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_stps();
        if($this->form_validation->run() == FALSE) {
            $this->add_stps($id);
        } else {

            // create SK NUMBER
            $sql = $this->db->query("SELECT id_sk FROM sk_number WHERE id_sk = $id")->result();
            foreach($sql as $sql2) {
                $code = $sql2->id_sk;
            }
            $sk_sample = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/STPS";
            // end SK Number

            $id_quotation = $this->input->post('id_quotation');
            $sample_array = $this->input->post('sample_desc[]');
            $location = $this->input->post('location');
            $today = date ( "Y-m-d" );
            $sample_desc = implode(", ",$sample_array);

            // ambil id_analysis
            $id_analysis = $this->db->query("SELECT * FROM quotation WHERE id_quotation = $id_quotation")->row();
            

            $data_sampling = array(
                'id_sk' => $id,
                'id_quotation' => $id_quotation,
                'id_analysis' => $id_analysis->id_analysis,
                'sample_desc' => $sample_desc,
                'location' => $location,
            );

            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id")->row();
            
            if($data['sk_number']->sk_sample == NULL && $data['sk_number']->date_sample == NULL) {
                $data_stps = array(
                    'sk_sample' => $sk_sample,
                    'date_sample' => $today
                );

                $where = array(
                    'id_sk' => $id
                );
                $this->web->update_data('sk_number', $data_stps, $where);
            }
            
            if($data['sk_number']->sk_sample == NULL) {
                $data_stps = array(
                    'sk_sample' => $sk_sample,
                );

                $where = array(
                    'id_sk' => $id
                );
                $this->web->update_data('sk_number', $data_stps, $where);
            }

            $this->web->insert_data($data_sampling, 'sampling_det');
            $this->session->set_flashdata('msg', 'Data Sampling success added.');
            redirect('D_superadmin/add_stps/' . $id);
        }
    }

    public function _rules_stps()
    {
        $this->form_validation->set_rules('id_quotation', 'Analysis', 'required');
        $this->form_validation->set_rules('sample_desc[]', 'Sample', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
    }

    public function delete_stps($id, $id_sk)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_sampling' => $id);
		$this->web->delete_data($where, 'sampling_det');
        $this->session->set_flashdata('msg', 'Data STPS success deleted.');
		redirect('D_superadmin/add_stps/' . $id_sk);
        }
	}

    public function print_stps($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Print STPS',
        );
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk WHERE sk_number.id_sk = $id AND assign_sampler.is_sampler = 1")->result();
        $this->load->view('superadmin/pages/D_printstps', $data);
    }
    }

    public function data_stps()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data STPS',
        );
        $data['stps'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk AND assign_sampler.is_sampler = 1) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_liststps', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_sampler_stps($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add Sampler STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id AND assign_sampler.is_sampler = 1")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM sampler")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addsamplerstps', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_sampler_stps_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_sampler_stps();
        if($this->form_validation->run() == FALSE) {
            $this->add_sampler_stps($id);
        } else {

            $id_sampler = $this->input->post('id_sampler');
            $id_sk = $this->input->post('id_sk');
            
            
            $data = array(
                'id_sampler' => $id_sampler,
                'id_sk' => $id_sk,
                'is_sampler' => 1
            );

            $this->web->insert_data($data, 'assign_sampler');
            $this->session->set_flashdata('msg', 'Assignment sampler success.');
            redirect('D_superadmin/add_sampler_stps/' . $id);
        }
    }

    public function delete_sampler_stps($id, $id_sk)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_superadmin/add_sampler_stps/' . $id_sk);
        }
	}
    
    public function update_sampler_stps($id, $id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Update Sampler STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE id_assign = '$id'")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id_sk AND assign_sampler.is_sampler = 1")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addsamplerstps', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_sampler_stps_action()
    {
		$id = $this->input->post('id_assign');
		$id_sk = $this->input->post('id_sk');
        $this->_rules_sampler_stps();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sampler_stps($id, $id_sk);
        } else {
            $id_sampler = $this->input->post('id_sampler');

        $data = array(
            'id_sampler' => $id_sampler,
        );

        $where = array(
            'id_assign' => $id
        );
        $this->web->update_data('assign_sampler', $data, $where);
        $this->session->set_flashdata('msg', 'Data sampler success changed!');
        redirect('D_superadmin/add_sampler_stps/' . $id_sk);
		}
    }

    public function _rules_sampler_stps()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }

    public function data_stp_index()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_sample) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listquotation', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function _rules_stp_date()
    {
        $this->form_validation->set_rules('date_analysis', 'STP Date', 'required');
    }

    public function add_stp_date()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_stp_date();
        if($this->form_validation->run() == FALSE) {
            $this->add_stp($id);
        } else {
            $date_analysis = $this->input->post('date_analysis');

            $data_stp = array(
                'date_analysis' => $date_analysis
            );

            $where = array(
                'id_sk' => $id
            );
            
            $this->web->update_data('sk_number', $data_stp, $where);
            $this->session->set_flashdata('msg', 'STP Date updated.');
            redirect('D_superadmin/add_stp/' . $id);
        }
    }

    public function add_stp($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addstp', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_stp($id, $id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id_sk'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM sampling_det WHERE id_sampling = $id")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addstp', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_stp_action()
    {
		$id = $this->input->post('id_sampling');
		$id_sk = $this->input->post('id_sk');

        // create SK NUMBER
        $sql = $this->db->query("SELECT id_sk FROM sk_number WHERE id_sk = $id_sk")->result();
        foreach($sql as $sql2) {
            $code = $sql2->id_sk;
        }
        $sk_analysis = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/STP";
        // end SK Number

        $sample_id = $this->input->post('sample_id');
        $sample_type = $this->input->post('sample_type');
        $deadline = $this->input->post('deadline');
        $description = $this->input->post('description');
        $today = date ( "Y-m-d" );

        $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->row();

        if($data['sk_number']->sk_analysis == NULL && $data['sk_number']->date_analysis == NULL) {
            $data_stp = array(
                'sk_analysis' => $sk_analysis,
                'date_analysis' => $today
            );
            
            $where_sk = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('sk_number', $data_stp, $where_sk);
        }

        if($data['sk_number']->sk_analysis == NULL) {
            $data_stp = array(
                'sk_analysis' => $sk_analysis,
            );
            
            $where_sk = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('sk_number', $data_stp, $where_sk);
        }

        for($i=0; $i<sizeof($id); $i++) {

            $data = array(
                'sample_id' => $sample_id[$i],
                'sample_type' => $sample_type[$i],
                'deadline' => $deadline[$i],
                'description' => $description[$i],
            );
            
            $where = array(
                'id_sampling' => $id[$i]
            );

            $this->web->update_data('sampling_det', $data, $where);
            $this->session->set_flashdata('msg', 'Data STP success changed!');
        }

        redirect('D_superadmin/add_stp/' . $id_sk);
    }

    public function print_stp($id) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Print STP',
        );
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk WHERE sk_number.id_sk = $id AND assign_sampler.is_sampler = 0")->result();
        $this->load->view('superadmin/pages/D_printstp', $data);
    }
    }

    public function data_stp()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data STP',
        );
        $data['stp'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk AND assign_sampler.is_sampler = 0) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_liststp', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_sampler_stp($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Add Sampler STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id AND assign_sampler.is_sampler = 0")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM sampler")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addsamplerstp', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_sampler_stp_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules_sampler_stp();
        if($this->form_validation->run() == FALSE) {
            $this->add_sampler_stp($id);
        } else {

            $id_sampler = $this->input->post('id_sampler');
            $id_sk = $this->input->post('id_sk');
            
            
            $data = array(
                'id_sampler' => $id_sampler,
                'id_sk' => $id_sk,
                'is_sampler' => 0
            );

            $this->web->insert_data($data, 'assign_sampler');
            $this->session->set_flashdata('msg', 'Assignment sampler success.');
            redirect('D_superadmin/add_sampler_stp/' . $id);
        }
    }

    public function delete_sampler_stp($id, $id_sk)
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_superadmin/add_sampler_stp/' . $id_sk);
        }
	}
    
    public function update_sampler_stp($id, $id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Update Sampler STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE id_assign = '$id'")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id_sk AND assign_sampler.is_sampler = 0")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addsamplerstp', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_sampler_stp_action()
    {
		$id = $this->input->post('id_assign');
		$id_sk = $this->input->post('id_sk');
        $this->_rules_sampler_stp();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sampler_stp($id, $id_sk);
        } else {
            $id_sampler = $this->input->post('id_sampler');

        $data = array(
            'id_sampler' => $id_sampler,
        );

        $where = array(
            'id_assign' => $id
        );
        $this->web->update_data('assign_sampler', $data, $where);
        $this->session->set_flashdata('msg', 'Data sampler success changed!');
        redirect('D_superadmin/add_sampler_stp/' . $id_sk);
		}
    }

    public function _rules_sampler_stp()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }

    public function data_gen_coa()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listquotation', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function data_quotation_coa()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
        $data['quotation_rev'] = $this->db->query("SELECT * FROM sk_number_rev INNER JOIN sk_number ON sk_number_rev.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listquotation', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }
    
    public function data_analysis_coa($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1 ORDER BY analysis.id_analysis DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_analysiscoa', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }
    
    public function data_analysis_coa_rev($id, $rev)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Analysis',
            'rev' => $rev
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1 ORDER BY analysis.id_analysis DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_analysiscoa', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }
    
    public function input_result($id, $id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data COA',
            );
            $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int LEFT JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id AND revision = 0")->result();

            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_inputresult', $data);
            $this->load->view('superadmin/_layout/footer');
        }   
    }
    
    public function input_result_rev($id, $id_sk, $rev)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data COA',
                'rev' => $rev,
            );
            $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int LEFT JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id AND result_coa.revision = $rev")->result();

            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number_rev WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_inputresult', $data);
            $this->load->view('superadmin/_layout/footer');
        }   
    }

    public function save_result_rev() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $rev = $this->input->post('rev');
        $id_result = $this->input->post('id_result');
        $result = $this->input->post('result');
        $vehicle_brand = $this->input->post('vehicle_brand');
        $time = $this->input->post('time');
        $humidity = $this->input->post('humidity');
        $wet = $this->input->post('wet');
        $dew = $this->input->post('dew');
        $globe = $this->input->post('globe');
        $wbgt_index = $this->input->post('wbgt_index');
        $sampling_location = $this->input->post('sampling_location');
        $code = $this->input->post('code');
        $opacity = $this->input->post('opacity');
        $leq = $this->input->post('leq');
        $ls = $this->input->post('ls');
        $lm = $this->input->post('lm');
        $lsm = $this->input->post('lsm');
        $id_sk = $this->input->post('id_sk');

        for($i=0; $i<sizeof($id_result); $i++) {

            $data = array(
                'result' => @$result[$i],
                'vehicle_brand' => @$vehicle_brand[$i],
                'time' => @$time[$i],
                'humidity' => @$humidity[$i],
                'wet' => @$wet[$i],
                'dew' => @$dew[$i],
                'globe' => @$globe[$i],
                'wbgt_index' => @$wbgt_index[$i],
                'sampling_location' => @$sampling_location[$i],
                'code' => @$code[$i],
                'opacity' => @$opacity[$i],
                'leq' => @$leq[$i],
                'ls' => @$ls[$i],
                'lm' => @$lm[$i],
                'lsm' => @$lsm[$i],
            );


            $where = array(
                'id_result' => $id_result[$i]
            );

            $this->web->update_data('result_coa', $data, $where);
        }

        $this->session->set_flashdata('msg', 'Input result success!');
        redirect('D_superadmin/input_result_rev/' . $this->input->post('id_analysis') . '/' . $id_sk . '/' . $rev);
        }
    }

    public function save_result() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id_result = $this->input->post('id_result');
        $id_sk = $this->input->post('id_sk');
        $today = date ( "Y-m-d" );
        $no_certificate = 'DIL-' . date('Y') . date('m') . date('d') . 'COA';

        $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->row();

        if($data['sk_number']->date_report == NULL) {
            $data_number = array(
                'no_certificate' => $no_certificate,
                'date_report' => $today
            );
            
            $where_sk = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('sk_number', $data_number, $where_sk);
        }

        for($i=0; $i<sizeof($id_result); $i++) {

            $data = array(
                'result' => @$this->input->post('result')[$i],
                'vehicle_brand' => @$this->input->post('vehicle_brand')[$i],
                'time' => @$this->input->post('time')[$i],
                'humidity' => @$this->input->post('humidity')[$i],
                'wet' => @$this->input->post('wet')[$i],
                'dew' => @$this->input->post('dew')[$i],
                'globe' => @$this->input->post('globe')[$i],
                'wbgt_index' => @$this->input->post('wbgt_index')[$i],
                'sampling_location' => @$this->input->post('sampling_location')[$i],
                'code' => @$this->input->post('code')[$i],
                'opacity' => @$this->input->post('opacity')[$i],
                'leq' => @$this->input->post('opacity')[$i],
                'ls' => @$this->input->post('ls')[$i],
                'lm' => @$this->input->post('lm')[$i],
                'lsm' => @$this->input->post('lsm')[$i],
            );


            $where = array(
                'id_result' => $id_result[$i]
            );

            $this->web->update_data('result_coa', $data, $where);
        }

        $name_int = $this->input->post('name_int');
        $no_certificate_coa = $this->input->post('no_certificate');

        // Encrypt for email params 
        function encryptId($id_sk) {
            $encrypt_method = "AES-256-CBC";
            $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR";
            $iv = "DASFDSYHFSDUYFFSD";
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $iv), 0, 16);
            $encrypt = openssl_encrypt($id_sk, $encrypt_method, $key, 0, $iv);
            $encrypt = base64_encode($encrypt);
            return $encrypt;
        }

        $institution = $this->db->query("SELECT * FROM company_profile")->row();

        // Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);
			//Server settings
			// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'validasi.sttj.ac.id';                    	// Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'deltaindo@validasi.sttj.ac.id';            // SMTP username
			$mail->Password   = 'kuningan1976!';                         // SMTP password
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		
			//Recipients
			$mail->setFrom('deltaindo@validasi.sttj.ac.id', 'PT. DELTA INDONESIA LABORATORY');
			$mail->addAddress($institution->director_email, 'DIRECTOR LABORATORY');     // Add a recipient
			
			$mail->addReplyTo('deltaindo@validasi.sttj.ac.id', 'PT. DELTA INDONESIA LABORATORY');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
		
			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Pesan Dari PT. DELTA INDONESIA LABORATORY';
			$mail->Body    = email($no_certificate_coa, $name_int, $id_sk);
        
        if($mail->send())
		{
			$this->session->set_flashdata('msg', 'Pesan berhasil terkirim!');
		}
		else{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

        $this->session->set_flashdata('msg', 'Input result success!');
        redirect('D_superadmin/input_result/' . $this->input->post('id_analysis') . '/' . $id_sk);
        }
    }

    public function generate_revision($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {

            $sql = $this->db->query("SELECT MAX(revision) AS maxREV FROM result_coa WHERE id_sk = $id_sk")->result();
            foreach($sql as $sql2) {
                $max_rev = $sql2->maxREV;
            }

            //duplicate result coa
            $result_coa = $this->db->query("SELECT * FROM result_coa WHERE id_sk = $id_sk AND revision = $max_rev")->result();

            for($i = 0; $i<sizeof($result_coa); $i++) {
                $data_res = $result_coa[$i];
                $data_result = array(
                    'id_sk' => $data_res->id_sk,
                    'id_coa' => $data_res->id_coa,
                    'id_analysis' => $data_res->id_analysis,
                    'id_int' => $data_res->id_int,
                    'revision' => $data_res->revision + 1,
                    'result' => $data_res->result,
                    'vehicle_brand' => $data_res->vehicle_brand,
                    'time' => $data_res->time,
                    'humidity' => $data_res->humidity,
                    'wet' => $data_res->wet,
                    'dew' => $data_res->dew,
                    'globe' => $data_res->globe,
                    'wbgt_index' => $data_res->wbgt_index,
                    'sampling_location' => $data_res->sampling_location,
                    'code' => $data_res->code,
                    'opacity' => $data_res->opacity,
                    'leq' => $data_res->leq,
                    'ls' => $data_res->ls,
                    'lm' => $data_res->lm,
                    'lsm' => $data_res->lsm,
                );

                $this->web->insert_data($data_result, 'result_coa');
            }

            //end duplicate

            // get sk_number and change
            $sk_before = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->row();
            $sk_rev = array(
                'id_sk' => $id_sk,
                'no_certificate_rev' => $sk_before->no_certificate . '-REV' . ($max_rev + 1),
                'revision' => $max_rev + 1,
            );
            $this->web->insert_data($sk_rev, 'sk_number_rev');
            //end change

            $this->session->set_flashdata('msg', 'Revision success generated.');
            redirect('D_superadmin/data_quotation_coa');
        }
    }

    public function data_quotation_print()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Print COA',
            );

            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
            $data['quotation_rev'] = $this->db->query("SELECT * FROM sk_number_rev INNER JOIN sk_number ON sk_number.id_sk = sk_number_rev.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function data_analysis_print($id)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Data Analysis',
        );

        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_analysiscoa', $data);
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function renderQR($id_sk) {
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $options = 0;
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $encrypt = openssl_encrypt($id_sk, $cipher, $secret, $options, $iv);
        //render qr code dengan format gambar png
        QRcode::png(
            $encrypt,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 3.5,
            $margin = 1
        );
    }

    public function draft_coa($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->load->library('dompdf_gen');
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int LEFT JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('superadmin/pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA " . $data['coa']->name_int .".pdf", array('Attachment' => 0));
        }
    }
    
    public function draft_coa_rev($id_sk, $rev) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->load->library('dompdf_gen');
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.id_method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk INNER JOIN sk_number_rev ON sk_number_rev.id_sk = $id_sk WHERE result_coa.id_sk = $id_sk AND sk_number_rev.revision = $rev")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('superadmin/pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA " . $data['coa']->name_int .".pdf", array('Attachment' => 0));
        }
    }

    public function pdf_coa($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->load->library('dompdf_gen');
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int LEFT JOIN unit ON coa.id_unit = unit.id_unit INNER JOIN method ON coa.id_method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk AND result_coa.revision = 0")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        foreach($data['coa'] as $name) {
            $name_int = $name->name_int;
            $no_cert = $name->no_certificate;
        }

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('superadmin/pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($no_cert. "_$name_int.pdf", array('Attachment' => false));

        }

    }

    public function pdf_coa_rev($id_sk, $rev) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->load->library('dompdf_gen');
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.id_method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk INNER JOIN sk_number_rev ON sk_number_rev.id_sk = $id_sk WHERE result_coa.id_sk = $id_sk AND result_coa.revision = $rev")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('superadmin/pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA " . $data['coa']->name_int .".pdf", array('Attachment' => 0));
        }
    }

    public function scan_coa()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'Scan COA',
        );
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_scancoa');
        $this->load->view('superadmin/_layout/footer');
        }
    }

    public function cek_id()
	{
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
		$id_sk = $this->input->post('id_sk');
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $options = 0;
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $decrypted = openssl_decrypt($id_sk, $cipher, $secret, $options, $iv);
		$cek_id = $this->web->cek_id($decrypted);
        if(!$cek_id) {
            $this->session->set_flashdata('error', 'Unknown QR Code!');
            redirect('D_superadmin/scan_coa');
        } else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Result Scan',
            );
    
            $data['result'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $decrypted")->result();
            $this->load->view('superadmin/pages/D_resultscan', $data);
            $this->load->view('superadmin/_layout/footer');
        }
        }
	}

    public function list_users()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => 'List Users',
        );
        $data['user'] = $this->db->query("SELECT * FROM user")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listusers', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_user() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => "Add User"
        );

        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_adduser');
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_user_action() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->form_validation->set_rules('fullname', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|matches[password]');
        if($this->form_validation->run() == false) {
            $this->add_user();
        } else {
            $data = array(
                'fullname' => htmlspecialchars($this->input->post('fullname', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role' => $this->input->post('role'),
                'date_created' => time()
            );

            $this->db->insert('user', $data);
            $this->session->set_flashdata('msg', 'User success added!');
            redirect('D_superadmin/list_users/');
        }
    }
    }

    public function delete_user($id) {
        $where = array('id_user' => $id);
		$this->web->delete_data($where, 'user');
        $this->session->set_flashdata('msg', 'User success deleted.');
		redirect('D_superadmin/list_users');
    }

    public function settings() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'company_pages' => $this->web->comp(),
            'profile_user' => $this->web->profile($this->session->userdata('id_user')),
            'title' => "Settings"
        );

        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_settings');
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_company_profile() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => "Settings Company Profile"
            );
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();

            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_settingscompany');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_company_profile_action() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->form_validation->set_rules('name', 'Company Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('website', 'Website', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('norek', 'Rekening Number', 'required');
        $this->form_validation->set_rules('behalf_account', 'Behalf Account', 'required');
        $this->form_validation->set_rules('bank', 'Bank', 'required');
        $this->form_validation->set_rules('director', 'Director', 'required');
        $this->form_validation->set_rules('director_email', 'Director Email', 'required');
        $this->form_validation->set_rules('technical_person', 'Technical Person', 'required');
        $this->form_validation->set_rules('img_logo', 'Logo');
        $this->form_validation->set_rules('tp_signature', 'Technical Person Signature');
        $this->form_validation->set_rules('director_signature', 'Director Signature');

        if($this->form_validation->run() == false) {
            $this->update_company_profile();
        } else {
            $img_logo = $_FILES['img_logo']['name'];
            $tp_signature = $_FILES['tp_signature']['name'];
            $director_signature = $_FILES['director_signature']['name'];

            $images_old = $this->db->query("SELECT * FROM company_profile")->result();
            
            if ($img_logo == NULL) {
                foreach($images_old as $old) {
                    $img_logo = $old->img_logo;
                }
            } else {
				$config['upload_path'] = FCPATH . "assets/img/company_profile/logo/";
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|webp';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

                if (!$this->upload->do_upload('img_logo')) {
                    echo "Upload image failed";
                } else {
                    $img_logo = $this->upload->data('file_name');
                }
            }
            
            if ($tp_signature == NULL) {
                foreach($images_old as $old) {
                    $tp_signature = $old->tp_signature;
                }
            } else {
				$config['upload_path'] = FCPATH . "assets/img/company_profile/tp_signature/";
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|webp';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

                if (!$this->upload->do_upload('tp_signature')) {
                    echo "Upload image failed";
                } else {
                    $tp_signature = $this->upload->data('file_name');
                }
            }
            
            if ($director_signature == NULL) {
                foreach($images_old as $old) {
                    $director_signature = $old->director_signature;
                }
            } else {
				$config['upload_path'] = FCPATH . "assets/img/company_profile/director_signature/";
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|webp';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

                if (!$this->upload->do_upload('director_signature')) {
                    echo "Upload image failed";
                } else {
                    $director_signature = $this->upload->data('file_name');
                }
            }

            $data = array (
                'name' => $this->input->post('name'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone'),
                'website' => $this->input->post('website'),
                'email' => $this->input->post('email'),
                'norek' => $this->input->post('norek'),
                'behalf_account' => $this->input->post('behalf_account'),
                'bank' => $this->input->post('bank'),
                'director' => $this->input->post('director'),
                'director_email' => $this->input->post('director_email'),
                'technical_person' => $this->input->post('technical_person'),
                'img_logo' => $img_logo,
                'tp_signature' => $tp_signature,
                'director_signature' => $director_signature,
            );

            $where = array(
                'id' => $this->input->post('id')
            );

            $this->web->update_data('company_profile', $data, $where);
            $this->session->set_flashdata('msg', 'Update company profile success!');
            redirect('D_superadmin/update_company_profile/');
        }
        }
    }

    
    public function update_profile() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => "Settings Profile"
            );
            $id_user = $this->session->userdata('id_user');
            $data['profile'] = $this->db->query("SELECT * FROM user WHERE id_user = $id_user")->result();

            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_settingsprofile');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function update_profile_action() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if($this->form_validation->run() == false) {
            $this->update_profile();
        } else {
            $image = $_FILES['image']['name'];

            $id_user = $this->session->userdata('id_user');
            $image_old = $this->db->query("SELECT * FROM user WHERE id_user = $id_user")->result();
            
            if ($image == NULL) {
                foreach($image_old as $old) {
                    $image = $old->image;
                }
            } else {
				$config['upload_path'] = FCPATH . "assets/img/avatar/";
				$config['allowed_types'] = 'jpg|jpeg|png|tiff|webp';
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

                if (!$this->upload->do_upload('image')) {
                    echo "Upload image failed";
                } else {
                    $image = $this->upload->data('file_name');
                }
            }

            $data = array (
                'fullname' => $this->input->post('fullname'),
                'email' => $this->input->post('email'),
                'image' => $image,
            );

            $where = array(
                'id_user' => $this->session->userdata('id_user')
            );

            $this->web->update_data('user', $data, $where);
            $this->session->set_flashdata('msg', 'Update profile success!');
            redirect('D_superadmin/update_profile/');
        }
    }
    }

    public function profile(){
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => "Profile"
            );
            $data['user'] = $this->db->query("SELECT * FROM user WHERE email = '$sess'")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_profile');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function verifikasi($aksi = '', $id_sk = '')
	{
		$sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
			redirect('D_auth');
		} else {
			switch ($aksi) {
				case 'cek':
					$cek_status = $this->web->cek_status($id_sk);
					$data = array(
						'id_sk'				=> $id_sk,
						'status_po'	=> ($cek_status->status_po == 1) ? 0 : 1
					);
					$this->web->update('change-stu-po', $data);
					$this->session->set_flashdata('msg', 'Data berhasil diubah!');
					redirect('D_superadmin/list_quotation');
					break;

				case 'thn':
					$thn = $id_sk;
					break;

				default:
					$thn = date('Y');
					break;
			}
		}
    }

    public function add_test_request($id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Add Test Request',
            );
            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['regulation'] = $this->db->query("SELECT * FROM regulation")->result();
            $data['sample'] = $this->db->query("SELECT * FROM sample")->result();
            $data['test_req_details'] = $this->db->query("SELECT * FROM test_request_det INNER JOIN regulation ON test_request_det.regulation = regulation.id_regulation  WHERE id_sk = $id_sk")->result();
            $data['test_req'] = $this->db->query("SELECT * FROM test_request WHERE id_sk = $id_sk")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_addtestrequest');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_test_request_detail_action() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $id_sk = $this->input->post('id_sk');
            $params_arr = $this->input->post('params');

            $params_desc = implode(", ", $params_arr);

            $data = array(
                'id_sk' => $id_sk,
                'params' => $params_desc,
                'regulation' => $this->input->post('regulation'),
                'total_example' => $this->input->post('total_example'),
            );

            $this->web->insert_data($data, 'test_request_det');
            $this->session->set_flashdata('msg', 'Test Request Details success added.');
            redirect('D_superadmin/add_test_request/' . $id_sk);
        }
    }

    public function delete_test_request_detail($id, $id_sk)
	{
        $where = array('id_request_det' => $id);
		$this->web->delete_data($where, 'test_request_det');
        $this->session->set_flashdata('msg', 'Data Test Request Detail success deleted.');
		redirect('D_superadmin/add_test_request/' . $id_sk);
	}

    public function save_test_request() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id_sk = $this->input->post('id_sk');
        $sample_arr = $this->input->post('sample_type');
        $entry_date = $this->input->post('entry_date');
        $work_package = $this->input->post('work_package');
        $amount = $this->input->post('amount');
        $amount_desc = $this->input->post('amount_desc');
        $condition = $this->input->post('condition');
        $condition_desc = $this->input->post('condition_desc');
        $receptacle = $this->input->post('receptacle');
        $receptacle_desc = $this->input->post('receptacle_desc');
        $note_sample = $this->input->post('note_sample');
        $sample_receiver = $this->input->post('sample_receiver');
        $hr_capabilities = $this->input->post('hr_capabilities');
        $method_suitability = $this->input->post('method_suitability');
        $equipment_capability = $this->input->post('equipment_capability');
        $conclusion = $this->input->post('conclusion');
        $max_time = $this->input->post('max_time');
        $note_request = $this->input->post('note_request');
        $technical_respon = $this->input->post('technical_respon');

        // customer section

        $data_cust = array(
            'int_person_testreq' => $this->input->post('int_person_testreq')
        );

        $where_cust = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data_cust, $where_cust);
        //end customer section

        $cek_sample_type = $this->db->query("SELECT * FROM test_request WHERE id_sk = $id_sk")->row();

        if ($cek_sample_type->sample_type == NULL) {
            $sample_type = implode(", ",$sample_arr);
        } else {
            $sample_type = $sample_arr;
        }

        $query_check = $this->db->query("SELECT * FROM test_request WHERE id_sk = $id_sk")->result();

        if($query_check == NULL) {
            $data = array(
                'id_sk' => @$id_sk,
                'sample_type' => @$sample_type,
                'entry_date' => @$entry_date,
                'work_package' => @$work_package,
                'amount' => @$amount,
                'amount_desc' => @$amount_desc,
                'condition' => @$condition,
                'condition_desc' => @$condition_desc,
                'receptacle' => @$receptacle,
                'receptacle_desc' => @$receptacle_desc,
                'note_sample' => @$note_sample,
                'sample_receiver' => @$sample_receiver,
                'hr_capabilities' => @$hr_capabilities,
                'method_suitability' => @$method_suitability,
                'equipment_capability' => @$equipment_capability,
                'conclusion' => @$conclusion,
                'max_time' => @$max_time,
                'note_request' => @$note_request,
                'technical_respon' => @$technical_respon,
            );
    
            $this->web->insert_data($data, 'test_request');
    
            $this->session->set_flashdata('msg', 'Update Test Request success!');
            redirect('D_superadmin/add_test_request/' . $id_sk);
        } else {
            $data = array(
                'sample_type' => @$sample_type,
                'entry_date' => @$entry_date,
                'work_package' => @$work_package,
                'amount' => @$amount,
                'amount_desc' => @$amount_desc,
                'condition' => @$condition,
                'condition_desc' => @$condition_desc,
                'receptacle' => @$receptacle,
                'receptacle_desc' => @$receptacle_desc,
                'note_sample' => @$note_sample,
                'sample_receiver' => @$sample_receiver,
                'hr_capabilities' => @$hr_capabilities,
                'method_suitability' => @$method_suitability,
                'equipment_capability' => @$equipment_capability,
                'conclusion' => @$conclusion,
                'max_time' => @$max_time,
                'note_request' => @$note_request,
            );


            $where = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('test_request', $data, $where);

            $this->session->set_flashdata('msg', 'Update Test Request success!');
            redirect('D_superadmin/add_test_request/' . $id_sk);
            }
        }
    }

    public function save_signature_testreq() {
        // customer section

        $id_sk = $_POST['id_sk'];
        $img = $_POST['int_signature_testreq'];

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $datasignature = base64_decode($img);
        $file = 'assets/img/signature-image/' . uniqid() . '.png';
        file_put_contents($file, $datasignature);
        $image=str_replace('./','',$file);
        $data_customer = array(
            'int_signature_testreq' => $image
        );

        $where_sk = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data_customer, $where_sk);
        //end customer section
    }

    public function delete_signature_testreq($id_sk) {
        $data_sk = $this->db->query("SELECT int_signature_testreq FROM sk_number WHERE id_sk = $id_sk")->result();

        foreach($data_sk as $row) {
            $int_signature_testreq = $row->int_signature_testreq;
            unlink($int_signature_testreq);
        }
        $data = array(
            'int_signature_testreq' => NULL,
        );

        $where = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data, $where);
        $this->session->set_flashdata('msg', 'Delete signature success.');
		redirect('D_superadmin/add_test_request/' . $id_sk);
    }

    public function delete_sample_type_request($id_sk) {
        $data = array(
            'sample_type' => NULL,
        );

        $where = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('test_request', $data, $where);
        $this->session->set_flashdata('msg', 'Delete sample type success.');
		redirect('D_superadmin/add_test_request/' . $id_sk);
    }

    public function print_test_request($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Print Test Request',
            );
            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
            $data['test_req_details'] = $this->db->query("SELECT * FROM test_request_det INNER JOIN regulation ON test_request_det.regulation = regulation.id_regulation  WHERE id_sk = $id_sk")->result();
            $data['test_req'] = $this->db->query("SELECT * FROM test_request WHERE id_sk = $id_sk")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/pages/D_printtestrequest', $data);
        }
    }

    public function data_baps()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Quotation',
            );
            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE status_po = 1 ORDER BY id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_baps($id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Add BAPS',
            );

            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['regulation'] = $this->db->query("SELECT * FROM regulation")->result();
            $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int INNER JOIN analysis ON analysis.id_analysis = sampling_det.id_analysis WHERE sk_number.id_sk = $id_sk ORDER BY id_sampling DESC")->result();
            $data['bpas'] = $this->db->query("SELECT * FROM baps WHERE id_sk = $id_sk")->result();
            $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON sampler.id_sampler = assign_sampler.id_sampler WHERE id_sk = $id_sk")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_addbaps');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function save_baps() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        //BAPS
        $id_sk = $this->input->post('id_sk');
        $id_sampler = $this->input->post('id_sampler');
        $air_ambient = $this->input->post('air_ambient');
        $chimney_emission = $this->input->post('chimney_emission');
        $lightning = $this->input->post('lightning');
        $heat_stress = $this->input->post('heat_stress');
        $workspace_air = $this->input->post('workspace_air');
        $smell = $this->input->post('smell');
        $noise = $this->input->post('noise');
        $wastewater = $this->input->post('wastewater');

        //Customer
        $data_cust = array(
            'int_person_baps' => $this->input->post('int_person_baps')
        );

        $where_cust = array(
            'id_sk' => $id_sk
        );
        $this->web->update_data('sk_number', $data_cust, $where_cust);
        //end customer
        
        //sampling_det
        $id_sampling = $this->input->post('id_sampling');
        $id_regulation = $this->input->post('id_regulation');
        $measurement_time = $this->input->post('measurement_time');

        $query_check = $this->db->query("SELECT * FROM baps WHERE id_sk = $id_sk")->result();

        $query_check_sk = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        foreach($query_check_sk as $cek) {

            if($cek->sk_baps == NULL) {
                // create SK NUMBER
                $sql = $this->db->query("SELECT id_sk FROM sk_number WHERE id_sk = $id_sk")->result();
                foreach($sql as $sql2) {
                    $code = $sql2->id_sk;
                }
                $sk_baps = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/BA";
                // end SK Number

                $data_sk = array (
                    'sk_baps' => $sk_baps
                );

                $where = array (
                    'id_sk' => $id_sk
                );

                $this->web->update_data('sk_number', $data_sk, $where);
            }
        }

        if($query_check == NULL) {
            

            $data_baps = array(
                'id_sk' => $id_sk,
                'id_sampler' => $id_sampler,
                'air_ambient' => $air_ambient,
                'chimney_emission' => $chimney_emission,
                'lightning' => $lightning,
                'heat_stress' => $heat_stress,
                'workspace_air' => $workspace_air,
                'smell' => $smell,
                'noise' => $noise,
                'wastewater' => $wastewater,
            );


            $this->web->insert_data($data_baps, 'baps');
        } else {

            $data_baps = array(
                'air_ambient' => $air_ambient,
                'id_sampler' => $id_sampler,
                'chimney_emission' => $chimney_emission,
                'lightning' => $lightning,
                'heat_stress' => $heat_stress,
                'workspace_air' => $workspace_air,
                'smell' => $smell,
                'noise' => $noise,
                'wastewater' => $wastewater,
            );

            $where = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('baps', $data_baps, $where);
        }


        for($i=0; $i<sizeof($id_sampling); $i++) {

            $data_sampling = array(
                'id_regulation' => $id_regulation[$i],
                'measurement_time' => $measurement_time[$i]
            );
            
            $where = array(
                'id_sampling' => $id_sampling[$i]
            );

            $this->web->update_data('sampling_det', $data_sampling, $where);
        }

        $this->session->set_flashdata('msg', 'Update BAPS success!');
        redirect('D_superadmin/add_baps/' . $id_sk);
        }
    }

    public function save_signature_baps() {
        // customer section

        $id_sk = $_POST['id_sk'];
        $img = $_POST['int_signature_baps'];

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $datasignature = base64_decode($img);
        $file = 'assets/img/signature-image/' . uniqid() . '.png';
        file_put_contents($file, $datasignature);
        $image=str_replace('./','',$file);
        $data_customer = array(
            'int_signature_baps' => $image
        );

        $where_sk = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data_customer, $where_sk);
        //end customer section
    }

    public function delete_signature_baps($id_sk) {
        $data_sk = $this->db->query("SELECT int_signature_baps FROM sk_number WHERE id_sk = $id_sk")->result();

        foreach($data_sk as $row) {
            $int_signature_baps = $row->int_signature_baps;
            unlink($int_signature_baps);
        }
        $data = array(
            'int_signature_baps' => NULL,
        );

        $where = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data, $where);
        $this->session->set_flashdata('msg', 'Delete signature success.');
		redirect('D_superadmin/add_baps/' . $id_sk);
    }

    public function print_baps($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Print BAPS',
            );
            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
            $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int INNER JOIN regulation ON regulation.id_regulation = sampling_det.id_regulation INNER JOIN analysis ON analysis.id_analysis = sampling_det.id_analysis WHERE sk_number.id_sk = $id_sk ORDER BY id_sampling DESC")->result();
            $data['bpas'] = $this->db->query("SELECT * FROM baps LEFT JOIN sampler ON sampler.id_sampler = baps.id_sampler WHERE id_sk = $id_sk")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $this->load->view('superadmin/pages/D_printbaps', $data);
        }
    }

    public function data_invoice()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Data Quotation',
            );
            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE status_po = 1 ORDER BY id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function add_invoice($id_sk)
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Add Invoice',
            );

            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_sk = $id_sk ORDER BY id_quotation DESC")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $data['invoice'] = $this->db->query("SELECT * FROM invoice WHERE id_sk = $id_sk")->result();
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();

            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_addinvoice');
            $this->load->view('superadmin/_layout/footer');
        }
    }

    public function save_invoice() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        //BAPS
        $id_sk = $this->input->post('id_sk');
        $date_inv = $this->input->post('date_inv');
        $po_date = $this->input->post('po_date');
        $po_date = $this->input->post('po_date');
        $subject = $this->input->post('subject');
        $amount_in_words = $this->input->post('amount_in_words');
        $discount = $this->input->post('discount');
        $ppn = $this->input->post('ppn');

        $query_check = $this->db->query("SELECT * FROM invoice WHERE id_sk = $id_sk")->result();

        $query_check_sk = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        foreach($query_check_sk as $cek) {
            if($cek->sk_inv == NULL) {
                // create SK NUMBER
                $sql = $this->db->query("SELECT id_sk FROM sk_number WHERE id_sk = $id_sk")->result();
                foreach($sql as $sql2) {
                    $code = $sql2->id_sk;
                }
                $sk_inv = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/INV";
                // end SK Number

                $data_sk = array (
                    'sk_inv' => $sk_inv
                );

                $where = array (
                    'id_sk' => $id_sk
                );

                $this->web->update_data('sk_number', $data_sk, $where);
            }
        }

        if($query_check == NULL) {
            

            $data_inv = array(
                'id_sk' => $id_sk,
                'date_inv' => $date_inv,
                'po_date' => $po_date,
                'subject' => $subject,
                'amount_in_words' => $amount_in_words,
                'discount' => $discount,
                'ppn' => $ppn,
            );


            $this->web->insert_data($data_inv, 'invoice');
        } else {

            $data_inv = array(
                'id_sk' => $id_sk,
                'date_inv' => $date_inv,
                'po_date' => $po_date,
                'subject' => $subject,
                'amount_in_words' => $amount_in_words,
                'discount' => $discount,
                'ppn' => $ppn,
            );

            $where = array(
                'id_sk' => $id_sk
            );

            $this->web->update_data('invoice', $data_inv, $where);
        }

        $this->session->set_flashdata('msg', 'Update Invoice success!');
        redirect('D_superadmin/add_invoice/' . $id_sk);
        }
    }

    public function print_invoice($id_sk) {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'company_pages' => $this->web->comp(),
                'profile_user' => $this->web->profile($this->session->userdata('id_user')),
                'title' => 'Print Invoice',
            );
            $data['institution'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
            $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_sk = $id_sk ORDER BY id_quotation DESC")->result();
            $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
            $data['invoice'] = $this->db->query("SELECT * FROM invoice WHERE id_sk = $id_sk")->result();
            $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();

            $this->load->view('superadmin/pages/D_printinvoice', $data);
        }
    }

}
