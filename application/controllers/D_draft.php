<?php
defined('BASEPATH') or exit('No direct script access allowed');

class D_draft extends CI_Controller 
{

    public function draft_coa($encrypt) {

        $this->load->library('dompdf_gen');
        $data = array(
            'title' => 'Export PDF',
        );

        // Decrypt params
        $encrypt_method = "AES-256-CBC";
        $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR";
        $iv = "DASFDSYHFSDUYFFSD";
        $id_sk = base64_decode($encrypt);
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $iv), 0, 16);
        $id_sk = openssl_decrypt($id_sk, $encrypt_method, $key, 0, $iv);

        $data['company'] = $this->db->query("SELECT * FROM company_profile")->result();
        $data['coa'] = $this->db->query("SELECT *, result_coa.sampling_location AS sampling_location_coa,result_coa.time AS time_coa  FROM result_coa INNER JOIN analysis ON result_coa.id_analysis = analysis.id_analysis INNER JOIN coa ON result_coa.id_coa = coa.id_coa INNER JOIN institution ON result_coa.id_int = institution.id_int INNER JOIN method ON coa.method = method.id_method INNER JOIN sk_number ON result_coa.id_sk = sk_number.id_sk WHERE result_coa.id_sk = $id_sk")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM sampling_det INNER JOIN analysis ON sampling_det.id_analysis = analysis.id_analysis INNER JOIN sk_number ON sampling_det.id_sk = sk_number.id_sk WHERE sampling_det.id_sk = $id_sk AND analysis.coa = 1")->result();
        $data['count'] = count($data['analysis']) + 1;

        $paper_size = 'A4';
        $orientation = 'potrait';
        $html = $this->load->view('pages/D_draftcoa', $data, TRUE);;
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("COA.pdf", array('Attachment' => 0));
    }

}