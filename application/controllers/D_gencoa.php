<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_gencoa extends CI_Controller 
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

    public function data_quotation()
    {
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> ''")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_listquotation', $data);
        $this->load->view('_layout/footer');
    }
    
    public function data_analysis($id)
    {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_analysiscoa', $data);
        $this->load->view('_layout/footer');
    }
    
    public function input_result($id, $id_int)
    {
        $data = array(
            'title' => 'Data COA',
        );
        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method WHERE result_coa.id_int = $id_int AND result_coa.id_analysis = $id")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_inputresult', $data);
        $this->load->view('_layout/footer');
    }

    public function save_result() {

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
        redirect('D_gencoa/input_result/' . $this->input->post('id_analysis') . '/' . $this->input->post('id_int'));
    }

    public function data_quotation_print()
    {
        $data = array(
            'title' => 'Print COA',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE rtrim(sk_analysis) <> ''")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_listquotation', $data);
        $this->load->view('_layout/footer');
    }

    public function data_analysis_print($id)
    {
        $data = array(
            'title' => 'Data Analysis',
        );
        $data['analysis'] = $this->db->query("SELECT * FROM analysis INNER JOIN quotation ON analysis.id_analysis = quotation.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_sk = $id AND analysis.coa = 1")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_analysiscoa', $data);
        $this->load->view('_layout/footer');
    }

    public function renderQR($id_sk) {
        $cipher = "AES-256-CBC";
        $secret = "12345678901234567890123456789012";
        $options = 0;
        $iv = str_repeat("0", openssl_cipher_iv_length($cipher));
        $encrypt = openssl_encrypt($id_sk, $cipher, $secret, $options, $iv);
        //render qr code dengan format gambar png
        QRcode::png(
            $encrypt,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 3.5,
            $margin = 1
        );
    }

    public function print_coa($id_int) {
        $data = array(
            'title' => 'Print COA',
        );

        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_int = $id_int")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_int = $id_int")->result();

        $this->load->view('pages/D_printcoa', $data);
    }

    public function pdf_coa($id_int) {
        $this->load->library('dompdf_gen');
        $data = array(
            'title' => 'Export PDF',
        );

        $data['coa'] = $this->db->query("SELECT * FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_int = $id_int")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk WHERE quotation.id_int = $id_int")->result();

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('pages/D_pdfcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA.pdf", array('Attachment' => 0));

    }

    public function templating_coa() {
        $data = array(
            'title' => 'Templating COA'
        );

        $data['analysis'] = $this->web->get_data('analysis', 'id_analysis')->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_templatecoa', $data);
        $this->load->view('_layout/footer');
    }
}