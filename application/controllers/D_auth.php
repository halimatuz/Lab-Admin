<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class D_auth extends CI_Controller 
{
    public function index() {
        $sess_superadmin = $this->session->userdata('id_superadmin');
        $sess_admin = $this->session->userdata('id_admin');
        $sess_marketing = $this->session->userdata('id_marketing');
        $sess_analyst = $this->session->userdata('id_analyst');
		if ($sess_superadmin != NULL) {
			redirect('D_superadmin');
        } elseif($sess_admin != NULL) {
            redirect('D_admin');
        } elseif($sess_marketing != NULL) {
            redirect('D_marketing');
        } elseif($sess_analyst != NULL) {
            redirect('D_analyst');
		} else {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if($this->form_validation->run() == false) {
                $data = array(
                    'title' => "Login"
                );
                $this->load->view('_layout/header_auth', $data);
                $this->load->view('pages/D_login');
            } else {
                $this->_login();
            }
        }
    }

    private function _login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user) {
            if (password_verify($password, $user['password'])) {
                if($user['role'] == 'superadmin') {
                    $data = array(
                        'id_superadmin' => $user['email'],
                        'role' => $user['role'],
                        'fullname' => $user['fullname'],
                    );
                } elseif($user['role'] == 'admin') {
                    $data = array(
                        'id_admin' => $user['email'],
                        'role' => $user['role'],
                        'fullname' => $user['fullname'],
                    );
                } elseif($user['role'] == 'marketing') {
                    $data = array(
                        'id_marketing' => $user['email'],
                        'role' => $user['role'],
                        'fullname' => $user['fullname'],
                    );
                } elseif($user['role'] == 'analyst') {
                    $data = array(
                        'id_analyst' => $user['email'],
                        'role' => $user['role'],
                        'fullname' => $user['fullname'],
                    );
                }

                if($user['role'] == 'superadmin') {
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('msglogin', 'You are logged in as Super Admin!');
                    redirect('D_superadmin');
                }
                if($user['role'] == 'admin') {
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('msglogin', 'You are logged in as Admin!');
                    redirect('D_admin');
                }
                if($user['role'] == 'marketing') {
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('msglogin', 'You are logged in as Marketing!');
                    redirect('D_marketing');
                }
                if($user['role'] == 'analyst') {
                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('msglogin', 'You are logged in as Analyst!');
                    redirect('D_analyst');
                }
                
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                  <button class="close" data-dismiss="alert">
                    <span>&times;</span>
                  </button>
                  Wrong Password.
                </div>
              </div>');
                redirect('D_auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
              <button class="close" data-dismiss="alert">
                <span>&times;</span>
              </button>
              Email not registered.
            </div>
          </div>');
            redirect('D_auth');
        }
        
    }

    public function logout() {
        $this->session->unset_userdata('id_admin');
        $this->session->unset_userdata('id_marketing');
        $this->session->unset_userdata('id_superadmin');
        $this->session->unset_userdata('id_analyst');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('fullname');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
          You have been logout!
        </div>
      </div>');
        redirect('D_auth');
    }

    public function errors_403() {
        $data = array(
            'title' => "403"
        );
        $this->load->view('D_error_403', $data);
    }

    public function approve($encrypt) {
        // Decrypt params
        $encrypt_method = "AES-256-CBC";
        $secret_key = "XDT-YUGHH-GYGF-YUTY-GHRGFR";
        $iv = "DASFDSYHFSDUYFFSD";
        $id_sk = base64_decode($encrypt);
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $iv), 0, 16);
        $id_sk = openssl_decrypt($id_sk, $encrypt_method, $key, 0, $iv);

        $data = array(
            'title' => 'Approve COA'
        );

        $data_status = array (
            'status_approve' => 1,
        );

        $where = array (
            'id_sk' => $id_sk
        );
        $this->web->update_data('sk_number', $data_status, $where);
        $this->session->set_flashdata('msg', 'COA success verified!');
        
        $data['result'] = $this->db->query("SELECT * FROM sk_number INNER JOIN institution ON sk_number.id_int = institution.id_int WHERE id_sk = $id_sk")->result();
        $this->load->view('pages/D_approve', $data);
        $this->load->view('_layout/footer');
    }
}