<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_admin extends CI_Controller 
{
    public function index() {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth/errors_403');
		} else {
            $data = array(
                'title' => "Dashboard"
            );
            
            $data['total_sampler'] = $this->web->get_count('sampler');
            $data['total_institution'] = $this->web->get_count('institution');
            $data['total_analysis'] = $this->web->get_count('analysis');
            $data['total_quotation'] = $this->web->get_count('sk_number');
            $this->load->view('admin/_layout/header', $data);
            $this->load->view('admin/_layout/sidebar');
            $this->load->view('admin/pages/index');
            $this->load->view('admin/_layout/footer');
        }
    }

    public function data_analysis()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $data = array(
            'title' => 'Data Analysis',
        );
            $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
            $this->load->view('admin/_layout/header', $data);
            $this->load->view('admin/_layout/sidebar');
            $this->load->view('admin/pages/D_dataanalysis');
            $this->load->view('admin/_layout/footer');
        }   
    }

    public function add_analysis()
    {
        $sess = $this->session->userdata('id_admin');
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
                redirect('D_admin/data_analysis');
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
		redirect('D_admin/data_analysis');
	}

    public function update_analysis($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_dataanalysis', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/data_analysis');
		}
    }

    public function data_int()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Institution',
        );
        $data['institution'] = $this->web->get_data('institution', 'id_int')->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datainstitution');
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_int()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
            $this->_rules_int();
            if($this->form_validation->run() == FALSE) {
                $this->data_int();
            } else {
                $name_int = $this->input->post('name_int');
                $int_phone = '62' . $this->input->post('int_phone');
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
                redirect('D_admin/data_int');
            }
        }
    }

    

    public function delete_int($id)
	{
        $where = array('id_int' => $id);
		$this->web->delete_data($where, 'institution');
        $this->session->set_flashdata('int', 'Data institution success deleted.');
		redirect('D_admin/data_int');
	}

    public function update_int($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datainstitution', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/data_int');
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
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Sampler',
        );
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datasampler');
        $this->load->view('admin/_layout/footer');
        }
    }

    public function add_sampler()
    {
        $sess = $this->session->userdata('id_admin');
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
            redirect('D_admin/data_sampler');
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
		redirect('D_admin/data_sampler');
	}

    public function update_sampler($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datasampler', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/data_sampler');
		}
    }

    public function data_sample()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data sample',
        );
        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datasample');
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_sample()
    {
        $sess = $this->session->userdata('id_admin');
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
            redirect('D_admin/data_sample');
        }
    }
    }

    public function _rules_sample()
    {
        $this->form_validation->set_rules('name_sample', 'Name Sample', 'required');
    }

    public function delete_sample($id)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_sample' => $id);
		$this->web->delete_data($where, 'sample');
        $this->session->set_flashdata('msg', 'Data sample success deleted.');
		redirect('D_admin/data_sample');
        }
	}

    public function update_sample($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datasample', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/data_sample');
		}
    }

    public function data_method()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Method',
        );
        $data['method'] = $this->web->get_data('method', 'id_method')->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datamethod');
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_method()
    {
        $sess = $this->session->userdata('id_admin');
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
            redirect('D_admin/data_method');
        }
    }
    }

    public function _rules_method()
    {
        $this->form_validation->set_rules('name_method', 'Name method', 'required');
    }

    public function delete_method($id)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_method' => $id);
		$this->web->delete_data($where, 'method');
        $this->session->set_flashdata('msg', 'Data method success deleted.');
		redirect('D_admin/data_method');
        }
	}

    public function update_method($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_datamethod', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/data_method');
		}
    }

    public function data_coa()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysisCOA'] = $this->db->query("SELECT *,(SELECT count(*) FROM coa WHERE id_analysis = analysis.id_analysis) as st_account FROM analysis WHERE coa = 1")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listanalysis', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_coa($id)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Add COA',
        );
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id'")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addcoa', $data);
        $this->load->view('admin/_layout/footer');
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
            $unit = $this->input->post('unit');
            $reg_standart_1 = $this->input->post('reg_standart_1');
            $reg_standart_2 = $this->input->post('reg_standart_2');
            $reg_standart_3 = $this->input->post('reg_standart_3');
            $reg_standart_4 = $this->input->post('reg_standart_4');
            $method = $this->input->post('method');

            $data = array(
                'id_analysis' => $id_analysis,
                'params' => $params,
                'category_params' => $category_params,
                'unit' => $unit,
                'reg_standart_1' => $reg_standart_1,
                'reg_standart_2' => $reg_standart_2,
                'reg_standart_3' => $reg_standart_3,
                'reg_standart_4' => $reg_standart_4,
                'method' => $method,
            );

            $this->web->insert_data($data, 'coa');
            $this->session->set_flashdata('msg', 'Data COA success added.');
            redirect('D_admin/add_coa/' . $id);
        }
    }

    public function _rules_coa()
    {
        $this->form_validation->set_rules('params', 'Parameters', 'required');
        $this->form_validation->set_rules('category_params', 'Category Parameters', 'required');
        $this->form_validation->set_rules('unit', 'Unit', 'required');
        $this->form_validation->set_rules('reg_standart_1', 'Regulatory Standard', 'required');
        $this->form_validation->set_rules('reg_standart_2', 'Parameters');
        $this->form_validation->set_rules('reg_standart_3', 'Parameters');
        $this->form_validation->set_rules('reg_standart_4', 'Parameters');
        $this->form_validation->set_rules('method', 'Method', 'required');
    }

    public function delete_coa($id, $id_anl)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_coa' => $id);
		$this->web->delete_data($where, 'coa');
        $this->session->set_flashdata('msg', 'Data COA success deleted.');
		redirect('D_admin/add_coa/' . $id_anl);
        }
	}

    public function update_coa($id, $id_anl) {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_coa' => $id);
        $data = array(
            'title' => 'Data COA',
        );
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id_anl'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id_anl'")->result();
        $data['specialcoa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE id_coa = '$id'")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addcoa', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function update_coa_action()
    {
        $sess = $this->session->userdata('id_admin');
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
            $unit = $this->input->post('unit');
            $reg_standart_1 = $this->input->post('reg_standart_1');
            $reg_standart_2 = $this->input->post('reg_standart_2');
            $reg_standart_3 = $this->input->post('reg_standart_3');
            $reg_standart_4 = $this->input->post('reg_standart_4');
            $method = $this->input->post('method');

        $data = array(
            'id_coa' => $id_coa,
            'id_analysis' => $id_analysis,
            'params' => $params,
            'category_params' => $category_params,
            'unit' => $unit,
            'reg_standart_1' => $reg_standart_1,
            'reg_standart_2' => $reg_standart_2,
            'reg_standart_3' => $reg_standart_3,
            'reg_standart_4' => $reg_standart_4,
            'method' => $method,
        );

        $where = array(
            'id_coa' => $id
        );
        
        $this->web->update_data('coa', $data, $where);
        $this->session->set_flashdata('msg', 'Data COA success changed!');
        redirect('D_admin/add_coa/' . $id_analysis);
		}
    }
    }

    public function data_quotation()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Institution',
        );
        $data['institution'] = $this->db->query("SELECT *,(SELECT count(*) FROM sk_number WHERE id_int = institution.id_int) as st_account FROM institution")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listinstitution', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function generate_sk($id_int) {
        $sess = $this->session->userdata('id_admin');
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
        $today = date ( "d/m/Y" );

        $data_sk = array(
            'sk_quotation' => $sk_quotation,
            'sk_sample' => '',
            'sk_analysis' => '',
            'id_int' => $id_int,
            'date_quotation' => $today,
        );
        $this->web->insert_data($data_sk, 'sk_number');
        $this->session->set_flashdata('msg', 'SK Quotation success generated.');
		redirect('D_admin/data_quotation');
    }
    }

    public function list_quotation($id_int) {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'List Quotation',
        );

        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_int = $id_int ORDER BY id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotationint', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_quotation($id_int, $id_sk)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Add Quotation',
        );
        $data['specialInstitution'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id_int'")->result();
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_sk = $id_sk ORDER BY id_quotation DESC")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $data['sknumber'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addquotation', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_quotation_action()
    {
        $id = $this->input->post('id_int');
        $id_sk_params = $this->input->post('id_sk');
        $this->_rules_quotation();
        if($this->form_validation->run() == FALSE) {
            $this->add_quotation($id, $id_sk_params);
        } else {

            $id_int = $this->input->post('id_int');
            $id_analysis = $this->input->post('id_analysis');
            $remarks = $this->input->post('remarks');
            $spec = $this->input->post('spec');
            $qty = $this->input->post('qty');
            $add_price = $this->input->post('add_price');
            $id_sk = $this->db->query("SELECT * FROM sk_number WHERE id_int = $id_int")->result();
            $coa = $this->db->query("SELECT id_coa FROM coa WHERE id_analysis = $id_analysis")->result();

            foreach($id_sk as $sk) {
                $sk_qtn = $sk->id_sk;
            }

            $data_qtn = array(
                'id_analysis' => $id_analysis,
                'id_int' => $id_int,
                'remarks' => $remarks,
                'spec' => $spec,
                'qty' => $qty,
                'id_sk' => $sk_qtn,
                'add_price' => $add_price,
            );

            foreach($coa as $c) {
                $id_coa = $c->id_coa;
                $data_result = array(
                    'id_analysis' => $id_analysis,
                    'id_int' => $id_int,
                    'id_sk' => $sk_qtn,
                    'id_coa' => $id_coa
                );

                $this->web->insert_data($data_result, 'result_coa');
            }

            $this->web->insert_data($data_qtn, 'quotation');
            $this->session->set_flashdata('msg', 'Data Quotation success added.');
            redirect('D_admin/add_quotation/' . $id . '/' . $id_sk_params);
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
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_quotation' => $id);
		$this->web->delete_data($where, 'quotation');
        $this->db->query("DELETE FROM result_coa WHERE id_int = $id_int AND id_analysis = $id_analysis AND id_sk = $id_sk");
        $this->session->set_flashdata('msg', 'Data Quotation success deleted.');
		redirect('D_admin/add_quotation/' . $id_int . '/' . $id_sk);
        }
	}

    public function update_quotation($id_int, $id_sk, $id) {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_quotation' => $id);
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['specialInstitution'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id_int'")->result();
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = '$id_sk'")->result();
        $data['specialQuotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_quotation = '$id'")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $data['sknumber'] = $this->db->query("SELECT * FROM sk_number WHERE id_sk = $id_sk")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addquotation', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/add_quotation/' . $id_int .  '/' .$id_sk . '/' . $id);
		}
    }

    public function print_quotation($id) {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Print Quotation',
        );
        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis WHERE quotation.id_sk = $id")->result();
        $this->load->view('admin/pages/D_printquotation', $data);
    }
    }

    public function data_stps_index()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotation', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_stps($id)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Add STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id ORDER BY id_sampling DESC")->result();
        $data['sample'] = $this->db->query("SELECT * FROM sample")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addstps', $data);
        $this->load->view('admin/_layout/footer');
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

            $sample_array = $this->input->post('sample_desc[]');
            $location = $this->input->post('location');
            $today = date ( "d/m/Y" );
            $sample_desc = implode(", ",$sample_array);

            $data_sampling = array(
                'id_sk' => $id,
                'sample_desc' => $sample_desc,
                'location' => $location,
            );
            
            $data_stps = array(
                'sk_sample' => $sk_sample,
                'date_sample' => $today
            );

            $where = array(
                'id_sk' => $id
            );
            $this->web->update_data('sk_number', $data_stps, $where);
            $this->web->insert_data($data_sampling, 'sampling_det');
            $this->session->set_flashdata('msg', 'Data Sampling success added.');
            redirect('D_admin/add_stps/' . $id);
        }
    }

    public function _rules_stps()
    {
        $this->form_validation->set_rules('sample_desc[]', 'Sample', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
    }

    public function delete_stps($id, $id_sk)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_sampling' => $id);
		$this->web->delete_data($where, 'sampling_det');
        $this->session->set_flashdata('msg', 'Data STPS success deleted.');
		redirect('D_admin/add_stps/' . $id_sk);
        }
	}

    public function print_stps($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/pages/D_printstps', $data);
    }
    }

    public function data_stps()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data STPS',
        );
        $data['stps'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk AND assign_sampler.is_sampler = 1) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_liststps', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_sampler_stps($id)
    {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addsamplerstps', $data);
        $this->load->view('admin/_layout/footer');
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
            redirect('D_admin/add_sampler_stps/' . $id);
        }
    }

    public function delete_sampler_stps($id, $id_sk)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_admin/add_sampler_stps/' . $id_sk);
        }
	}
    
    public function update_sampler_stps($id, $id_sk) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addsamplerstps', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/add_sampler_stps/' . $id_sk);
		}
    }

    public function _rules_sampler_stps()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }

    public function data_stp_index()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_sample) <> '' ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotation', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_stp($id)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addstp', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function update_stp($id, $id_sk)
    {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addstp', $data);
        $this->load->view('admin/_layout/footer');
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

        $sample_type = $this->input->post('sample_type');
        $deadline = $this->input->post('deadline');
        $description = $this->input->post('description');
        $today = date ( "d/m/Y" );

        $data_stp = array(
            'sk_analysis' => $sk_analysis,
            'date_analysis' => $today
        );
        
        $where_sk = array(
            'id_sk' => $id_sk
        );
        
        for($i=0; $i<sizeof($id); $i++) {

            $data = array(
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

        $this->web->update_data('sk_number', $data_stp, $where_sk);
        redirect('D_admin/add_stp/' . $id_sk);
    }

    public function print_stp($id) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/pages/D_printstp', $data);
    }
    }

    public function data_stp()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data STP',
        );
        $data['stp'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk AND assign_sampler.is_sampler = 0) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_liststp', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function add_sampler_stp($id)
    {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addsamplerstp', $data);
        $this->load->view('admin/_layout/footer');
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
            redirect('D_admin/add_sampler_stp/' . $id);
        }
    }

    public function delete_sampler_stp($id, $id_sk)
	{
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_admin/add_sampler_stp/' . $id_sk);
        }
	}
    
    public function update_sampler_stp($id, $id_sk) {
        $sess = $this->session->userdata('id_admin');
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
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_addsamplerstp', $data);
        $this->load->view('admin/_layout/footer');
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
        redirect('D_admin/add_sampler_stp/' . $id_sk);
		}
    }

    public function _rules_sampler_stp()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }

    public function data_gen_coa()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotation', $data);
        $this->load->view('admin/_layout/footer');
        }
    }

    public function data_quotation_coa()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotation', $data);
        $this->load->view('admin/_layout/footer');
    }
    }
    
    public function data_analysis_coa($id)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_analysiscoa', $data);
        $this->load->view('admin/_layout/footer');
    }
    }
    
    public function input_result($id, $id_sk)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data COA',
        );
        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_inputresult', $data);
        $this->load->view('admin/_layout/footer');
    }
    }

    public function save_result() {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id_result = $this->input->post('id_result');
        $result = $this->input->post('result');
        $id_sk = $this->input->post('id_sk');
        $today = date ( "d/m/Y" );
        $no_certificate = 'DIL-' . date('Y') . date('m') . date('d') . 'COA';

        $data_number = array(
            'no_certificate' => $no_certificate,
            'date_report' => $today
        );
        
        $where_sk = array(
            'id_sk' => $id_sk
        );

        for($i=0; $i<sizeof($id_result); $i++) {

            $data = array(
                'result' => $result[$i],
            );

            $where = array(
                'id_result' => $id_result[$i]
            );

            $this->web->update_data('result_coa', $data, $where);
        }

        $this->web->update_data('sk_number', $data_number, $where_sk);
        $this->session->set_flashdata('msg', 'Input result success!');
        redirect('D_admin/input_result/' . $this->input->post('id_analysis') . '/' . $id_sk);
        }
    }

    public function data_quotation_print()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Print COA',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listquotation', $data);
        $this->load->view('admin/_layout/footer');
        }
    }

    public function data_analysis_print($id)
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_analysiscoa', $data);
        $this->load->view('admin/_layout/footer');
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

    public function pdf_coa($id_sk) {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $this->load->library('dompdf_gen');
        $data = array(
            'title' => 'Export PDF',
        );

        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_sk = $id_sk")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('admin/pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA " . $data['coa']->name_int .".pdf", array('Attachment' => 0));
        }

    }

    public function scan_coa()
    {
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Scan COA',
        );
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_scancoa');
        $this->load->view('admin/_layout/footer');
        }
    }

    public function cek_id()
	{
        $sess = $this->session->userdata('id_admin');
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
            redirect('D_admin/scan_coa');
        } else {
            $data = array(
                'title' => 'Result Scan',
            );
    
            $data['result'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $decrypted")->result();
            $this->load->view('admin/pages/D_resultscan', $data);
            $this->load->view('admin/_layout/footer');
        }
        }
	}

    public function list_users()
    {
        $data = array(
            'title' => 'List Users',
        );
        $data['user'] = $this->db->query("SELECT * FROM user")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_listusers', $data);
        $this->load->view('admin/_layout/footer');
    }

    public function add_user() {
        $data = array(
            'title' => "Add User"
        );

        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_adduser');
        $this->load->view('admin/_layout/footer');
    }

    public function add_user_action() {
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
                'role' => 'admin',
                'date_created' => time()
            );

            $this->db->insert('user', $data);
            $this->session->set_flashdata('msg', 'User success added!');
            redirect('D_admin/list_users/');
        }
    }

    public function profile(){
        $sess = $this->session->userdata('id_admin');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => "Profile"
        );
        $data['user'] = $this->db->query("SELECT * FROM user WHERE email = '$sess'")->result();
        $this->load->view('admin/_layout/header', $data);
        $this->load->view('admin/_layout/sidebar');
        $this->load->view('admin/pages/D_profile');
        $this->load->view('admin/_layout/footer');
    }
    }
}