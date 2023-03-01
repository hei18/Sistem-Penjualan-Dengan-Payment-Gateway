<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('mdl_artist', 'artist');
        $this->load->model('mdl_artist', 'songs');
        $this->load->model('mdl_artist', 'cs');
        $this->load->model('mdl_artist', 'bm');
        #$this->load->model('mdl_auth', 'ps');
        $this->load->library('form_validation');
        $this->load->library('encryption');
    }

    public function index()
    {

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email',
            [
                'required' => 'Tidak Boleh Kosong',
                'valid_email' => 'Email Tidak Valid'

            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[4]',
            [
                'required' => 'Tidak Boleh Kosong',

                'min_length' => 'Password Terlalu Pendek'

            ]
        );
        if ($this->form_validation->run() == false) {
            $fetch['header'] = "BeatAudio";
            $this->load->view('layout/ds-header-home', $fetch);
            $this->load->view('auth/login');
            $this->load->view('layout/ds-footer-home');
        } else {
            $this->_doLogin();
        }
    }

    private function _doLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row();
        $admin = $this->db->get_where('administrator', ['email' => $email])->row();
        // echo '<pre>';
        // var_dump($admin);
        // echo '</pre>';
        // die;
        $customer = $this->db->get_where('customer', ['email' => $email])->row();

        $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
        role="alert">
        <span class="alert-text">
        Silahkan Verifikasi Akun Anda!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        $req_alert = '<div class="alert alert-danger alert-dismissible fade show"
        role="alert">
        <span class="alert-text">
        Anda Tidak Punya Akses Lagi</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        $password_alert = '<div class="alert alert-danger alert-dismissible fade show"
        role="alert">
        <span class="alert-text">
        Email Atau Password Tidak Valid</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        $false_alert = '<div class="alert alert-danger alert-dismissible fade show"
        role="alert">
        <span class="alert-text">
       User Tidak Ada</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';

        if ($user) {
            $json = $user->password;
            if (password_verify($password, $json)) {
                $activated = $user->is_active;
                $req = $user->request_delete;
                if ($activated == 1) {
                    $id_user = $user->id_user;
                    $nickname = $user->nickname;
                    $emails = $user->email;
                    $role = $user->role;

                    $data = [
                        'id_user' => $id_user,
                        'nickname' => $nickname,
                        'email' => $emails,
                        'role' => $role,
                    ];
                    $this->session->set_userdata('logged_in', true);
                    $this->session->set_userdata($data);

                    if ($role == "beatmaker") {
                        redirect('publics');
                    }
                } elseif ($activated == 0 && $req == "DELETED") {
                    $this->session->set_flashdata('message', $req_alert);
                    redirect('auth');
                } elseif ($activated == 0) {
                    $this->session->set_flashdata('message', $active_alert);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', $password_alert);
                redirect('auth');
            }
        } elseif ($customer) {
            $json = $customer->password;
            if (password_verify($password, $json)) {
                $activated = $customer->is_active;
                $req = $customer->request_delete;
                if ($activated == 1) {
                    $id_cs = $customer->id_cs;
                    $nickname = $customer->nickname;
                    $emails = $customer->email;
                    $role = $customer->role;

                    $data = [
                        'id_cs' => $id_cs,
                        'nickname' => $nickname,
                        'email' => $emails,
                        'role' => $role,
                    ];


                    $this->session->set_userdata($data);

                    if ($role == "customer") {
                        redirect('publics');
                    }
                } elseif ($activated == 0 && $req == "DELETED") {
                    $this->session->set_flashdata('message', $req_alert);
                    redirect('auth');
                } elseif ($activated == 0) {
                    $this->session->set_flashdata('message', $active_alert);
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', $password_alert);
                redirect('auth');
            }
        } elseif ($admin) {
            $definePasword = $admin->password;
            if (password_verify($password, $definePasword)) {
                $activated = $admin->is_active;
                if ($activated == 1) {
                    $defineIdAdmin = $admin->id_admin;
                    $defineRole = $admin->role;
                    $defineEmail = $admin->email;

                    $data = [
                        'id_admin'  => $defineIdAdmin,
                        'role' => $defineRole,
                        'email' => $defineEmail
                    ];

                    $this->session->set_userdata($data);

                    if ($defineRole == 'admin') {
                        redirect('admin/dashboard');
                    }
                }
            } else {
                $this->session->set_flashdata('message', $password_alert);
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', $false_alert);
            redirect('auth');
        }
    }

    public function register()
    {

        $role = $this->input->post('role', true);
        if ($role == "beatmaker") {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|trim|valid_email|is_unique[user.email]',
                [
                    'is_unique' => 'Email ini sudah ada!'
                ]
            );
        } elseif ($role == "customer") {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|trim|valid_email|is_unique[customer.email]',
                [
                    'is_unique' => 'Email ini sudah ada!'
                ]
            );
        }

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[4]|matches[password2]',
            [
                'required' => 'Tidak Boleh Kosong!',

                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Password Terlalu Pendek!'

            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'required' => 'Tidak Boleh Kosong!',
                'matches' => 'Password Tidak Sama!',
                'min_length' => 'Password Terlalu Pendek!'

            ]

        );

        $this->form_validation->set_rules(
            'role',
            'Role',
            'required',
            [
                'required' => 'Tidak Boleh Kosong!',

            ]

        );

        if ($this->form_validation->run() == false) {
            $fetch['header'] = "BeatAudio";
            $this->load->view('layout/ds-header-home', $fetch);
            $this->load->view('auth/register');
            $this->load->view('layout/ds-footer-home');
        } else {
            $nickname = 'BeatAudio User';
            $email = $this->input->post('email', true);
            $password1 = $this->input->post('password1', true);
            if ($role == "beatmaker") {
                $data = [
                    'nickname' => $nickname,
                    'image' => 'default.jpg',
                    'email' => $email,
                    'password' => password_hash($password1, PASSWORD_DEFAULT),
                    'role' => "beatmaker",
                    'is_active' => 0,
                    'date_created' => time(),

                ];
                $this->db->insert('user', $data);
            } elseif ($role == "customer") {

                $data2 = [
                    'nickname' => $nickname,
                    'image' => 'default.jpg',
                    'email' => $email,
                    'password' => password_hash($password1, PASSWORD_DEFAULT),
                    'role' => "customer",
                    'is_active' => 0,
                    'date_created' => time(),

                ];
                $this->db->insert('customer', $data2);
            }




            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');
            // var_dump($data);
            // die;
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                    Akun Sudah Dibuat Silahkan Check Email Anda</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('auth');
        }
    }


    private function _sendEmail($token, $type)
    {

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'beataudio1812@gmail.com',
            'smtp_pass' => 'coihrjfpbftfoqyd',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];
        $this->email->initialize($config);



        $email = $this->input->post('email');
        $encode = urlencode($token);

        $define_email = base64_encode($email);
        date_default_timezone_set('Asia/Jakarta');

        $data1['act'] = [
            'year' => date("Y"),
            'email' => $define_email,
            'token' => $encode,

        ];
        $registMessage = $this->load->view('email-sent/activation', $data1, TRUE);



        $forgotMessage = $this->load->view('email-sent/forgot-password', $data1, TRUE);
        $this->email->from('beataudio1812@gmail.com', 'Beat Audio');
        $this->email->to($email);
        if ($type == 'verify') {

            $this->email->subject('Verifikasi Akun - ' . time());
            $this->email->message($registMessage);
        } elseif ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message($forgotMessage);
        }


        $this->load->library('email', $config);

        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');


        $define_email = base64_decode($email);

        // var_dump($define_email);

        $user = $this->db->get_where('user', ['email' => $define_email])->row();
        $customer = $this->db->get_where('customer', ['email' =>  $define_email])->row();

        // var_dump($customer);
        // die;
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row();
            // $json = json_encode($user_token);
            if ($user_token) {
                $json = $user_token->date_created;
                if (time() - $json < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $define_email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $define_email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $define_email . ' Sudah aktif,silahkan login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $define_email]);
                    $this->db->delete('user_token', ['email' => $define_email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, token salah.</div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, token salah..</div>');
                redirect('auth');
            }
        } elseif ($customer) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row();
            if ($user_token) {
                $json = $user_token->date_created;
                if (time() - $json < (60 * 60 * 24)) {
                    // echo "ada";
                    // var_dump($user_token);
                    // die;
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $define_email);
                    $this->db->update('customer');

                    $this->db->delete('user_token', ['email' => $define_email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $define_email . ' has been activated! Please login.</div>');
                    redirect('auth');
                } else {
                    $this->db->delete('customer', ['email' => $define_email]);
                    $this->db->delete('user_token', ['email' => $define_email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, token salah.</div>');
                    redirect('auth');
                }
            } else {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, token salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi akun gagal, token salah</div>');
            redirect('auth');
        }
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $fetch['header'] = "BeatAudio";
            $this->load->view('layout/ds-header-home', $fetch);
            $this->load->view('auth/forgot-password');
            $this->load->view('layout/ds-footer-home');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row();
            $customer = $this->db->get_where('customer', ['email' => $email, 'is_active' => 1])->row();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Check Email Untuk Reset Password</div>');
                redirect('auth/forgotPassword');
            } elseif ($customer) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Check Email Untuk Reset Password</div>');
                redirect('auth/forgotPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email atau Password Tidak Valid</div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $define_email = base64_decode($email);
        $user = $this->db->get_where('user', ['email' =>  $define_email])->row();
        $customer = $this->db->get_where('customer', ['email' =>  $define_email])->row();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row();

            if ($user_token) {
                $this->session->set_userdata('reset_email_bm',  $define_email);
                $this->changepassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal, Token Salah</div>');
                redirect('auth');
            }
        } elseif ($customer) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row();

            if ($user_token) {
                $this->session->set_userdata('reset_email_cs',  $define_email);
                $this->changepassCS();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal, Token Salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal</div>');
            redirect('auth');
        }
    }
    public function changepassCS()
    {
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[4]|matches[password2]',
            [
                'required' => 'Tidak Boleh Kosong',
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'

            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'required' => 'Tidak Boleh Kosong',
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'

            ]

        );
        if ($this->form_validation->run() == false) {
            $fetch['header'] = "BeatAudio";

            $this->load->view('layout/ds-header-home', $fetch);
            $this->load->view('auth/reset-password-cs');
            $this->load->view('layout/ds-footer-home');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $emailCs = $this->session->userdata('reset_email_cs');
            $data = [
                'password' => $password
            ];
            $this->cs->updateEmailCs($emailCs, $data, 'customer');


            $this->db->delete('user_token', ['email' => $emailCs]);

            $this->session->unset_userdata('reset_email_cs');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Berhasil Diubah, Silahkan Login</div>');
            redirect('auth');
        }
    }
    public function changepassword()
    {
        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[4]|matches[password2]',
            [
                'required' => 'Tidak Boleh Kosong',
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'

            ]
        );
        $this->form_validation->set_rules(
            'password2',
            'Password',
            'required|trim|matches[password1]',
            [
                'required' => 'Tidak Boleh Kosong',
                'matches' => 'Password Tidak Sama',
                'min_length' => 'Password Terlalu Pendek'

            ]

        );
        if ($this->form_validation->run() == false) {
            $fetch['header'] = "BeatAudio";

            $this->load->view('layout/ds-header-home', $fetch);
            $this->load->view('auth/reset-password');
            $this->load->view('layout/ds-footer-home');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $emailBm = $this->session->userdata('reset_email_bm');

            $data = [
                'password' => $password
            ];
            $this->bm->updateEmailBm($emailBm, $data, 'user');

            $this->db->delete('user_token', ['email' => $emailBm]);

            $this->session->unset_userdata('reset_email_bm');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password Telah Diubah, Silahkan Login</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_cs');
        $this->session->unset_userdata('nickname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar</div>');
        redirect('auth');
    }

    public function check()
    {
        $data1['act'] = [
            'year' => date("Y")
        ];
        $this->load->view('email-sent/activation', $data1);
    }

    public function checks()
    {
        $this->load->view('check');
    }
}
