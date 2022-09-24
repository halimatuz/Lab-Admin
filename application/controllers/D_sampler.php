<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_sampler extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Sampler',
        );
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datasampler');
        $this->load->view('_layout/footer');
    }

    public function add_sampler()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->index();
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
        redirect('D_sampler');
    }
    }

    public function _rules()
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
		redirect('D_sampler');
	}

    public function update_sampler($id) {
        $where = array('id_sampler' => $id);
        $data = array(
            'title' => 'Data Sampler',
        );
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['specialSampler'] = $this->db->query("SELECT * FROM sampler WHERE id_sampler = '$id'")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datasampler', $data);
        $this->load->view('_layout/footer');
    }

    public function update_sampler_action()
    {
		$id = $this->input->post('id_sampler');
        $this->_rules();
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
        redirect('D_sampler');
		}
    }
}