<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_templatingcoa extends CI_Controller 
{

    public function index() {
        $data = array(
            'title' => 'Templating COA'
        );

        $data['analysis'] = $this->db->query("SELECT * FROM analysis WHERE coa = 1")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_templatecoa', $data);
        $this->load->view('_layout/footer');
    }

    public function add_template($id) {
        $data = array(
            'title' => 'Templating COA'
        );
        

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addtemplate', $data);
        $this->load->view('_layout/footer');
    }
}