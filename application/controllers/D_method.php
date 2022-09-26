<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_method extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Method',
        );
        $data['method'] = $this->web->get_data('method', 'id_method')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datamethod');
        $this->load->view('_layout/footer');
    }

    public function add_method()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $name_method = $this->input->post('name_method');

            $data = array(
                'name_method' => $name_method,
            );

            $this->web->insert_data($data, 'method');
            $this->session->set_flashdata('msg', 'Data method success added.');
            redirect('D_method');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name_method', 'Name method', 'required');
    }

    public function delete_method($id)
	{
        $where = array('id_method' => $id);
		$this->web->delete_data($where, 'method');
        $this->session->set_flashdata('msg', 'Data method success deleted.');
		redirect('D_method');
	}

    public function update_method($id) {
        $where = array('id_method' => $id);
        $data = array(
            'title' => 'Data method',
        );
        $data['method'] = $this->web->get_data('method', 'id_method')->result();
        $data['specialmethod'] = $this->db->query("SELECT * FROM method WHERE id_method = '$id'")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datamethod', $data);
        $this->load->view('_layout/footer');
    }

    public function update_method_action()
    {
		$id = $this->input->post('id_method');
        $this->_rules();
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
        redirect('D_method');
		}
    }
}