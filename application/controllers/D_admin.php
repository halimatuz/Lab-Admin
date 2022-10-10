<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_admin extends CI_Controller 
{
    public function index() {
        $data = array(
            'title' => "Dashboard"
        );
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['total_sampler'] = $this->web->get_count('sampler');
        $data['total_institution'] = $this->web->get_count('institution');
        $data['total_analysis'] = $this->web->get_count('analysis');
        $data['total_quotation'] = $this->web->get_count('sk_number');
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_index');
        $this->load->view('_layout/footer');
    }
}