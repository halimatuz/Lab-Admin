<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_coa extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysisCOA'] = $this->db->query("SELECT *,(SELECT count(*) FROM coa WHERE id_analysis = analysis.id_analysis) as st_account FROM analysis WHERE coa = 1")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_listanalysis', $data);
        $this->load->view('_layout/footer');
    }

    public function add_coa($id)
    {
        $data = array(
            'title' => 'Add COA',
        );
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id'")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addcoa', $data);
        $this->load->view('_layout/footer');
    }

    public function add_coa_action()
    {
        $id = $this->input->post('id_analysis');
        $this->_rules();
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
            redirect('D_coa/add_coa/' . $id);
        }
    }

    public function _rules()
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
        $where = array('id_coa' => $id);
		$this->web->delete_data($where, 'coa');
        $this->session->set_flashdata('msg', 'Data COA success deleted.');
		redirect('D_coa/add_coa/' . $id_anl);
	}

    public function update_coa($id, $id_anl) {
        $where = array('id_coa' => $id);
        $data = array(
            'title' => 'Data COA',
        );
        $data['specialAnalysis'] = $this->db->query("SELECT * FROM analysis WHERE id_analysis = '$id_anl'")->result();
        $data['coa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE coa.id_analysis = '$id_anl'")->result();
        $data['specialcoa'] = $this->db->query("SELECT * FROM coa INNER JOIN method ON coa.method = method.id_method WHERE id_coa = '$id'")->result();
        $data['methods'] = $this->db->query("SELECT * FROM method")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addcoa', $data);
        $this->load->view('_layout/footer');
    }

    public function update_coa_action()
    {
		$id = $this->input->post('id_coa');
        $id_anl = $this->input->post('id_analysis');
        $this->_rules();
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
        redirect('D_coa/add_coa/' . $id_analysis);
		}
    }

}