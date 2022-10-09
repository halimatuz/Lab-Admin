<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_scancoa extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'Scan COA',
        );
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_scancoa');
        $this->load->view('_layout/footer');
    }

    public function cek_id()
	{
		$id_sk = $this->input->post('id_sk');
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $options = 0;
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $decrypted = openssl_decrypt($id_sk, $cipher, $secret, $options, $iv);
		$cek_id = $this->web->cek_id($decrypted);
        if(!$cek_id) {
            $this->session->set_flashdata('error', 'Unknown QR Code!');
            redirect('D_scancoa');
        } else {
            $data = array(
                'title' => 'Result Scan',
            );
    
            $data['result'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $decrypted")->result();
            $this->load->view('pages/D_resultscan', $data);
            $this->load->view('_layout/footer');
        }
	}

}