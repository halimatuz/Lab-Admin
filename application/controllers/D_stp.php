<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_stp extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_sample IS NOT NULL")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_listquotation', $data);
        $this->load->view('_layout/footer');
    }

    public function add_stp($id)
    {
        $data = array(
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addstp', $data);
        $this->load->view('_layout/footer');
    }

    public function update_stp($id, $id_sk)
    {
        $data = array(
            'title' => 'Add STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id_sk'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id_sk")->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM sampling_det WHERE id_sampling = $id")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addstp', $data);
        $this->load->view('_layout/footer');
    }

    public function update_stp_action()
    {
		$id = $this->input->post('id_sampling');
		$id_sk = $this->input->post('id_sk');
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update_stp($id, $id_sk);
        } else {

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

        $data_stp = array(
            'sk_analysis' => $sk_analysis,
        );

        $data = array(
            'sample_type' => $sample_type,
            'deadline' => $deadline,
            'description' => $description,
        );

        $where = array(
            'id_sampling' => $id
        );
        
        $where_sk = array(
            'id_sk' => $id_sk
        );

        $this->web->update_data('sk_number', $data_stp, $where_sk);
        $this->web->update_data('sampling_det', $data, $where);
        $this->session->set_flashdata('msg', 'Data STP success changed!');
        redirect('D_stp/add_stp/' . $id_sk);
		}
    }

    public function _rules()
    {
        $this->form_validation->set_rules('sample_type', 'Sample Type', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    public function print_stp($id) {
        $data = array(
            'title' => 'Print STP',
        );
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk WHERE sk_number.id_sk = $id")->result();
        $this->load->view('pages/D_printstp', $data);
    }
}