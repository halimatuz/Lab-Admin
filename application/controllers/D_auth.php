<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class D_auth extends CI_Controller 
{
    public function index() {
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

    private function _login() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user) {
            if (password_verify($password, $user['password'])) {
                $data = array(
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                );
                $this->session->set_userdata($data);
                redirect('D_admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('D_auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('D_auth');
        }
        
    }

    public function list_users()
    {
        $data = array(
            'title' => 'List Users',
        );
        $data['user'] = $this->db->query("SELECT * FROM user")->result();
        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_listusers', $data);
        $this->load->view('_layout/footer');
    }

    public function add_user() {
        $data = array(
            'title' => "Add User"
        );

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar');
        $this->load->view('pages/D_adduser');
        $this->load->view('_layout/footer');
    }

    public function add_user_action() {
        $this->form_validation->set_rules('fullname', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|matches[password]');
        if($this->form_validation->run() == false) {
            $this->add_user();
        } else {
            $data = array(
                'fullname' => htmlspecialchars($this->input->post('fullname', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => 1,
                'date_created' => time()
            );

            $this->db->insert('user', $data);
            $this->session->set_flashdata('msg', 'User success added!');
            redirect('D_auth/list_users/');
        }
    }

    public function logout() {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout!</div>');
        redirect('D_auth');
    }
}