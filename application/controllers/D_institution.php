<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_institution extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Institution',
        );
        $data['institution'] = $this->web->get_data('institution', 'id_int')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datainstitution');
        $this->load->view('_layout/footer');
    }

    public function add_int()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $name_int = $this->input->post('name_int');
            $int_phone = $this->input->post('int_phone');
            $int_email = $this->input->post('int_email');
            $int_adress = $this->input->post('int_adress');
           
        

        $data = array(
            'name_int' => $name_int,
            'int_phone' => $int_phone,
            'int_email' => $int_email,
            'int_adress' => $int_adress,
        );

        $this->web->insert_data($data, 'institution');
        $this->session->set_flashdata('int', 'Data institution success added.');
        redirect('D_institution');
    }
    }

    

    public function delete_int($id)
	{
        $where = array('id_int' => $id);
		$this->web->delete_data($where, 'institution');
        $this->session->set_flashdata('int', 'Data institution success deleted.');
		redirect('D_institution');
	}

    public function update_int($id) {
        $where = array('id_int' => $id);
        $data = array(
            'title' => 'Data institution',
        );
        $data['institution'] = $this->web->get_data('institution', 'id_int')->result();
        $data['specialInt'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id'")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datainstitution', $data);
        $this->load->view('_layout/footer');
    }

    public function update_int_action()
    {
		$id = $this->input->post('id_int');
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update_int($id);
        } else {
            $id = $this->input->post('id_int');
            $name_int = $this->input->post('name_int');
            $int_phone = $this->input->post('int_phone');
            $int_email = $this->input->post('int_email');
            $int_adress = $this->input->post('int_adress');
        $data = array(
            'name_int' => $name_int,
            'int_phone' => $int_phone,
            'int_email' => $int_email,
            'int_adress' => $int_adress,
        );

        $where = array(
            'id_int' => $id
        );
        $this->web->update_data('institution', $data, $where);
        $this->session->set_flashdata('int', 'Data Institution success changed!');
        redirect('D_institution');
		}
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name_int', 'Name Institution', 'required');
        $this->form_validation->set_rules('int_phone', 'Phone Institution', 'required');
        $this->form_validation->set_rules('int_email', 'email instituion', 'required');
        $this->form_validation->set_rules('int_adress', 'Adress instituion', 'required');
    }
}