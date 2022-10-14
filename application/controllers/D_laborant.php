<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_laborant extends CI_Controller 
{
    public function index() {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth/errors_403');
		} else {
            $data = array(
                'title' => "Dashboard"
            );
            
            $data['total_sampler'] = $this->web->get_count('sampler');
            $data['total_institution'] = $this->web->get_count('institution');
            $data['total_analysis'] = $this->web->get_count('analysis');
            $data['total_quotation'] = $this->web->get_count('sk_number');
            $this->load->view('laborant/_layout/header', $data);
            $this->load->view('laborant/_layout/sidebar');
            $this->load->view('laborant/pages/index');
            $this->load->view('laborant/_layout/footer');
        }
    }

    public function data_gen_coa()
    {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int")->result();
        $this->load->view('laborant/_layout/header', $data);
        $this->load->view('laborant/_layout/sidebar');
        $this->load->view('laborant/pages/D_listquotation', $data);
        $this->load->view('laborant/_layout/footer');
        }
    }

    public function data_quotation_coa()
    {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> '' ORDER BY sk_number.id_sk DESC")->result();
        $this->load->view('laborant/_layout/header', $data);
        $this->load->view('laborant/_layout/sidebar');
        $this->load->view('laborant/pages/D_listquotation', $data);
        $this->load->view('laborant/_layout/footer');
    }
    }
    
    public function data_analysis_coa($id)
    {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('laborant/_layout/header', $data);
        $this->load->view('laborant/_layout/sidebar');
        $this->load->view('laborant/pages/D_analysiscoa', $data);
        $this->load->view('laborant/_layout/footer');
    }
    }
    
    public function input_result($id, $id_sk)
    {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => 'Data COA',
        );
        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method WHERE result_coa.id_sk = $id_sk AND result_coa.id_analysis = $id")->result();
        $this->load->view('laborant/_layout/header', $data);
        $this->load->view('laborant/_layout/sidebar');
        $this->load->view('laborant/pages/D_inputresult', $data);
        $this->load->view('laborant/_layout/footer');
    }
    }

    public function save_result() {
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $id_result = $this->input->post('id_result');
        $result = $this->input->post('result');
        $id_sk = $this->input->post('id_sk');
        $today = date ( "d/m/Y" );
        $no_certificate = 'DIL-' . date('Y') . date('m') . date('d') . 'COA';

        $data_number = array(
            'no_certificate' => $no_certificate,
            'date_report' => $today
        );
        
        $where_sk = array(
            'id_sk' => $id_sk
        );

        for($i=0; $i<sizeof($id_result); $i++) {

            $data = array(
                'result' => $result[$i],
            );

            $where = array(
                'id_result' => $id_result[$i]
            );

            $this->web->update_data('result_coa', $data, $where);
        }

        $this->web->update_data('sk_number', $data_number, $where_sk);
        $this->session->set_flashdata('msg', 'Input result success!');
        redirect('D_laborant/input_result/' . $this->input->post('id_analysis') . '/' . $id_sk);
        }
    }

    public function profile(){
        $sess = $this->session->userdata('id_laborant');
		if ($sess == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">You don\'t have permission, please login first</div>');
			redirect('D_auth');
		} else {
        $data = array(
            'title' => "Profile"
        );
        $data['user'] = $this->db->query("SELECT * FROM user WHERE email = '$sess'")->result();
        $this->load->view('laborant/_layout/header', $data);
        $this->load->view('laborant/_layout/sidebar');
        $this->load->view('laborant/pages/D_profile');
        $this->load->view('laborant/_layout/footer');
    }
    }
}