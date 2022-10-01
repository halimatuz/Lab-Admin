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
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
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
        $data['sample'] = $this->db->query("SELECT * FROM sample")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addstp', $data);
        $this->load->view('_layout/footer');
    }

    public function add_stp_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->add_stp($id);
        } else {

            // create SK NUMBER
            $sql = $this->db->query("SELECT id_sk FROM sk_number WHERE id_sk = $id")->result();
            foreach($sql as $sql2) {
                $code = $sql2->id_sk;
            }
            $sk_sample = $code . '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/' . "DIL/STP";
            // end SK Number

            $sample_array = $this->input->post('sample_desc[]');
            $location = $this->input->post('location');

            $sample_desc = implode(", ",$sample_array);

            $data_sampling = array(
                'id_sk' => $id,
                'sample_desc' => $sample_desc,
                'location' => $location,
            );
            
            $data_stp = array(
                'sk_sample' => $sk_sample,
            );

            $where = array(
                'id_sk' => $id
            );
            $this->web->update_data('sk_number', $data_stp, $where);
            $this->web->insert_data($data_sampling, 'sampling_det');
            $this->session->set_flashdata('msg', 'Data Sampling success added.');
            redirect('D_stp/add_stp/' . $id);
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('sample_desc[]', 'Sample', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
    }

    public function delete_stp($id, $id_sk)
	{
        $where = array('id_sampling' => $id);
		$this->web->delete_data($where, 'sampling_det');
        $this->session->set_flashdata('msg', 'Data STP success deleted.');
		redirect('D_stp/add_stp/' . $id_sk);
	}

    public function print_stp($id) {
        $data = array(
            'title' => 'Print STP',
        );
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $this->load->view('pages/D_printstp', $data);
    }
}