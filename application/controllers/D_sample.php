<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_sample extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Sample',
        );
        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datasample');
        $this->load->view('_layout/footer');
    }

    public function add_sample()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $name_sample = $this->input->post('name_sample');

            $data = array(
                'name_sample' => $name_sample,
            );

            $this->web->insert_data($data, 'sample');
            $this->session->set_flashdata('msg', 'Data sample success added.');
            redirect('D_sample');
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('name_sample', 'Name Sample', 'required');
    }

    public function delete_sample($id)
	{
        $where = array('id_sample' => $id);
		$this->web->delete_data($where, 'sample');
        $this->session->set_flashdata('msg', 'Data sample success deleted.');
		redirect('D_sample');
	}

    public function update_sample($id) {
        $where = array('id_sample' => $id);
        $data = array(
            'title' => 'Data Sample',
        );
        $data['sample'] = $this->web->get_data('sample', 'id_sample')->result();
        $data['specialSample'] = $this->db->query("SELECT * FROM sample WHERE id_sample = '$id'")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_datasample', $data);
        $this->load->view('_layout/footer');
    }

    public function update_sample_action()
    {
		$id = $this->input->post('id_sample');
        $this->_rules();
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
        redirect('D_sample');
		}
    }
}