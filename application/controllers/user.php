<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('javascript');
        is_logged_in();
    }


    public function index()
    {
        $data['title'] = 'Citarum Membership';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
        $data['member'] = $this->db->get_where('membership', ['idmembership' => $this->session->userdata('iduser')])->row_array();
        $data['card'] = $this->db->get_where('membership_level', ['idmembershiplevel' => $data['member']['idmembershiplevel']])->row_array();

        $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function editprofile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|integer');
        $user = $data['user'];
        // if ($this->input->post('username') != $user['username']) {
        //     $unique_username = '|is_unique[users.username]';
        // } else {
        //     $unique_username = '';
        // }
        // $this->form_validation->set_rules(
        //     'username',
        //     'Username',
        //     'required|trim' . $unique_username
        // );
        if ($this->input->post('email') != $user['email']) {
            $unique_email = '|is_unique[users.email]';
        } else {
            $unique_email = '';
        }
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email' . $unique_email
        );

        // $my_password = $user['password'];

        // function match_old_password($str)
        // {
        //     $old_password = $this->input->post('password1');
        //     if ($old_password == $str) {
        //         return true;
        //     } else {
        //         $this->form_validation->set_message('match_old_password', 'Password not match with old password!');
        //         return false;
        //     }
        // }

        // match_old_password($my_password);

        // $this->form_validation->set_rules(
        //     'password1',
        //     'Password',
        //     'required|trim|min_length[8]|max_length[20]|callback_match_old_password',
        //     [
        //         'min_length' => 'Password too short!',
        //         'max_length' => 'Password too long!'
        //     ]
        // );
        // $this->form_validation->set_rules(
        //     'passwordnew1',
        //     'New Password',
        //     'required|trim|min_length[8]|max_length[20]|matches[passwordnew2]',
        //     [
        //         'matches' => 'Password not match!',
        //         'min_length' => 'Password too short!',
        //         'max_length' => 'Password too long!'
        //     ]
        // );
        // $this->form_validation->set_rules('passwordnew2', 'New Password', 'required|trim|matches[passwordnew1]');
        // // validasi

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            // $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit-profile', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $address = $this->input->post('address');
            $phone = $this->input->post('phone');

            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('phone', $phone);

            // $userdata = array(
            //     'name' => $name,
            //     'address' => $address,
            //     'phone' => $phone
            // );

            $upload_image = $_FILES['image'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $user['image'];
                    if ($old_image != 'defaultuser.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // $this->db->set($userdata);
            $this->db->where('email', $email);
            $this->db->update('users');

            $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> Your profile has been updated! </div>');
            redirect('user');
        }
    }

    public function settings()
    {
        $data['title'] = 'Settings';
        $data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();

        $user = $data['user'];
        if ($this->input->post('username') != $user['username']) {
            $unique_username = '|is_unique[users.username]';
        } else {
            $unique_username = '';
        }

        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim' . $unique_username
        );

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|max_length[20]',
            [
                'min_length' => 'Password too short!',
                'max_length' => 'Password too long!'
            ]
        );

        $this->form_validation->set_rules(
            'passwordnew1',
            'New Password',
            'required|trim|min_length[8]|max_length[20]|matches[passwordnew2]',
            [
                'matches' => 'Password not match!',
                'min_length' => 'Password too short!',
                'max_length' => 'Password too long!'
            ]
        );
        $this->form_validation->set_rules(
            'passwordnew2',
            'New Password',
            'required|trim|min_length[8]|max_length[20]|matches[passwordnew1]',
            [
                'matches' => 'Password not match!',
                'min_length' => 'Password too short!',
                'max_length' => 'Password too long!'
            ]
        );
        // validasi


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            // $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $old_password = $this->input->post('password1');
            $new_password = $this->input->post('passwordnew1');
            if (password_verify($old_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Wrong old password! You cannot change the password before you enter your old password correctly! </div>');
                redirect('user/settings');
            } else {

                if ($new_password == $old_password) {
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Your new password is same with your old password. </div>');
                    redirect('user/settings');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('users');

                    $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> Your password has been changed!</div>');
                    redirect('user');
                }
            }
        }
    }
}
