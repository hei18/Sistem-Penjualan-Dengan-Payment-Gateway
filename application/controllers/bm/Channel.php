<?php
defined('BASEPATH') or exit('No direct script access allowed');
#require FCPATH.'/vendor/autoload.php';
class Channel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        as_bm();
        $this->load->library('form_validation');
        $this->load->library('pdf');

        $this->load->helper('download');

        $this->load->model('mdl_bm', 'user');
        $this->load->model('mdl_bm', 'users');
        $this->load->model('mdl_bm', 'checkProductId');
        $this->load->model('mdl_bm', 'displayBeat');
        $this->load->library('encryption');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['header'] = "BeatAudio Studio";
        $fetch['tittle'] = "Dashboard";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['in'] = $this->user->getIncome($id_user);
        $fetch['done'] = $this->user->getDoneIncome($id_user);
        $fetch['ppn'] = $this->user->getPPN($id_user);
        # $fetch['profile'] = $this->user->profileValidate($id_user);

        // echo '<pre>';
        // var_dump($fetch['profile']);
        // echo '</pre>';
        // die;

        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side');
        $this->load->view('bm/channel', $fetch);
        $this->load->view('layout/bm-footer');
    }



    public function profile()
    {


        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['users'] = $this->users->getByProfile($id_user);
            $fetch['bank'] = $this->users->getBank($id_user);
            // echo '<pre>';
            // var_dump($fetch['users']);
            // echo '</pre>';
            // die;

            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side');
            $this->load->view('bm/profile');
            $this->load->view('layout/bm-footer');
            # code...
        } else {
            #$this->_update();
        }
    }

    public function content()
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['header'] = "BeatAudio Studio";
        $fetch['tittle'] = "Instrumental";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['displayBeat'] = $this->displayBeat->getByProducts($id_user);

        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side');
        $this->load->view('bm/content', $fetch);
        $this->load->view('layout/bm-footer');
    }

    public function deletecontent($id_product)
    {
        $data = $this->displayBeat->getByIdProduct($id_product);

        $callBackThumbnail = $data['thumbnail'];
        $callBackFull = $data['full_version'];
        $callBackDemo = $data['demo_version'];
        if ($data > 0) {
            $data = $this->displayBeat->deleteContentData($id_product);

            unlink(FCPATH . './files/thumbnail/' . $callBackThumbnail);
            unlink(FCPATH . './files/master-image/' . $callBackThumbnail);
            unlink(FCPATH . './files/full/' . $callBackFull);
            unlink(FCPATH . './files/demo/' . $callBackDemo);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show"
                                            role="alert">
                                            <span class="alert-text">
                                            Sukses hapus data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel/content');
        }
    }
    public function edit($id_product)
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['tittle'] = "Edit Content";
        $fetch['header'] = "BeatAudio";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['users'] = $this->users->getByProfile($id_user);
        $fetch['beat'] = $this->user->getByIdProduct($id_product);
        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side');
        $this->load->view('bm/edit-content');
        $this->load->view('layout/bm-footer');
    }
    public function updateprofile()
    {
        if ($this->input->post('nickname') != 'BeatAudio User') {
            $this->form_validation->set_rules(
                'nickname',
                'Nama Beatmaker',
                'required',
                [
                    'required' => 'Tidak Boleh Kosong'
                ]

            );
        } else {
            $this->form_validation->set_rules(
                'nickname',
                'Nama Beatmaker',
                'required|trim|is_unique[user.nickname]',
                array(
                    'required'      => 'You have not provided %s.',
                    'is_unique'     => '%s has been use, change to another'
                )
            );
        }
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|callback_email_check'
        );
        $this->form_validation->set_rules(
            'first_name',
            'Nama Depan',
            'required|trim|regex_match[/^([a-z ])+$/i]',
            [
                'required' => 'Tidak Boleh Kosong',
                'regex_match' => 'Format Salah'
            ]
        );
        $this->form_validation->set_rules(
            'last_name',
            'Nama Belakang',
            'required|trim|regex_match[/^([a-z ])+$/i]',
            [
                'required' => 'Tidak Boleh Kosong',
                'regex_match' => 'Format Salah'
            ]
        );
        $this->form_validation->set_rules(
            'phone_number',
            'Nomor Ponsel',
            'required|trim|numeric|min_length[10]|max_length[13]',
            [
                'required' => 'Tidak Boleh Kosong',
                'min_length' => 'Minimal 10 angka',
                'max_length' => 'Maksimal 13 angka'
            ]
        );
        $this->form_validation->set_rules(
            'address',
            'Address',
            'required',
            [
                'required' => 'Tidak Boleh Kosong'
            ]
        );
        // if (empty($_FILES['image']['name'])) {
        //     $this->form_validation->set_rules(
        //         'image',
        //         'Photo Profile',
        //         'required|is_image'
        //     );
        // }

        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "Beat Audio";
            $fetch['tittle'] = "Update Profil";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['users'] = $this->users->getByProfile($id_user);
            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side');
            $this->load->view('bm/update-profile');
            $this->load->view('layout/bm-footer');
            # code...
        } else {
            $this->_updateProfile();
        }
    }
    function email_check()
    {
        $id_user = $this->session->userdata('id_user');
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE email='$post[email]' And id_user != $id_user");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', 'This email has been registered');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    private function _updateProfile()
    {
        $callBackImage = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id_user = $this->session->userdata('id_user');
        $nickname = $this->input->post('nickname');
        $email = $this->input->post('email');
        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $phone_number = $this->input->post('phone_number');
        $address = $this->input->post('address');
        #$photo_profiles = $this->input->post('photo_profiles');

        $upload_image = $_FILES['image']['name'];
        #$upload_image = $_FILES['image']['temp_name'];
        $pixel = $_FILES['image']['tmp_name'];


        if ($upload_image) {
            $squreImage = getimagesize($pixel);
            $width = $squreImage[0];
            $height = $squreImage[1];
            if ($width >= 760 && $height >= 760) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                        role="alert">
                                        <span class="alert-text">
                                        Oops, Photo Profile setidaknya 760x760px</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('bm/channel/updateprofile');
            } else {
                #$imagesize = getimagesize($imageTempName);
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size']      = '20048';
                $config['upload_path'] = './files/pp/';
                $config['encrypt_name'] = TRUE;
                // $config['width'] = 600;
                // $config['height'] = 400;

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();
                    $upload_file = $image['file_name'];
                    $this->resizeImage($upload_file);

                    $old_image = $callBackImage['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . './files/pp/' . $old_image);
                        unlink(FCPATH . './files/new-image/' . $old_image);
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    File Upload Anda Bukan Gambar!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('bm/channel/updateprofile');
                }
                $data = [
                    'nickname' => $nickname,
                    'image' => $image['file_name'],
                    'email' => $email,
                ];
                $data2 = [
                    'id_user' => $id_user,
                    'id_cs' => null,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'phone_number' => $phone_number,
                    'address' => $address,

                ];
            }
        } elseif ($upload_image == "") {
            $data = [
                'nickname' => $nickname,
                'email' => $email,
            ];
            $data2 = [
                'id_user' => $id_user,
                'id_cs' => null,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'phone_number' => $phone_number,
                'address' => $address,

            ];
        }


        $query = $this->users->getByProfile($id_user);
        $params = $this->user->getBank($id_user);
        if ($query['id_profiles'] != NULL) {
            $this->user->update_user($id_user, $data, 'user');
            $this->user->updateUserProfile($id_user, $data2, 'profiles');
            if ($params != NULL) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        <span class="alert-text">
                                        Sukses Ubah Data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('bm/channel/updateprofile');
            } elseif ($params == NULL) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        <span class="alert-text">
                                        Sukses, lengkapi data bank</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('bm/channel/bank_account');
            }
        } elseif ($query['id_profiles'] == NULL) {
            $this->user->update_user($id_user, $data, 'user');
            $this->db->insert('profiles', $data2);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                    Sukses, lengkapi data bank</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            redirect('bm/channel/bank_account');
        }
    }
    public function resizeImage($filename)
    {
        $source_path = FCPATH . '/files/pp/' . $filename;
        $target_path = FCPATH . '/files/new-image';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            #'maintain_ratio' => TRUE,
            #'create_thumb' => TRUE,
            #'thumb_marker' => '_thumb',
            'width' => 360,
            'height' => 360,
            'master_dim' => 'width',
        );


        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }


        $this->image_lib->clear();
    }
    public function resizeImageProduct($filename)
    {
        $source_path = FCPATH . '/files/master-image/' . $filename;
        $target_path = FCPATH . '/files/thumbnail';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            #'maintain_ratio' => TRUE,
            #'create_thumb' => TRUE,
            #'thumb_marker' => '_thumb',
            'width' => 300,
            'height' => 300,
            #'master_dim' => 'width',
        );


        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }


        $this->image_lib->clear();
    }

    public function uploadcontent()
    {
        $id_user = $this->session->userdata('id_user');
        $param = $this->user->getProfile($id_user);
        $param2 = $this->user->getBank($id_user);
        $this->form_validation->set_rules(
            'title',
            'Title',
            'required|alpha_numeric_spaces'
        );

        if ($param == NULL) {
            $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Update profile sebelum upload</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $this->session->set_flashdata('message', $active_alert);
            redirect('bm/channel/updateprofile');
        } else {
            if ($param2 == NULL) {
                $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Selesaikan data anda/span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $this->session->set_flashdata('message', $active_alert);
                redirect('bm/channel/bank_account');
            } else {
                if ($this->form_validation->run() == FALSE) {
                    $id_user = $this->session->userdata('id_user');
                    $fetch['tittle'] = "Upload Instrumental";
                    $fetch['header'] = "BeatAudio";
                    $fetch['user'] = $this->user->getByIdBm($id_user);
                    $fetch['users'] = $this->users->getByProfile($id_user);

                    $this->load->view('layout/bm-header', $fetch);
                    $this->load->view('layout/bm-side',);
                    $this->load->view('bm/upload-content');
                    $this->load->view('layout/bm-footer');
                } else {
                    $this->_uploadContent();
                }
            }
        }
    }

    private function _uploadContent()
    {
        $title = $this->input->post('title');
        // $full = $this->input->post($_FILES['full_version']['name']);
        // var_dump($full, $title);
        // die;

        $full = $_FILES['full_version'];
        $full_filename = $full['name'];
        $full_size = $full['size'];
        $full_ext = pathinfo($full_filename, PATHINFO_EXTENSION);

        $demo = $_FILES['demo_version'];
        $demo_filename = $demo['name'];
        $demo_dize = $demo['size'];
        $demo_ext = pathinfo($demo_filename, PATHINFO_EXTENSION);
        $thumb = $_FILES['thumbnail']['name'];
        $thumbs = $_FILES['thumbnail']['tmp_name'];
        $SizeOfImage = $_FILES['thumbnail']['size'];

        $genre = $this->input->post('genre');
        $description = $this->input->post('description');
        $price = str_replace(',', '', $this->input->post('price'));
        // var_dump('full =' . $full_filename);
        // var_dump('demo =' . $demo_filename);

        # $imgSize = getimagesize($thumbs);
        // var_dump($price);
        // die;

        if ($full_ext == "wav" && $demo_ext == "wav") {
            if ($full_size > 104857600) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Maksimal full adalah 100MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } elseif ($demo_dize > 104857600) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Maksimal demo adalah 100MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } else {
                $config['allowed_types'] = 'wav';
                $config['max_size']      = '0';
                $config['upload_path'] = './files/full/';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config, 'full_version');
                $this->full_version->initialize($config);
                $fullVer = $this->full_version->do_upload('full_version');
                $fullNameFile = $this->full_version->data();

                // var_dump($fullVer);
                // die;
                $config2['allowed_types'] = 'wav';
                $config2['max_size']      = '0';
                $config2['upload_path'] = './files/demo/';
                $config2['encrypt_name'] = TRUE;
                $this->load->library('upload', $config2, 'demo_version');
                $this->demo_version->initialize($config2);
                $demoVer = $this->demo_version->do_upload('demo_version');
                $demoNameFile = $this->demo_version->data();

                $imageLenght = getimagesize($thumbs);
                $width = $imageLenght[0];
                $height = $imageLenght[1];
                if ($thumb) {
                    if ($width != 1500 && $height != 1500) {
                        unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                        unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <span class="alert-text">
                                                            Gambar anda tidak 1500 x 1500 piksel</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );

                        redirect('bm/channel/uploadcontent');
                    } else {
                        if ($SizeOfImage > 2097152) {
                            unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                            unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                            $this->session->set_flashdata(
                                'message',
                                '<div class="alert alert-danger alert-dismissible fade show"
                                                                role="alert">
                                                                <span class="alert-text">
                                                                Maksimal gambar adalah 2MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                            redirect('bm/channel/uploadcontent');
                        } else {
                            if ($fullVer && $demoVer) {
                                $config3['image_library'] = 'gd2';
                                $config3['allowed_types'] = 'jpeg|jpg|png';
                                $config3['max_size']      = '2048';
                                $config3['upload_path'] = './files/master-image/';
                                $config3['encrypt_name'] = TRUE;


                                $this->load->library('upload', $config3, 'thumbnail');
                                $this->thumbnail->initialize($config3);
                                $thumbVer = $this->thumbnail->do_upload('thumbnail');
                                $thumbnailImage = $this->thumbnail->data();
                                if ($thumbVer) {
                                    $thumbnailImage = $this->thumbnail->data();
                                    $upload_file = $thumbnailImage['file_name'];
                                    $this->resizeImageProduct($upload_file);
                                    if ($genre != "" && $price != "" && $description != "") {
                                        $ppn = $price * 0.1;
                                        $tottal_price = $price + $ppn;

                                        $data = [
                                            'id_product' => getAutoNumber('product', 'id_product', 'BTA', 8),
                                            'id_user' => $this->session->userdata('id_user'),
                                            'title' => $title,
                                            'full_version' =>  $fullNameFile['file_name'],
                                            'demo_version' =>  $demoNameFile['file_name'],
                                            'thumbnail' =>  $thumbnailImage['file_name'],
                                            'genre'    => $genre,
                                            'thumbnail'    => $thumbnailImage['file_name'],
                                            'description'    => $description,
                                            'date_release'   => date('Y-m-d H:i:s'),
                                            'price' => $price,
                                            'ppn' => $ppn,
                                            'selling_price' => $tottal_price,
                                            'status_product' => 0,
                                            'sales' => 0,
                                        ];
                                        // echo '<pre>';
                                        // var_dump($data);
                                        // echo '</pre>';
                                        $this->db->insert("product", $data);
                                        $this->session->set_flashdata(
                                            'message',
                                            '<div class="alert alert-success alert-dismissible fade show"
                                                                        role="alert">
                                                                        <span class="alert-text">
                                                                        Sukses Upload tunggu review admin</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                        );

                                        redirect('bm/channel/content');
                                    } else {
                                        unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                                        unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                                        unlink(FCPATH . './files/master-image/' . $thumbnailImage['file_name']);
                                        unlink(FCPATH . './files/thumbnail/' . $thumbnailImage['file_name']);
                                        $this->session->set_flashdata(
                                            'message',
                                            '<div class="alert alert-danger alert-dismissible fade show"
                                                                            role="alert">
                                                                            <span class="alert-text">
                                                                           Seluruh input tidak boleh kosong</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                        );

                                        redirect('bm/channel/uploadcontent');
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } elseif ($full_ext == "mp3" && $demo_ext == "mp3") {
            if ($full_size > 104857600) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Maksimal full adalah 100MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } elseif ($demo_dize > 104857600) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Maksimal demo adalah 100MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } else {
                $config['allowed_types'] = 'mp3';
                $config['max_size']      = '0';
                $config['upload_path'] = './files/full/';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config, 'full_version');
                $this->full_version->initialize($config);
                $fullVer = $this->full_version->do_upload('full_version');
                $fullNameFile = $this->full_version->data();

                // var_dump($fullVer);
                // die;
                $config2['allowed_types'] = 'mp3';
                $config2['max_size']      = '0';
                $config2['upload_path'] = './files/demo/';
                $config2['encrypt_name'] = TRUE;
                $this->load->library('upload', $config2, 'demo_version');
                $this->demo_version->initialize($config2);
                $demoVer = $this->demo_version->do_upload('demo_version');
                $demoNameFile = $this->demo_version->data();

                $imageLenght = getimagesize($thumbs);
                $width = $imageLenght[0];
                $height = $imageLenght[1];
                if ($thumb) {
                    if ($width != 1500 && $height != 1500) {
                        unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                        unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger alert-dismissible fade show"
                                                            role="alert">
                                                            <span class="alert-text">
                                                            Gambar anda tidak 1500 x 1500 piksel</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );

                        redirect('bm/channel/uploadcontent');
                    } else {
                        if ($SizeOfImage > 2097152) {
                            unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                            unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                            $this->session->set_flashdata(
                                'message',
                                '<div class="alert alert-danger alert-dismissible fade show"
                                                                role="alert">
                                                                <span class="alert-text">
                                                                Maksimal gambar 2MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                            redirect('bm/channel/uploadcontent');
                        } else {
                            if ($fullVer && $demoVer) {
                                $config3['image_library'] = 'gd2';
                                $config3['allowed_types'] = 'jpeg|jpg|png';
                                $config3['max_size']      = '2048';
                                $config3['upload_path'] = './files/master-image/';
                                $config3['encrypt_name'] = TRUE;


                                $this->load->library('upload', $config3, 'thumbnail');
                                $this->thumbnail->initialize($config3);
                                $thumbVer = $this->thumbnail->do_upload('thumbnail');
                                $thumbnailImage = $this->thumbnail->data();
                                if ($thumbVer) {
                                    $thumbnailImage = $this->thumbnail->data();
                                    $upload_file = $thumbnailImage['file_name'];
                                    $this->resizeImageProduct($upload_file);
                                    if ($genre != "" && $price != "" && $description != "") {
                                        $ppn = $price * 0.1;
                                        $tottal_price = $price + $ppn;

                                        $data = [
                                            'id_product' => getAutoNumber('product', 'id_product', 'BTA', 8),
                                            'id_user' => $this->session->userdata('id_user'),
                                            'title' => $title,
                                            'full_version' =>  $fullNameFile['file_name'],
                                            'demo_version' =>  $demoNameFile['file_name'],
                                            'thumbnail' =>  $thumbnailImage['file_name'],
                                            'genre'    => $genre,
                                            'thumbnail'    => $thumbnailImage['file_name'],
                                            'description'    => $description,
                                            'date_release'   => date('Y-m-d H:i:s'),
                                            'price' => $price,
                                            'ppn' => $ppn,
                                            'selling_price' => $tottal_price,
                                            'status_product' => 0,
                                            'sales' => 0,
                                        ];
                                        $this->db->insert("product", $data);
                                        $this->session->set_flashdata(
                                            'message',
                                            '<div class="alert alert-success alert-dismissible fade show"
                                                                        role="alert">
                                                                        <span class="alert-text">
                                                                        Sukses upload, tunggu review admin</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                        );

                                        redirect('bm/channel/content');
                                    } else {
                                        unlink(FCPATH . './files/full/' . $fullNameFile['file_name']);
                                        unlink(FCPATH . './files/demo/' . $demoNameFile['file_name']);
                                        unlink(FCPATH . './files/master-image/' . $thumbnailImage['file_name']);
                                        unlink(FCPATH . './files/thumbnail/' . $thumbnailImage['file_name']);
                                        $this->session->set_flashdata(
                                            'message',
                                            '<div class="alert alert-danger alert-dismissible fade show"
                                                                            role="alert">
                                                                            <span class="alert-text">
                                                                           Seluruh input tidak boleh kosong</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                        );

                                        redirect('bm/channel/uploadcontent');
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } else {

            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show"
                                            role="alert">
                                            <span class="alert-text">
                                           Format file audio full versi atau demo versi bukan mp3/wav</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            redirect('bm/channel/uploadcontent');
        }
    }

    public function rules()
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['header'] = "BeatAudio Studio";
        $fetch['tittle'] = "Dashboard";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side',);
        $this->load->view('bm/rules', $fetch);
        $this->load->view('layout/bm-footer');
    }

    public function Dodownload()
    {
        force_download('files/wm/watermark.wav', NULL);
    }

    public function bank_account()
    {

        $this->form_validation->set_rules(
            'bank_name',
            'Bank',
            'required',
            [
                'required' => 'Tidak Boleh Kosong'
            ]
        );
        $this->form_validation->set_rules(
            'bank_number',
            'Nomor Rekening',
            'required|numeric|min_length[10]|max_length[17]',
            [
                'required' => 'Tidak Boleh Kosong',
                'numeric' => 'Fromat salah',
                'min_length' => 'Minimal 10 Angka',
                'max_length' => 'Maksimal 17 Angka',
            ]
        );
        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Akun Bank";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['bank'] = $this->user->getBank($id_user);
            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
            $this->load->view('bm/bank-account', $fetch);
            $this->load->view('layout/bm-footer');
        } else {
            $bank_name = $this->input->post('bank_name');
            $bank_number = $this->input->post('bank_number');

            $data = [
                'id_user' => $this->session->userdata('id_user'),
                'bank_name' => $bank_name,
                'bank_number' => $bank_number,
            ];

            $this->db->insert('data_bank', $data);
            $active_alert = '<div class="alert alert-success alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Sukses</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $this->session->set_flashdata('message', $active_alert);
            redirect('bm/channel/bank_account');
        }
    }
    public function deleteBank($id_bank)
    {
        $data = $this->user->getByIdBank($id_bank);

        if ($data > 0) {
            $this->user->deleteBankAccount($id_bank);
            $active_alert = '<div class="alert alert-success alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Sukses hapus data bank</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $this->session->set_flashdata('message', $active_alert);
            redirect('bm/channel/bank_account');
        }
    }
    public function infoWd()
    {

        $this->form_validation->set_rules('from', 'From Date', 'required|trim');
        $this->form_validation->set_rules('until', 'From Date', 'required|trim');
        if ($this->form_validation->run() == false) {

            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Informasi Penarikan";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['in'] = $this->user->getIncome($id_user);
            $fetch['wd'] = $this->user->getWd($id_user);
            // echo '<pre>';
            // var_dump($fetch['income']);
            // echo '</pre>';
            // die;

            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
            $this->load->view('bm/info-withdraw', $fetch);
            $this->load->view('layout/bm-footer');
        } else {
            $this->_reportWithdraw();
        }
    }
    public function history()
    {
        $this->form_validation->set_rules('from', 'From Date', 'required|trim');
        $this->form_validation->set_rules('until', 'From Date', 'required|trim');
        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Laporan Pendapatan";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['in'] = $this->user->getIncome($id_user);
            $fetch['wd'] = $this->user->getWd($id_user);
            // echo '<pre>';
            // var_dump($fetch['income']);
            // echo '</pre>';
            // die;

            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
            $this->load->view('bm/withdraw-history', $fetch);
            $this->load->view('layout/bm-footer');
        } else {
            $this->_reportWithdraw();
        }
    }
    public function _reportWithdraw()
    {

        $id_user = $this->session->userdata('id_user');
        $from = $this->input->post('from');
        $until = $this->input->post('until');
        $reportWd = $this->user->getReportWithdraw($id_user, $from, $until);


        $this->session->set_flashdata('reportWd', $reportWd);
        $this->session->set_flashdata('from', $from);
        $this->session->set_flashdata('until', $until);
        // echo '<pre>';
        // var_dump($reportWd);
        // echo '</pre>';
        redirect('bm/channel/history');
    }

    public function printWd($id_user, $from, $until)
    {
        $id_user = $this->session->userdata('id_user');
        $reportWd['income'] = $this->user->getReportWithdraw($id_user, $from, $until);

        $this->load->view('email-sent/printWd', $reportWd);
    }
    
public function printWdSM($id_user, $from, $until)
    {
        $id_user = $this->session->userdata('id_user');
        $reportWd['income'] = $this->user->getReportWithdraw($id_user, $from, $until);

        $this->load->view('email-sent/printWdSM', $reportWd);
    }

    public function requestWithdraw()
    {
        $income = $this->input->post('net_income');
        $ppn = $this->input->post('ppn_income');
        $id_user = $this->session->userdata('id_user');
        if ($income == null) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                   Anda tidak memiliki saldo untuk di tarik</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel');
        } elseif ($income == 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                   Anda tidak memiliki saldo untuk di tarik</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel');
        } else {
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Request Penarikan";
            $fetch['data'] = [

                'id_user' =>  $id_user,
                'email' =>  $this->session->userdata('email'),
                'net_income' => $income,
                'ppn_income' => $ppn,
                'date_wd' => date('Y-m-d H:i:s'),
                'status_income' => 0
            ];
            $fetch['mybank'] = $this->user->getMyBank($id_user);
            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
            $this->load->view('bm/request-withdraw', $fetch);
            $this->load->view('layout/bm-footer');
        }
    }
    public function doWithdraw()
    {
        $id_user = $this->session->userdata('id_user');
        $income = $this->input->post('net_income');
        $ppn = $this->input->post('ppn_income');
        $email = $this->input->post('email');
        $bank_name = $this->input->post('bank_name');
        $bank_number = $this->input->post('bank_number');
        $net_income = preg_replace('/[Rp. ]/', '', $income);
        date_default_timezone_set('Asia/Jakarta');
        if ($this->input->post('submit')) {
            $data = [
                'wd_id' => 'BA-WD-' . rand(),
                'id_user' =>  $id_user,
                'email' =>  $email,
                'net_income' =>  $net_income,
                'ppn_income' => $ppn,
                'bank_name' => $bank_name,
                'bank_number' => $bank_number,
                'date_wd' => date('Y-m-d H:i:s'),
                'status_income' => 0
            ];
            $data2 = [
                'sales' => 0
            ];
            // echo '<pre>';
            // var_dump($data);
            // echo '</pre>';
            $this->db->insert('income', $data);
            $this->user->updateProduct($id_user, $data2, 'product');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-warning alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                    Penarikan sedang dalam proses</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel/infoWd');
        }
    }
    public function setting()
    {
        if ($this->input->post('change')) {
            $this->form_validation->set_rules(
                'old_pass',
                'Old Password',
                'required',
                [
                    'required' => 'Tidak Boleh Kosong'
                ]

            );
            $this->form_validation->set_rules(
                'n_pass1',
                'Password',
                'required|trim|matches[n_pass2]',
                [
                    'required' => 'Tidak Boleh Kosong'
                ]
            );
            $this->form_validation->set_rules(
                'n_pass2',
                'Password',
                'required|trim|matches[n_pass1]',
                [
                    'required' => 'Tidak Boleh Kosong'
                ]
            );
        } elseif ($this->input->post('delete')) {
            $this->form_validation->set_rules(
                'request_delete',
                'Request Delete',
                'required',

            );
        }
        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Pengaturan";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
            $this->load->view('bm/account-setting', $fetch);
            $this->load->view('layout/bm-footer');
        } else {
            if ($this->input->post('change')) {
                $current_password = $this->input->post('old_pass');
                $new_password1 = $this->input->post('n_pass1');
                $new_password2 = $this->input->post('n_pass2');

                $change = $this->user->getByIdBm($this->session->userdata('id_user'));

                if (password_verify($current_password, $change['password'])) {
                    if ($new_password1 == $new_password2) {

                        $data = [
                            'password' => password_hash($new_password1, PASSWORD_DEFAULT)
                        ];

                        // var_dump($data);
                        // die();
                        $this->user->updatePassword($this->session->userdata('id_user'), $data);
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-success alert-dismissible fade show"
                    role="alert">
                    <span class="alert-text">
                    Berhasil</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                        );
                        redirect('bm/channel/setting');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                The old password is wrong</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('bm/channel/setting');
                }
            } elseif ($this->input->post('delete')) {
                $req = $this->input->post('request_delete');
                if ($req != "DELETED") {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                Wrong Request!!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('bm/channel/setting');
                } elseif ($req == "DELETED") {
                    $id_user = $this->session->userdata('id_user');
                    $income = $this->user->getIncome($id_user);
                    // var_dump($income);
                    // die;
                    if ($income != 0) {
                        $this->session->set_flashdata(
                            'message',
                            '<div class="alert alert-danger alert-dismissible fade show"
                    role="alert">
                    <span class="alert-text">
                    Permintaan Ditolak, pastikan anda sudah menarik saldo anda</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                        );
                        redirect('bm/channel/setting');
                    } else {
                        $money = $this->user->getValidateWd($id_user);

                        // echo '<pre>';
                        // var_dump($money);
                        // echo '</pre>';
                        // die;
                        if ($money > 0) {
                            if ($money['status_income'] == 0) {
                                $this->session->set_flashdata(
                                    'message',
                                    '<div class="alert alert-danger alert-dismissible fade show"
                            role="alert">
                            <span class="alert-text">
                            Permintan Ditolak, anda masih memiliki status penarikan yang pending </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button></div>'
                                );
                                redirect('bm/channel/setting');
                            } else {
                            }
                        } elseif ($money == NULL) {
                            $email = $this->session->userdata('email');
                            $this->_SendEmailToDelete($email, $req, 'delete');
                        }
                    }
                }
            }
        }
    }

    private function _SendEmailToDelete($email, $req, $type)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'beataudio1812@gmail.com',
            'smtp_pass' => 'coihrjfpbftfoqyd',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'newline' => "\r\n",
            "smtp_keep_alive"    => TRUE
        ];
        $this->email->initialize($config);


        $id_user = $this->session->userdata('id_user');
        $param = $this->user->getFileName($id_user);
        $Full = $this->user->getByProducts($id_user);
        $Demo = $this->user->getByProducts($id_user);



        $params['bm'] = $this->user->getProfileRequest($id_user);
        $params['bank'] = $this->users->getBank($id_user);
        $params['empty'] = $this->user->getFileName($id_user);
        $params['income'] = $this->user->getIncomeForWd($id_user);



        $this->load->view('email-sent/data-bm-print', $params);



        $filename = $param['email'] . '-personal-data.pdf';


        $ciphertext = base64_encode($id_user);
        $data['bm'] = [
            'uid' => $ciphertext,
            'pdf' => $filename,
            'full_name' => 'BeatAudio User',

        ];

        $message = $this->load->view('email-sent/request-delete-bm', $data, TRUE);


        $this->email->from('beataudio1812@gmail.com', 'Beat Audio');
        $this->email->to($email);
        if ($type == 'delete') {
            $this->email->subject('Permintaan Penghapusan - ' . time());
            $this->email->message($message);

            #$this->email->attach(base_url() . 'files/pdf/' . $filename);

            $data2 = [
                'is_active' => 0,
                'request_delete' => $req,
                'personal_pdf' => $filename
            ];
            $this->user->update_user($this->session->userdata('id_user'), $data2);

            $data10 = [
                'status_product' => 0
            ];
            $this->user->updateProduct($this->session->userdata('id_user'), $data10);

            #$this->user->updateIncome($this->session->userdata('email'), $data1);
        }
        $this->load->library('email', $config);
        $this->email->send();
        #unlink(base_url().'files/pdf/' . $filename);
        $this->session->unset_userdata('id_user');
        $this->session->unset_userdata('id_cs');
        $this->session->unset_userdata('nickname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Sukses sekarang check email anda</div>');
        redirect('auth');
    }

    public function none()
    {
        // $id_user = $this->session->userdata('id_user');
        // $param =

        // echo '<pre>';
        // var_dump($param);
        // echo '</pre>';
    }
}
