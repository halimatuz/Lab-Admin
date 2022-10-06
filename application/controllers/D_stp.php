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
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_sample) <> ''")->result();
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
            'date_sample' => $today
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
        redirect('D_stp/add_stp/' . $id_sk);
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_sampling', 'Sampling', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK', 'required');
        $this->form_validation->set_rules('sample_type', 'Sample Type', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');
    }

    public function print_stp($id) {
        $data = array(
            'title' => 'Print STP',
        );
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk WHERE sk_number.id_sk = $id AND assign_sampler.is_sampler = 0")->result();
        $this->load->view('pages/D_printstp', $data);
    }

    public function data_stp()
    {
        $data = array(
            'title' => 'Data STP',
        );
        $data['stp'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk AND assign_sampler.is_sampler = 0) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_liststp', $data);
        $this->load->view('_layout/footer');
    }

    public function add_sampler_stp($id)
    {
        $data = array(
            'title' => 'Add Sampler STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id AND assign_sampler.is_sampler = 0")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM sampler")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addsamplerstp', $data);
        $this->load->view('_layout/footer');
    }

    public function add_sampler_stp_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules2();
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
            redirect('D_stp/add_sampler_stp/' . $id);
        }
    }

    public function delete_sampler_stp($id, $id_sk)
	{
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_stp/add_sampler_stp/' . $id_sk);
	}
    
    public function update_sampler_stp($id, $id_sk) {
        $where = array('id_assign' => $id);
        $data = array(
            'title' => 'Update Sampler STP',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE id_assign = '$id'")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id_sk AND assign_sampler.is_sampler = 0")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addsamplerstp', $data);
        $this->load->view('_layout/footer');
    }

    public function update_sampler_stp_action()
    {
		$id = $this->input->post('id_assign');
		$id_sk = $this->input->post('id_sk');
        $this->_rules2();
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
        redirect('D_stp/add_sampler_stp/' . $id_sk);
		}
    }

    public function _rules2()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }
}