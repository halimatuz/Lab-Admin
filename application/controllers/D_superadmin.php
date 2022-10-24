<?php
defined('BASEPATH') or exit('No direct script access allowed');
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
                'title' => "Dashboard"
            );
            
            $data['total_sampler'] = $this->web->get_count('sampler');
            $data['total_institution'] = $this->web->get_count('institution');
            $data['total_coa'] = count($this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result());
            $data['total_quotation'] = $this->web->get_count('sk_number');
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
                $name_analysis = $this->input->post('name_analysis');
                $standart_price = $this->input->post('standart_price');
                $coa = $this->input->post('coa');

                $data = array(
                    'name_analysis' => $name_analysis,
                    'standart_price' => $standart_price,
                    'coa' => $coa,
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
		$id = $this->input->post('id_analysis');
        $this->_rules_analysis();
        if ($this->form_validation->run() == FALSE) {
            $this->update_analysis($id);
        } else {
            $id = $this->input->post('id_analysis');
            $name_analysis = $this->input->post('name_analysis');
            $standart_price = $this->input->post('standart_price');
            $coa = $this->input->post('coa');

        $data = array(
            'name_analysis' => $name_analysis,
            'standart_price' => $standart_price,
            'coa' => $coa,
        );

        $where = array(
            'id_analysis' => $id
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
                $name_int = $this->input->post('name_int');
                $int_phone = $this->input->post('int_phone');
                $int_email = $this->input->post('int_email');
                $int_address = $this->input->post('int_address');
                $name_cp = $this->input->post('name_cp');
                $title_cp = $this->input->post('title_cp');

                $data = array(
                    'name_int' => $name_int,
                    'int_phone' => $int_phone,
                    'int_email' => $int_email,
                    'int_address' => $int_address,
                    'name_cp' => $name_cp,
                    'title_cp' => $title_cp,
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
		$id = $this->input->post('id_int');
        $this->_rules_int();
        if ($this->form_validation->run() == FALSE) {
            $this->update_int($id);
        } else {
            $id = $this->input->post('id_int');
            $name_int = $this->input->post('name_int');
            $int_phone = $this->input->post('int_phone');
            $int_email = $this->input->post('int_email');
            $int_address = $this->input->post('int_address');
            $name_cp = $this->input->post('name_cp');
            $title_cp = $this->input->post('title_cp');
        $data = array(
            'name_int' => $name_int,
            'int_phone' => $int_phone,
            'int_email' => $int_email,
            'int_address' => $int_address,
            'name_cp' => $name_cp,
            'title_cp' => $title_cp,
        );

        $where = array(
            'id_int' => $id
        );
        $this->web->update_data('institution', $data, $where);
        $this->session->set_flashdata('int', 'Data Institution success changed!');
        redirect('D_superadmin/data_int');
		}
    }

    public function _rules_int()
    {
        $this->form_validation->set_rules('name_int', 'Name Institution', 'required');
        $this->form_validation->set_rules('int_phone', 'Phone Institution', 'required');
        $this->form_validation->set_rules('int_email', 'Email instituion', 'required');
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
            $name_smp = $this->input->post('name_smp');
            $gender_smp = $this->input->post('gender_smp');
            $phone_smp = $this->input->post('phone_smp');
            $email_smp = $this->input->post('email_smp');

            $data = array(
                'name_smp' => $name_smp,
                'gender_smp' => $gender_smp,
                'phone_smp' => $phone_smp,
                'email_smp' => $email_smp,
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
		$id = $this->input->post('id_sampler');
        $this->_rules_sampler();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sampler($id);
        } else {
            $id = $this->input->post('id_sampler');
            $name_smp = $this->input->post('name_smp');
            $gender_smp = $this->input->post('gender_smp');
            $phone_smp = $this->input->post('phone_smp');
            $email_smp = $this->input->post('email_smp');

        $data = array(
            'name_smp' => $name_smp,
            'gender_smp' => $gender_smp,
            'phone_smp' => $phone_smp,
            'email_smp' => $email_smp
        );

        $where = array(
            'id_sampler' => $id
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
            $name_sample = $this->input->post('name_sample');

            $data = array(
                'name_sample' => $name_sample,
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
        $where = array('id_sample' => $id);
        $data = array(
            'title' => 'Data sample',
        );
        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $data['specialSample'] = $this->db->query("SELECT * FROM sample WHERE id_sample = '$id'")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_datasample', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function update_sample_action()
    {
		$id = $this->input->post('id_sample');
        $this->_rules_sample();
        if ($this->form_validation->run() == FALSE) {
            $this->update_sample($id);
        } else {
            $id = $this->input->post('id_sample');
            $name_sample = $this->input->post('name_sample');

        $data = array(
            'name_sample' => $name_sample
        );

        $where = array(
            'id_sample' => $id
        );
        $this->web->update_data('sample', $data, $where);
        $this->session->set_flashdata('msg', 'Data sample success changed!');
        redirect('D_superadmin/data_sample');
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
            $name_method = $this->input->post('name_method');

            $data = array(
                'name_method' => $name_method,
            );

            $this->web->insert_data($data, 'method');
            $this->session->set_flashdata('msg', 'Data method success added.');
            redirect('D_superadmin/data_method');
        }
    }
    }

    public function _rules_method()
    {
        $this->form_validation->set_rules('name_method', 'Name method', 'required');
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
        $where = array('id_method' => $id);
        $data = array(
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
		$id = $this->input->post('id_method');
        $this->_rules_method();
        if ($this->form_validation->run() == FALSE) {
            $this->update_method($id);
        } else {
            $id = $this->input->post('id_method');
            $name_method = $this->input->post('name_method');

        $data = array(
            'name_method' => $name_method
        );

        $where = array(
            'id_method' => $id
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
            $name_unit = $this->input->post('name_unit');

            $data = array(
                'name_unit' => $name_unit,
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
        $where = array('id_unit' => $id);
        $data = array(
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
		$id = $this->input->post('id_unit');
        $this->_rules_unit();
        if ($this->form_validation->run() == FALSE) {
            $this->update_unit($id);
        } else {
            $id = $this->input->post('id_unit');
            $name_unit = $this->input->post('name_unit');

        $data = array(
            'name_unit' => $name_unit
        );

        $where = array(
            'id_unit' => $id
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
            'title' => 'Add COA',
        );

        $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id' ORDER BY id_coa DESC")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_addcoa', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function add_coa_action()
    {
        $id = $this->input->post('id_analysis');
        $this->_rules_coa();
        if($this->form_validation->run() == FALSE) {
            $this->add_coa($id);
        } else {
            $id_analysis = $this->input->post('id_analysis');
            $params = $this->input->post('params');
            $category_params = $this->input->post('category_params');
            $sampling_time = $this->input->post('sampling_time');
            $unit = $this->input->post('unit');
            $reg_standart_1 = $this->input->post('reg_standart_1');
            $reg_standart_2 = $this->input->post('reg_standart_2');
            $reg_standart_3 = $this->input->post('reg_standart_3');
            $reg_standart_4 = $this->input->post('reg_standart_4');
            $method = $this->input->post('method');
            $year = $this->input->post('year');
            $capacity = $this->input->post('capacity');
            $sampling_location = $this->input->post('sampling_location');
            $noise = $this->input->post('noise');
            $time = $this->input->post('time');

            $data = array(
                'id_analysis' => $id_analysis,
                'params' => $params,
                'category_params' => $category_params,
                'sampling_time' => $sampling_time,
                'unit' => $unit,
                'reg_standart_1' => $reg_standart_1,
                'reg_standart_2' => $reg_standart_2,
                'reg_standart_3' => $reg_standart_3,
                'reg_standart_4' => $reg_standart_4,
                'method' => $method,
                'year' => $year,
                'capacity' => $capacity,
                'sampling_location' => $sampling_location,
                'noise' => $noise,
                'time' => $time,
            );

            $this->web->insert_data($data, 'coa');
            $this->session->set_flashdata('msg', 'Data COA success added.');
            redirect('D_superadmin/add_coa/' . $id);
        }
    }

    public function _rules_coa()
    {
        $this->form_validation->set_rules('method', 'Method', 'required');
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
            'title' => 'Data COA',
        );

        $data['unit'] = $this->web->get_data('unit', 'id_unit')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id_anl'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id_anl'")->result();
        $data['specialcoa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE id_coa = '$id'")->result();
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
        $id_anl = $this->input->post('id_analysis');
        $this->_rules_coa();
        if ($this->form_validation->run() == FALSE) {
            $this->update_coa($id, $id_anl);
        } else {
            $id_coa = $this->input->post('id_coa');
            $id_analysis = $this->input->post('id_analysis');
            $params = $this->input->post('params');
            $category_params = $this->input->post('category_params');
            $sampling_time = $this->input->post('sampling_time');
            $unit = $this->input->post('unit');
            $reg_standart_1 = $this->input->post('reg_standart_1');
            $reg_standart_2 = $this->input->post('reg_standart_2');
            $reg_standart_3 = $this->input->post('reg_standart_3');
            $reg_standart_4 = $this->input->post('reg_standart_4');
            $method = $this->input->post('method');
            $year = $this->input->post('year');
            $capacity = $this->input->post('capacity');
            $sampling_location = $this->input->post('sampling_location');
            $noise = $this->input->post('noise');
            $time = $this->input->post('time');

        $data = array(
            'id_coa' => $id_coa,
            'id_analysis' => $id_analysis,
            'params' => $params,
            'category_params' => $category_params,
            'sampling_time' => $sampling_time,
            'unit' => $unit,
            'reg_standart_1' => $reg_standart_1,
            'reg_standart_2' => $reg_standart_2,
            'reg_standart_3' => $reg_standart_3,
            'reg_standart_4' => $reg_standart_4,
            'method' => $method,
            'year' => $year,
            'capacity' => $capacity,
            'sampling_location' => $sampling_location,
            'noise' => $noise,
            'time' => $time,
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
                'title' =>  'List Quotation'
            );

            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
            $this->load->view('superadmin/_layout/header', $data);
            $this->load->view('superadmin/_layout/sidebar');
            $this->load->view('superadmin/pages/D_listquotation', $data);
            $this->load->view('superadmin/_layout/footer');
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
            $remarks = $this->input->post('remarks');
            $spec = $this->input->post('spec');
            $qty = $this->input->post('qty');
            $add_price = $this->input->post('add_price');
            $coa = $this->db->query("SELECT id_coa FROM coa WHERE id_analysis = $id_analysis")->result();

            
            $data_qtn = array(
                'id_analysis' => $id_analysis,
                'id_int' => $id_int,
                'remarks' => $remarks,
                'spec' => $spec,
                'qty' => $qty,
                'id_sk' => $id,
                'add_price' => $add_price,
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
            $remarks = $this->input->post('remarks');
            $spec = $this->input->post('spec');
            $qty = $this->input->post('qty');
            $add_price = $this->input->post('add_price');
            $id_sk = $this->input->post('id_sk');

        $data = array(
            'id_analysis' => $id_analysis,
            'id_int' => $id_int,
            'remarks' => $remarks,
            'spec' => $spec,
            'qty' => $qty,
            'id_sk' => $id_sk,
            'add_price' => $add_price,
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
            
            if($data['sk_number']->date_sample == NULL) {
                $data_stps = array(
                    'sk_sample' => $sk_sample,
                    'date_sample' => $today
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
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_sample) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_listquotation', $data);
        $this->load->view('superadmin/_layout/footer');
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
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
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
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id_sk'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
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

        if($data['sk_number']->date_analysis == NULL) {
            $data_stp = array(
                'sk_analysis' => $sk_analysis,
                'date_analysis' => $today
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
            'title' => 'Print STP',
        );
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
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
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
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
            'title' => 'Data Analysis',
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
            'title' => 'Data COA',
        );
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id")->result();

        $data['sk_number'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        $this->load->view('superadmin/_layout/header', $data);
        $this->load->view('superadmin/_layout/sidebar');
        $this->load->view('superadmin/pages/D_inputresult', $data);
        $this->load->view('superadmin/_layout/footer');
    }
    }

    public function save_result() {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
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
			$mail->Host       = 'smtp.gmail.com';                    	// Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'akunpokemon1976@gmail.com';            // SMTP username
			$mail->Password   = 'goigybpldjpamwvv';                         // SMTP password
			// $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
		
			//Recipients
			$mail->setFrom('akunpokemon1976@gmail.com', 'PT. DELTA INDONESIA LABORATORY');
			$mail->addAddress($institution->director_email, 'DIRECTOR LABORATORY');     // Add a recipient
			
			$mail->addReplyTo('akunpokemon1976@gmail.com', 'PT. DELTA INDONESIA LABORATORY');
			// $mail->addCC('cc@example.com');
			// $mail->addBCC('bcc@example.com');
		
			// Attachments
			// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		
			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Pesan Dari PT. DELTA INDONESIA LABORATORY';
			$mail->Body    = '<!DOCTYPE HTML
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <!--[if gte mso 9]>
                        <xml>
                          <o:OfficeDocumentSettings>
                            <o:AllowPNG/>
                            <o:PixelsPerInch>96</o:PixelsPerInch>
                          </o:OfficeDocumentSettings>
                        </xml>
                        <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
        
            <style type="text/css">
                table,
                td {
                    color: #000000;
                }
        
                a {
                    color: #e67e23;
                    text-decoration: underline;
                }
        
                @media (max-width: 480px) {
                    #u_content_image_1 .v-src-width {
                        width: auto !important;
                    }
        
                    #u_content_image_1 .v-src-max-width {
                        max-width: 36% !important;
                    }
        
                    #u_content_button_1 .v-size-width {
                        width: 93% !important;
                    }
                }
        
                @media only screen and (min-width: 620px) {
                    .u-row {
                        width: 600px !important;
                    }
        
                    .u-row .u-col {
                        vertical-align: top;
                    }
        
                    .u-row .u-col-100 {
                        width: 600px !important;
                    }
        
                }
        
                @media (max-width: 620px) {
                    .u-row-container {
                        max-width: 100% !important;
                        padding-left: 0px !important;
                        padding-right: 0px !important;
                    }
        
                    .u-row .u-col {
                        min-width: 320px !important;
                        max-width: 100% !important;
                        display: block !important;
                    }
        
                    .u-row {
                        width: calc(100% - 40px) !important;
                    }
        
                    .u-col {
                        width: 100% !important;
                    }
        
                    .u-col>div {
                        margin: 0 auto;
                    }
                }
        
                body {
                    margin: 0;
                    padding: 0;
                    font-family: "Lato";
                }
        
                table,
                tr,
                td {
                    vertical-align: top;
                    border-collapse: collapse;
                }
        
                p {
                    margin: 0;
                }
        
                .ie-container table,
                .mso-container table {
                    table-layout: fixed;
                }
        
                * {
                    line-height: inherit;
                }
        
                a[x-apple-data-detectors="true"] {
                    color: inherit !important;
                    text-decoration: none !important;
                }
            </style>
        
        
        
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet"
                type="text/css">
            <!--<![endif]-->
        
        </head>
        
        <body class="clean-body u_body"
            style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #081933;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table
                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #081933;width:100%"
                cellpadding="0" cellspacing="0">
                <tbody>
                    <tr style="vertical-align: top">
                        <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                            <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #081933;"><![endif]-->
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="100%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636434047367-bb.png"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div style="width: 100% !important;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                                    <!--<![endif]-->
        
                                                    <table id="u_content_image_1" role="presentation" cellpadding="0"
                                                        cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:5px 10px 30px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
                                                                                <a href="https://unlayer.com" target="_blank">
                                                                                    <img align="center" border="0"
                                                                                        src="https://i.pinimg.com/564x/ac/16/cc/ac16cc581acefe12a5cad7039b133b14.jpg"
                                                                                        alt="Logo" title="Logo"
                                                                                        style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 20%;max-width: 116px;"
                                                                                        width="116"
                                                                                        class="v-src-width v-src-max-width" />
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://img.freepik.com/premium-vector/check-mark-document-mail-envelope-approved-email-message-computer-screen-vector-flat-illustration_662353-784.jpg"
                                                                                    alt="Hero Image" title="Hero Image"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 70%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #f7f7f7;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="background-color: #fff;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 44px 30px;"
                                                                    align="left">
        
                                                                    <h1
                                                                        style="margin: 0px; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal; font-size: 24px;">
                                                                        <strong>Draft COA '. $no_certificate_coa .'
                                                                            Telah Dibuat!</strong>
                                                                    </h1>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #fff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #f7f7f7;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 44px 30px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #333333; line-height: 200%; text-align: left; word-wrap: break-word;">
                                                                        <p style="line-height: 200%; font-size: 12px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">Draft
                                                                                COA untuk
                                                                                '. $name_int .',</span></p>
                                                                        <p style="line-height: 200%; font-size: 12px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">Draft
                                                                                COA berhasil dibuat, apabila ada
                                                                                kesalahan dalam draft mohon untuk menghubungi
                                                                                admin Delta Indonesia Laboratory lebih lanjut.
                                                                                Jika draft sudah sesuai silahkan klik tombol
                                                                                approve dibawah ini.</span></p>
                                                                        <p style="line-height: 200%; font-size: 12px; margin-top:10px;"><span
                                                                                style="font-size: 16px; line-height: 32px;">'. base_url("D_draft/draft_coa/") . encryptId($id_sk) .'</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px 44px 8px;"
                                                                    align="left">
        
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table id="u_content_button_1" role="presentation" cellpadding="0"
                                                        cellspacing="0" width="100%" border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <div align="center">
                                                                        <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="https://unlayer.com" style="height:60px; v-text-anchor:middle; width:372px;" arcsize="5%" stroke="f" fillcolor="#2a74f1"><w:anchorlock/><center style="color:#FFFFFF;"><![endif]-->
                                                                        <a href="https://unlayer.com" target="_blank"
                                                                            class="v-size-width"
                                                                            style="box-sizing: border-box;display: inline-block;text-decoration: none;-webkit-text-size-adjust: none;text-align: center;color: #FFFFFF; background-color: #2DD99A; border-radius: 3px;-webkit-border-radius: 3px; -moz-border-radius: 3px; width:64%; max-width:100%; overflow-wrap: break-word; word-break: break-word; word-wrap:break-word; mso-border-alt: none;">
                                                                            <span
                                                                                style="display:block;padding:19px 30px;line-height:120%;"><span
                                                                                    style="font-size: 18px; line-height: 21.6px;"><strong><span
                                                                                            style="line-height: 21.6px; font-size: 18px;">APPROVE</span></strong></span></span>
                                                                        </a>
                                                                        <!--[if mso]></center></v:roundrect></td></tr></table><![endif]-->
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 30px 70px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #333333; line-height: 190%; text-align: left; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 190%;"><span
                                                                                style="font-size: 16px; line-height: 30.4px;">Hormat
                                                                                kami,</span></p>
                                                                        <p style="font-size: 14px; line-height: 190%;"><span
                                                                                style="font-size: 16px; line-height: 30.4px;"><strong>PT.
                                                                                    Delta Indonesia Laboratory</strong></span>
                                                                        </p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636435417479-ggg.jpg"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:30px 10px 10px;"
                                                                    align="left">
        
                                                                    <div align="center">
                                                                        <div style="display: table; max-width:95px;">
                                                                            <!--[if (mso)|(IE)]><table width="95" cellpadding="0" cellspacing="0" border="0"><tr><td style="border-collapse:collapse;" align="center"><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse; mso-table-lspace: 0pt;mso-table-rspace: 0pt; width:95px;"><tr><![endif]-->
        
        
                                                                            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 16px;" valign="top"><![endif]-->
                                                                            <table align="left" border="0" cellspacing="0"
                                                                                cellpadding="0" width="32" height="32"
                                                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 16px">
                                                                                <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                        <td align="left" valign="middle"
                                                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                            <a href="https://www.linkedin.com/in/smk-plus-pelita-nusantara-44b7b2148/"
                                                                                                title="LinkedIn"
                                                                                                target="_blank">
                                                                                                <img src="https://i.pinimg.com/564x/22/7c/5c/227c5cc96b0e77302c09e4797b18089b.jpg"
                                                                                                    alt="LinkedIn"
                                                                                                    title="LinkedIn" width="32"
                                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if (mso)|(IE)]></td><![endif]-->
        
                                                                            <!--[if (mso)|(IE)]><td width="32" style="width:32px; padding-right: 0px;" valign="top"><![endif]-->
                                                                            <table align="left" border="0" cellspacing="0"
                                                                                cellpadding="0" width="32" height="32"
                                                                                style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;margin-right: 0px">
                                                                                <tbody>
                                                                                    <tr style="vertical-align: top">
                                                                                        <td align="left" valign="middle"
                                                                                            style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                                                                                            <a href="https://www.instagram.com/smkpluspelitanusantara/"
                                                                                                title="Instagram"
                                                                                                target="_blank">
                                                                                                <img src="https://i.pinimg.com/564x/85/84/ba/8584bab434a376e6df23c92e69da62eb.jpg"
                                                                                                    alt="Instagram"
                                                                                                    title="Instagram" width="32"
                                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: block !important;border: none;height: auto;float: none;max-width: 32px !important">
                                                                                            </a>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                            <!--[if (mso)|(IE)]></td><![endif]-->
        
        
                                                                            <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                                                        </div>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:15px 10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="55%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px 10px 20px;"
                                                                    align="left">
        
                                                                    <div
                                                                        style="color: #8d8c8c; line-height: 190%; text-align: center; word-wrap: break-word;">
                                                                        <p style="font-size: 14px; line-height: 190%;">Jika kamu
                                                                            memiliki pertanyaan, bisa hubungi kami lewat <span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;"><span
                                                                                    style="color: #f1602a; font-size: 14px; line-height: 26.6px; text-decoration: underline;"><span
                                                                                        style="font-size: 14px; line-height: 26.6px;">support@mailus.com</span>.
                                                                                </span></span><br />Ruko
                                                                            Prima Orchard No.C 2 Prima Harapan <br> Regency
                                                                            Bekasi
                                                                            Utara, Kota Bekasi 17123, Provinsi Jawa
                                                                            Barat<br /><span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Terms
                                                                                of use</span> | <span
                                                                                style="text-decoration: underline; font-size: 14px; line-height: 26.6px;">Privacy
                                                                                Policy</span></p>
                                                                    </div>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:0px;"
                                                                    align="left">
        
                                                                    <table width="100%" cellpadding="0" cellspacing="0"
                                                                        border="0">
                                                                        <tr>
                                                                            <td style="padding-right: 0px;padding-left: 0px;"
                                                                                align="center">
        
                                                                                <img align="center" border="0"
                                                                                    src="https://cdn.templates.unlayer.com/assets/1636435800013-footer%20curve.png"
                                                                                    alt="border" title="border"
                                                                                    style="outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 600px;"
                                                                                    width="600"
                                                                                    class="v-src-width v-src-max-width" />
        
                                                                            </td>
                                                                        </tr>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
        
                            <div class="u-row-container" style="padding: 0px;background-color: transparent">
                                <div class="u-row"
                                    style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                                    <div
                                        style="border-collapse: collapse;display: table;width: 100%;background-color: transparent;">
                                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
        
                                        <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                                        <div class="u-col u-col-100"
                                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                                            <div
                                                style="width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                <!--[if (!mso)&(!IE)]><!-->
                                                <div
                                                    style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                                    <!--<![endif]-->
        
                                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                                        border="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                                                    align="left">
        
                                                                    <table height="0px" align="center" border="0"
                                                                        cellpadding="0" cellspacing="0" width="100%"
                                                                        style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 0px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                        <tbody>
                                                                            <tr style="vertical-align: top">
                                                                                <td
                                                                                    style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                                                    <span>&#160;</span>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                    <!--[if (!mso)&(!IE)]><!-->
                                                </div>
                                                <!--<![endif]-->
                                            </div>
                                        </div>
                                        <!--[if (mso)|(IE)]></td><![endif]-->
                                        <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                                    </div>
                                </div>
                            </div>
        
        
                            <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                        </td>
                    </tr>
                </tbody>
            </table>
            <!--[if mso]></div><![endif]-->
            <!--[if IE]></div><![endif]-->
        </body>
        
        </html>'; 
        
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

    public function data_quotation_print()
    {
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
                'title' => 'Print COA',
            );
            $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' AND status_po = 1 ORDER BY sk_number.id_sk DESC")->result();
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
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('superadmin/pages/D_draftcoa', $data, TRUE);;
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
            'title' => 'Export PDF',
        );
        
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk")->result();
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

        if($this->form_validation->run() == false) {
            $this->update_company_profile();
        } else {
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

    public function profile(){
        $sess = $this->session->userdata('id_superadmin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
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

    
}