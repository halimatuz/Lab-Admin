<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_analysis extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_dataanalysis');
        $this->load->view('_layout/footer');
    }

    public function add_analysis()
    {
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->index();
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
            redirect('D_analysis');
        }
    }

    public function _rules()
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
		redirect('D_analysis');
	}

    public function update_analysis($id) {
        $where = array('id_analysis' => $id);
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_dataanalysis', $data);
        $this->load->view('_layout/footer');
    }

    public function update_analysis_action()
    {
		$id = $this->input->post('id_analysis');
        $this->_rules();
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
        redirect('D_analysis');
		}
    }
}