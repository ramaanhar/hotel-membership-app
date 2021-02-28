<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    //konstruktor
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    //halaman login
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login | E-Membership Citarum Hotel';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->login();
        }
    }

    //aturan login (fungsi private)
    private function login()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('users', ['email' => $email])->row_array();

        if ($user) {
            if ($user['isactive'] == '1') {
                if (password_verify($password, $user[password])) {
                    $data = [
                        'iduser' => $user['iduser'],
                        'email' => $user['email'],
                        'idrole' => $user['idrole']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['idrole'] == 1) {
                        redirect('admin');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> Wrong password! </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> The email has not been activated. Please activate the email first! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class = "alert alert-danger" role="alert"> The email is not registered. </div>');
            redirect('auth');
        }
    }

    //registrasi dan input data ke database
    public function registration()
    {
        if ($this->session->userdata('username')) {
            redirect('admin');
        }

        //rules untuk inputan registrasi
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nik', 'Citizen ID', 'required|trim|integer');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('phone', 'Phone Number', 'required|trim|integer');
        $this->form_validation->set_rules(
            'username',
            'Username',
            'required|trim|is_unique[users.username]',
            [
                'is_unique' => 'This username has been used! Please choose another username.'
            ]
        );
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[users.email]',
            [
                'is_unique' => 'This email has been used! Please choose another email.'
            ]
        );

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|max_length[20]|matches[password2]',
            [
                'matches' => 'Password not match!',
                'min_length' => 'Password too short!',
                'max_length' => 'Password too long!'
            ]
        );
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        // validasi
        // Jika form belum terisi semua -> kembali ke halaman registrasi
        // jika form sudah terisi semua -> simpan data ke database
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registration | E-Membership Citarum Hotel';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {

            $q = $this->db->query("SELECT MAX(RIGHT(idmembership,8)) AS suffix_max FROM membership WHERE DATE(datecreated)=CURDATE()");
            $suffix = "";
            if ($q->num_rows() > 0) {
                foreach ($q->result() as $k) {
                    $tmp = ((int) $k->suffix_max) + 1;
                    $suffix = sprintf("%08s", $tmp);
                }
            } else {
                $suffix = '10000001';
            }
            // date_default_timezone_set('Asia/Jakarta');
            $idmember = date('Ymd') . $suffix;

            $user_data = [

                'iduser' => $idmember,
                'name' => htmlspecialchars($this->input->post('name', true)),
                'nik_ktp' => $this->input->post('nik'),
                'address' => $this->input->post('address'),
                'gender' => $this->input->post('gender'),
                'phone' => $this->input->post('phone'),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                // 'password' => $this->input->post('password1'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => "defaultuser.jpg",
                'idrole' => "2",
                'isactive' => "1",
                'datecreated' => date('Y-m-d H:i:s'),
                'dateupdated' => date('Y-m-d H:i:s'),
                'createdby' => null,
                'updatedby' => null

            ];

            // Buat QR code
            $this->load->library('ciqrcode');
            //isi data untuk QR code
            $params['data'] =
                'Name : ' . $user_data['name'] . '\n' .
                'Email : ' . $user_data['email'] . '\n' .
                'Membership code : ' . $user_data['iduser'];
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['savename'] = FCPATH . 'assets/img/qr/myqr' . $idmember . '.png';
            $this->ciqrcode->generate($params);

            // buat barcode
            $this->load->library('zend');

            //load yang ada di folder Zend
            $this->zend->load('Zend/Barcode');

            //generate barcodenya

            $kode = $user_data['iduser'];
            $file = Zend_Barcode::draw('code128', 'image', array('text' => $kode), array());

            $store_image = imagepng($file, FCPATH . 'assets/img/barcode/brcd' . $kode . '.png');

            $member_data = [

                'datecreated' => date('Y-m-d H:i:s'),
                'dateupdated' => date('Y-m-d H:i:s'),
                'idmembership' => $idmember,
                'membershipname' => $user_data['name'],
                'qrcode' => 'myqr' . $user_data['iduser'] . '.png',
                'barcode' => 'brcd' . $idmember . '.png',
                'status' => 'valid',
                'idmembershiplevel' => 1,
                'createdby' => null,
                'updatedby' => null

            ];
            $map_data = [

                'iduser' => $user_data['iduser'],
                'idmembership' => $member_data['idmembership'],
                'startdate' => date('Y-m-d H:i:s'),
                'enddate' => date('Y-m-d H:i:s', strtotime('+1 year')),
                'status' => 'valid',
                'createdby' => null,
                'datecreated' => date('Y-m-d H:i:s'),
                'updatedby' => null,
                'dateupdated' => date('Y-m-d H:i:s')

            ];
            $this->db->insert('users', $user_data);
            $this->db->insert('membership', $member_data);
            $this->db->insert('map_user_membership', $map_data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role="alert"> Congratulation! Your account has been created! Please login. </div>');
            redirect('auth');
        }
    }


    public function logout()
    {
        $this->session->unset_userdata('iduser');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('idrole');
        $this->session->set_flashdata('message', '<div class = "alert alert-success" role="alert"> You have been logged out! </div>');
        redirect('auth');
    }

    public function denied()
    {
        $data['title'] = '403 Access Forbidden!';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/denied');
        $this->load->view('templates/footer');
    }

    public function notfound()
    {
        $data['title'] = '404 Page Not Found!';
        $this->load->view('templates/header', $data);
        $this->load->view('auth/notfound');
        $this->load->view('templates/footer');
    }
}
