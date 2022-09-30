<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function

class D_sampling extends CI_Controller 
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

    public function add_quotation($id)
    {
        $data = array(
            'title' => 'Add quotation',
        );
        $data['specialInstitution'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id'")->result();
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_int = sk_number.id_int WHERE quotation.id_int = '$id'")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addquotation', $data);
        $this->load->view('_layout/footer');
    }

    public function add_quotation_action()
    {
        $id = $this->input->post('id_int');
        $this->_rules();
        if($this->form_validation->run() == FALSE) {
            $this->add_quotation($id);
        } else {

            $id_int = $this->input->post('id_int');

            // create SK NUMBER
            $sql = $this->db->query("SELECT MAX(id_sk) AS maxID FROM sk_number")->result();
            foreach($sql as $sql2) {
                $code = $sql2->maxID;
            }
            $code++;
            $sk_quotation = $code . '/' . date('Y') . '/' . date('d') . '/' . "DIL/QTN";
            $cek_sk = $this->db->query("SELECT * FROM sk_number WHERE id_int = $id_int")->result();
            // end SK Number

            

            if($cek_sk == NULL) {
                $data_sk = array(
                    'sk_quotation' => $sk_quotation,
                    'sk_sample' => '',
                    'sk_analysis' => '',
                    'id_int' => $id_int,
                );
                $this->web->insert_data($data_sk, 'sk_number');
            }

            $id_analysis = $this->input->post('id_analysis');
            $remarks = $this->input->post('remarks');
            $spec = $this->input->post('spec');
            $qty = $this->input->post('qty');
            $add_price = $this->input->post('add_price');
            $id_sk = $this->db->query("SELECT * FROM sk_number WHERE id_int = $id_int")->result();

            foreach($id_sk as $sk) {
                $sk_qtn = $sk->id_sk;
            }

            

            $data_qtn = array(
                'id_analysis' => $id_analysis,
                'id_int' => $id_int,
                'remarks' => $remarks,
                'spec' => $spec,
                'qty' => $qty,
                'id_sk' => $sk_qtn,
                'add_price' => $add_price,
            );

            $this->web->insert_data($data_qtn, 'quotation');
            $this->session->set_flashdata('msg', 'Data Quotation success added.');
            redirect('D_quotation/add_quotation/' . $id);
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_analysis', 'Analysis', 'required');
        $this->form_validation->set_rules('id_int', 'Institution', 'required');
        $this->form_validation->set_rules('remarks', 'Remarks', 'required');
        $this->form_validation->set_rules('spec', 'Specification', 'required');
        $this->form_validation->set_rules('qty', 'Quantity', 'required');
        $this->form_validation->set_rules('id_sk', 'SK Number');
        $this->form_validation->set_rules('add_price', 'Additional Price', 'required');
    }

    public function delete_quotation($id, $id_int)
	{
        $where = array('id_quotation' => $id);
		$this->web->delete_data($where, 'quotation');
        $this->session->set_flashdata('msg', 'Data Quotation success deleted.');
		redirect('D_quotation/add_quotation/' . $id_int);
	}

    public function update_quotation($id_int, $id) {
        $where = array('id_quotation' => $id);
        $data = array(
            'title' => 'Data Quotation',
        );
        $data['specialInstitution'] = $this->db->query("SELECT * FROM institution WHERE id_int = '$id_int'")->result();
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN sk_number ON quotation.id_int = sk_number.id_int WHERE quotation.id_int = '$id_int'")->result();
        $data['specialQuotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis INNER JOIN institution ON quotation.id_int = institution.id_int WHERE quotation.id_quotation = '$id'")->result();
        $data['analysis'] = $this->db->query("SELECT * FROM analysis")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_addquotation', $data);
        $this->load->view('_layout/footer');
    }

    public function update_quotation_action()
    {
		$id = $this->input->post('id_quotation');
		$id_int = $this->input->post('id_int');
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update_quotation($id_int, $id);
        } else {
            $id_analysis = $this->input->post('id_analysis');
            $remarks = $this->input->post('remarks');
            $spec = $this->input->post('spec');
            $qty = $this->input->post('qty');
            $add_price = $this->input->post('add_price');
            $id_sk = $this->input->post('id_sk');

        $data = array(
            'id_analysis' => $id_analysis,
            'id_int' => $id_int,
            'remarks' => $remarks,
            'spec' => $spec,
            'qty' => $qty,
            'id_sk' => $id_sk,
            'add_price' => $add_price,
        );

        $where = array(
            'id_quotation' => $id
        );
        $this->web->update_data('quotation', $data, $where);
        $this->session->set_flashdata('msg', 'Data Quotation success changed!');
        redirect('D_quotation/add_quotation/' . $id_int);
		}
    }

    public function print_quotation($id) {
        $data = array(
            'title' => 'Print Quotation',
        );
        $data['quotation'] = $this->db->query("SELECT * FROM quotation INNER JOIN sk_number ON quotation.id_sk = sk_number.id_sk INNER JOIN institution ON quotation.id_int = institution.id_int INNER JOIN analysis ON quotation.id_analysis = analysis.id_analysis WHERE quotation.id_int = $id")->result();
        $this->load->view('pages/D_printquotation', $data);
    }
}