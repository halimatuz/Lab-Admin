<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_stps extends CI_Controller 
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

    public function add_stps($id)
    {
        $data = array(
            'title' => 'Add STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = '$id'")->result();
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sample'] = $this->db->query("SELECT * FROM sample")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addstps', $data);
        $this->load->view('_layout/footer');
    }

    public function add_stps_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules();
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

            $sample_desc = implode(", ",$sample_array);

            $data_sampling = array(
                'id_sk' => $id,
                'sample_desc' => $sample_desc,
                'location' => $location,
            );
            
            $data_stps = array(
                'sk_sample' => $sk_sample,
            );

            $where = array(
                'id_sk' => $id
            );
            $this->web->update_data('sk_number', $data_stps, $where);
            $this->web->insert_data($data_sampling, 'sampling_det');
            $this->session->set_flashdata('msg', 'Data Sampling success added.');
            redirect('D_stps/add_stps/' . $id);
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('sample_desc[]', 'Sample', 'required');
        $this->form_validation->set_rules('location', 'Location', 'required');
    }

    public function delete_stps($id, $id_sk)
	{
        $where = array('id_sampling' => $id);
		$this->web->delete_data($where, 'sampling_det');
        $this->session->set_flashdata('msg', 'Data STPS success deleted.');
		redirect('D_stps/add_stps/' . $id_sk);
	}

    public function print_stps($id) {
        $data = array(
            'title' => 'Print STPS',
        );
        $data['sampling_det'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE sk_number.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk WHERE sk_number.id_sk = $id")->result();
        $this->load->view('pages/D_printstps', $data);
    }

    public function data_stps()
    {
        $data = array(
            'title' => 'Data STPS',
        );
        $data['stps'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $data['ceksampler'] = $this->db->query("SELECT *,(SELECT count(*) FROM assign_sampler WHERE id_sk = sk_number.id_sk) as st_account FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_liststps', $data);
        $this->load->view('_layout/footer');
    }

    public function add_sampler_stps($id)
    {
        $data = array(
            'title' => 'Add Sampler STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id")->result();
        $data['sampler'] = $this->db->query("SELECT * FROM sampler")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addsamplerstps', $data);
        $this->load->view('_layout/footer');
    }

    public function add_sampler_stps_action()
    {
        $id = $this->input->post('id_sk');
        $this->_rules2();
        if($this->form_validation->run() == FALSE) {
            $this->add_sampler_stps($id);
        } else {

            $id_sampler = $this->input->post('id_sampler');
            $id_sk = $this->input->post('id_sk');
            
            
            $data = array(
                'id_sampler' => $id_sampler,
                'id_sk' => $id_sk,
            );

            $this->web->insert_data($data, 'assign_sampler');
            $this->session->set_flashdata('msg', 'Assignment sampler success.');
            redirect('D_stps/add_sampler_stps/' . $id);
        }
    }

    public function delete_sampler_stps($id, $id_sk)
	{
        $where = array('id_assign' => $id);
		$this->web->delete_data($where, 'assign_sampler');
        $this->session->set_flashdata('msg', 'Sampler success deleted.');
		redirect('D_stps/add_sampler_stps/' . $id_sk);
	}
    
    public function update_sampler_stps($id, $id_sk) {
        $where = array('id_assign' => $id);
        $data = array(
            'title' => 'Update Sampler STPS',
        );
        $data['specialSK'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $data['sampler'] = $this->web->get_data('sampler', 'id_sampler')->result();
        $data['special_assign'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE id_assign = '$id'")->result();
        $data['assign_sampler'] = $this->db->query("SELECT * FROM assign_sampler INNER JOIN sk_number ON assign_sampler.id_sk = sk_number.id_sk INNER JOIN sampler ON assign_sampler.id_sampler = sampler.id_sampler WHERE assign_sampler.id_sk = $id_sk")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addsamplerstps', $data);
        $this->load->view('_layout/footer');
    }

    public function update_sampler_stps_action()
    {
		$id = $this->input->post('id_assign');
		$id_sk = $this->input->post('id_sk');
        $this->_rules2();
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
        redirect('D_stps/add_sampler_stps/' . $id_sk);
		}
    }

    public function _rules2()
    {
        $this->form_validation->set_rules('id_sampler', 'Sampler', 'required');
        $this->form_validation->set_rules('id_sk', 'ID SK');
    }
}