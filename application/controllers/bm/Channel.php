<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Channel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        as_bm();
        $this->load->library('form_validation');
        $this->load->helper('download');

        $this->load->model('mdl_bm', 'user');
        $this->load->model('mdl_bm', 'users');
        $this->load->model('mdl_bm', 'checkProductId');
        $this->load->model('mdl_bm', 'displayBeat');
    }

    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['header'] = "BeatAudio Studio";
        $fetch['tittle'] = "Dashboard";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['in'] = $this->user->getIncome($id_user);
        $fetch['ppn'] = $this->user->getPPN($id_user);
        // echo '<pre>';
        // var_dump($fetch['income']);
        // echo '</pre>';
        // die;

        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side',);
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
            $this->load->view('layout/bm-side',);
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
        $fetch['tittle'] = "Channel Content";
        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['displayBeat'] = $this->displayBeat->getByProducts($id_user);

        $this->load->view('layout/bm-header', $fetch);
        $this->load->view('layout/bm-side',);
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
                                            Success delete data</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
        $this->load->view('layout/bm-side',);
        $this->load->view('bm/edit-content');
        $this->load->view('layout/bm-footer');
    }
    public function updateprofile()
    {
        $this->form_validation->set_rules(
            'nickname',
            'Beat Maker Name',
            'required|trim'
        );
        $this->form_validation->set_rules(
            'email',
            'Beat Maker Name',
            'required|trim|valid_email|callback_email_check'
        );
        $this->form_validation->set_rules(
            'first_name',
            'First Name',
            'required|trim|regex_match[/^([a-z ])+$/i]'
        );
        $this->form_validation->set_rules(
            'last_name',
            'Last Name',
            'required|trim|regex_match[/^([a-z ])+$/i]'
        );
        $this->form_validation->set_rules(
            'phone_number',
            'Phone Number',
            'required|trim|numeric|min_length[10]|max_length[13]'
        );
        $this->form_validation->set_rules(
            'address',
            'Address',
            'required'
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
            $fetch['tittle'] = "Channel Update Profile";
            $fetch['user'] = $this->user->getByIdBm($id_user);
            $fetch['users'] = $this->users->getByProfile($id_user);
            $this->load->view('layout/bm-header', $fetch);
            $this->load->view('layout/bm-side',);
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

        if ($upload_image) {

            #$imagesize = getimagesize($imageTempName);
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = '20048';
            $config['upload_path'] = './files/pp/';
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
                                                Your file upload is not image!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
            // var_dump($data);
            // var_dump($data2);
            // die;
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
                                        Your account has been updated lets complete bank account</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('bm/channel/updateprofile');
            } elseif ($params == NULL) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show"
                                        role="alert">
                                        <span class="alert-text">
                                        Your account has been updated lets complete bank account</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                    Your account has been updated lets complete bank account</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
        // $this->form_validation->set_rules(
        //     'genre',
        //     'Genre',
        //     'required'
        // );
        // $this->form_validation->set_rules(
        //     'description',
        //     'Description',
        //     'required'
        // );
        // $this->form_validation->set_rules(
        //     'price',
        //     'Price',
        //     'required'
        // );
        if ($param == NULL) {
            $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			You must be update your profile first before upload</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $this->session->set_flashdata('message', $active_alert);
            redirect('bm/channel/updateprofile');
        } else {
            if ($param2 == NULL) {
                $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <span class="alert-text">
                You must be complete your bank account before upload</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $this->session->set_flashdata('message', $active_alert);
                redirect('bm/channel/bank_account');
            } else {
                if ($this->form_validation->run() == FALSE) {
                    $id_user = $this->session->userdata('id_user');
                    $fetch['tittle'] = "Channel Upload";
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
            if ($full_size > 314572800) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Your full version audio is too large, max size is 300MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } elseif ($demo_dize > 314572800) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Your demo version audio is too large, max size is 300MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                            Your image is not 1500x1500 pixel</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                                Your image is too large, max size is 2MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                            redirect('bm/channel/uploadcontent');
                        } else {
                            if ($fullVer && $demoVer) {
                                $config3['image_library'] = 'gd2';
                                $config3['allowed_types'] = 'gif|jpg|png';
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
                                                                        Success Upload wait for admin review</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                                           All input is required!!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
            if ($full_size > 314572800) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Your full version audio is too large, max size is 300MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );

                redirect('bm/channel/content');
            } elseif ($demo_dize > 314572800) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert">
                                                    <span class="alert-text">
                                                    Your demo version audio is too large, max size is 300MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                            Your image is not 1500x1500 pixel</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                                Your image is too large, max size is 2MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                            redirect('bm/channel/uploadcontent');
                        } else {
                            if ($fullVer && $demoVer) {
                                $config3['image_library'] = 'gd2';
                                $config3['allowed_types'] = 'gif|jpg|png';
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
                                                                        Success Upload</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                                                           All input is required!!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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
                                           Cannot Mix Upload Audio File!, for full version and demo must be same, all mp3 or all wav</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            redirect('bm/channel/uploadcontent');
        }
        // var_dump($demo);
        // die;
        // $thumb = $_FILES['thumbnail']['name'];
        // $thumbs = $_FILES['thumbnail']['tmp_name'];



        // $genre = $this->input->post('genre');
        // $description = $this->input->post('description');
        // $price = str_replace(',', '', $this->input->post('price'));
        // $ppn = $price * 0.1;
        // $tottal_price = $price + $ppn;
        // echo "price :'.$price.'";
        // echo "admin commision :'.$admin.'";
        // echo "total_price :'.$current_price.'";
        // die;

        // if ($full && $demo && $thumb) {
        //     $config['allowed_types'] = 'mp3|wav';
        //     $config['max_size']      = '307200';
        //     $config['upload_path'] = './files/full/';
        //     $config['encrypt_name'] = TRUE;
        //     $this->load->library('upload', $config, 'full_version');
        //     $this->full_version->initialize($config);
        //     $fullVer = $this->full_version->do_upload('full_version');
        //     // var_dump($fullVer);
        //     // die;
        //     $config2['allowed_types'] = 'mp3|wav';
        //     $config2['max_size']      = '307200';
        //     $config2['upload_path'] = './files/demo/';
        //     $config2['encrypt_name'] = TRUE;
        //     $this->load->library('upload', $config2, 'demo_version');
        //     $this->demo_version->initialize($config2);
        //     $demoVer = $this->demo_version->do_upload('demo_version');

        //     $imgSize = getimagesize($thumbs);
        //     $width = $imgSize[0];
        //     $height = $imgSize[1];



        //     #$this->upload->initialize($config2);
        //     if ($fullVer && $demoVer) {
        //         $fulls = $this->full_version->data();
        //         // echo '<pre>';
        //         // print_r($fulls);
        //         // echo '</pre>';
        //         $demos = $this->demo_version->data();
        //         // print_r($demos);
        //         #die;

        //     } else {
        //         // echo $this->full_version->display_errors();
        //         // echo $this->demo_version->display_errors();

        //         // unlink(FCPATH . './files/full/' . $fulls['file_name']);
        //         // unlink(FCPATH . './files/demo/' . $demos['file_name']);
        //         $this->session->set_flashdata(
        //             'message',
        //             '<div class="alert alert-danger alert-dismissible fade show"
        //                                 role="alert">
        //                                 <span class="alert-text">
        //                                 Your audio upload is not mp3/wav or your audio size is bigger than 300MB</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //         );

        //         redirect('bm/channel/uploadcontent');
        //     }
        //     if ($width != 1500 && $height != 1500) {

        //         unlink(FCPATH . './files/full/' . $fulls['file_name']);
        //         unlink(FCPATH . './files/demo/' . $demos['file_name']);
        //         $this->session->set_flashdata(
        //             'message',
        //             '<div class="alert alert-danger alert-dismissible fade show"
        //                                 role="alert">
        //                                 <span class="alert-text">
        //                                 Your image is not 1500x1500 pixel</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //         );

        //         redirect('bm/channel/uploadcontent');
        //     } else {
        //         $config3['image_library'] = 'gd2';
        //         $config3['allowed_types'] = 'gif|jpg|png';
        //         $config3['max_size']      = '2048';
        //         $config3['upload_path'] = './files/master-image/';

        //         $this->load->library('upload', $config3, 'thumbnail');
        //         $this->thumbnail->initialize($config3);
        //         $thumbVer = $this->thumbnail->do_upload('thumbnail');
        //     }

        //     if ($thumbVer) {
        //         $thumbnailImage = $this->thumbnail->data();
        //         $upload_file = $thumbnailImage['file_name'];
        //         $this->resizeImageProduct($upload_file);
        //     } else {
        //         $this->session->set_flashdata(
        //             'message',
        //             '<div class="alert alert-danger alert-dismissible fade show"
        //                                 role="alert">
        //                                 <span class="alert-text">
        //                                 Your File upload is not image type</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //         );

        //         redirect('bm/channel/uploadcontent');
        //     }
        // } else {

        //     $this->session->set_flashdata(
        //         'message',
        //         '<div class="alert alert-danger alert-dismissible fade show"
        //                             role="alert">
        //                             <span class="alert-text">
        //                             Your File upload is requiered</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        //     );

        //     redirect('bm/channel/uploadcontent');
        // }
        // $data = [
        //     'id_product' => getAutoNumber('product', 'id_product', 'BTA', 8),
        //     'id_user' => $this->session->userdata('id_user'),
        //     'title' => $title,
        //     'full_version' => $fulls['file_name'],
        //     'demo_version' =>  $demos['file_name'],
        //     'genre'    => $genre,
        //     'thumbnail'    => $thumbnailImage['file_name'],
        //     'description'    => $description,
        //     'date_release'   => date('Y-m-d H:i:s'),
        //     'price' => $price,
        //     'ppn' => $ppn,
        //     'selling_price' => $tottal_price,
        //     'status_product' => 0,
        //     'sales' => 0,
        // ];
        // #var_dump($data);
        // $this->db->insert("product", $data);
        // $this->session->set_flashdata(
        //     'message',
        //     '<div class="alert alert-success alert-dismissible fade show"
        //                                 role="alert">
        //                                 <span class="alert-text">
        //                                 Success Upload</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
        // );

        // redirect('bm/channel/content');
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

        $this->form_validation->set_rules('bank_name', 'Bank', 'required');
        $this->form_validation->set_rules(
            'bank_number',
            'Bank Number',
            'required|numeric|min_length[10]|max_length[17]'
        );
        if ($this->form_validation->run() == false) {
            $id_user = $this->session->userdata('id_user');
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Bank Acocunt";
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
                You have been complete your bank account</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
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
                Success Delete Bank Account</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
            $this->session->set_flashdata('message', $active_alert);
            redirect('bm/channel/bank_account');
        }
    }
    public function infoWd()
    {
        $id_user = $this->session->userdata('id_user');
        $fetch['header'] = "BeatAudio Studio";
        $fetch['tittle'] = "Information Withdraw";
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
                                    You dont have saldo to withdraw</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel');
        } elseif ($income == 0) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show"
                                    role="alert">
                                    <span class="alert-text">
                                    You dont have saldo to withdraw</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
            redirect('bm/channel');
        } else {
            $fetch['header'] = "BeatAudio Studio";
            $fetch['tittle'] = "Request Withdraw";
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
        if ($this->input->post('submit')) {
            $data = [
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
                                    Your witdraw in proccess</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
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

            );
            $this->form_validation->set_rules(
                'n_pass1',
                'Password',
                'required|trim|matches[n_pass2]',

            );
            $this->form_validation->set_rules(
                'n_pass2',
                'Password',
                'required|trim|matches[n_pass1]',

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
            $fetch['tittle'] = "Setting";
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
                    You have been change password</span>
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

                    $data2 = [
                        'is_active' => 0,
                        'request_delete' => $req,
                    ];
                    $this->user->update_user($this->session->userdata('id_user'), $data2);
                    $this->session->unset_userdata('id_user');
                    $this->session->unset_userdata('id_cs');
                    $this->session->unset_userdata('nickname');
                    $this->session->unset_userdata('email');
                    $this->session->unset_userdata('role');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your Request In Process</div>');
                    redirect('auth');
                }
            }
        }
    }
}
