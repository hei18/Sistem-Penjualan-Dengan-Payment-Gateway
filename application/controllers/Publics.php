<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publics extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('mdl_artist', 'artist');
        $this->load->model('mdl_artist', 'carts');
        $this->load->model('mdl_artist', 'getProduct');
        $this->load->model('mdl_bm', 'user');
        $this->load->model('mdl_cs', 'cs');
        $this->load->model('mdl_cs', 'add');

        $this->load->library('form_validation');
        $this->load->library('pagination');
    }
    /**
     * 1. index adalah halaman home utama
     * 2. instumental adalah halaman seluruh instumental di display
     *
     * */
    public function index()
    {
        $id_user = $this->session->userdata('id_user');
        $id_cs = $this->session->userdata('id_cs');
        $fetch['user'] = $this->user->getByIdBm($id_user);

        $fetch['cs'] = $this->cs->getByIdCs($id_cs);
        $fetch['getProduct'] = $this->getProduct->getAllProductToDisplay();
        $fetch['getBm'] = $this->getProduct->getBeatMaker();
        $fetch['cart'] = $this->carts->getCart($id_cs);
        $fetch['count'] = $this->carts->countAllCart($id_cs);
        $fetch['sum'] = $this->carts->sumSubtotal($id_cs);
        $fetch['p'] = $this->carts->params($id_cs);
        $fetch['one'] = $this->getProduct->getProcutOnlyOne();
        // $this->load->view('check', $fetch);
        $fetch['header'] = "BeatAudio";

        $this->load->view('layout/ds-header-home', $fetch);
        $this->load->view('home');
        $this->load->view('layout/ds-footer-home');
    }

    // 2. instrumental
    public function instrumental()
    {
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }
        // $check = $this->input->post('keyword');
        // $this->db->like('genre', $check);
        // $this->db->from('product');
        $config['base_url'] = 'http://localhost/testing/publics/instrumental/';
        $config['total_rows'] = $this->getProduct->countAllProduct($data['keyword']);
        $fetch['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;
        $config['num_links'] = 2;

        $config['full_tag_open'] = '<nav><ul class="pagination pagination-lg d-flex justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');




        $this->pagination->initialize($config);


        $id_user = $this->session->userdata('id_user');
        $id_cs = $this->session->userdata('id_cs');

        $fetch['user'] = $this->user->getByIdBm($id_user);
        $fetch['cs'] = $this->cs->getByIdCs($id_cs);

        $fetch['start'] = $this->uri->segment(3);
        $fetch['getProduct'] = $this->getProduct->getAllProduct($config['per_page'], $fetch['start'], $data['keyword']);
        $fetch['cart'] = $this->carts->getCart($id_cs);


        $fetch['count'] = $this->carts->countAllCart($id_cs);
        $fetch['sum'] = $this->carts->sumSubtotal($id_cs);
        # $fetch['p'] = $this->carts->params($id_user);
        $fetch['header'] = "BeatAudio";

        $this->load->view('layout/ds-header-home', $fetch);
        $this->load->view('instrumental', $fetch);
        $this->load->view('layout/ds-footer-home');
        #$this->load->view('check', $fetch);
        // $data = $this->getProduct->getAllProduct();
        // $beat = $data['beatmaker_name'];
        // # $encode = base64_encode($encryp);

        // var_dump($fetch['cart']);
        // die;
    }


    public function artist($id_user)
    {


        $id_cs = $this->session->userdata('id_cs');
        $fetch['artist'] = $this->artist->getArtistWithId($id_user);

        $fetch['beat'] = $this->artist->getBeatById($id_user);
        // echo '<pre>';
        // var_dump($fetch['beat']);
        // echo '</pre>';
        // die;
        $fetch['cart'] = $this->carts->getCart($id_cs);
        $fetch['count'] = $this->carts->countAllCart($id_cs);
        $fetch['sum'] = $this->carts->sumSubtotal($id_cs);
        $fetch['cs'] = $this->cs->getByIdCs($id_cs);
        #$fetch['artist'] = $this->uri->segment(3);
        $fetch['header'] = "BeatAudio";
        $this->load->view('layout/ds-header-home', $fetch);
        $this->load->view('artist', $fetch);
        $this->load->view('layout/ds-footer-home');
        if ($this->input->post('submit')) {

            $id_cs = $this->session->userdata('id_cs');
            $id_product = $this->input->post('id_product');
            $selling_price = $this->input->post('selling_price');
            $title = $this->input->post('title');
            $qty = $this->add->getCartId($id_cs, $id_product);
            #$qty = $this->db->get_where('cart',[])
            $sumQty = $qty['qty'] + 1;

            // var_dump($sumQty);
            // die;

            if ($qty == 0) {
                $sumQty = $qty['qty'] + 1;

                // var_dump($sumQty);
                // die;
                $subtotal = $sumQty * $selling_price;
                $data = [

                    'id_cs' => $id_cs,
                    'id_product' => $id_product,
                    'title'    => $title,
                    'qty'    => $sumQty,
                    'selling_price' => $selling_price,
                    'subtotal' => $subtotal,
                    // 'mode' => 201,
                ];
                $this->db->insert('cart', $data);
                $active_alert = '<div class="alert alert-success alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			Success add to cart</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $this->session->set_flashdata('message', $active_alert);
                redirect('publics/artist/' . $id_user);
            } elseif ($qty['id_cart'] != null) {
                $active_alert = '<div class="alert alert-danger alert-dismissible fade show"
			role="alert">
			<span class="alert-text">
			You can only add to cart one time per instrumental!!!</span><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
                $this->session->set_flashdata('message', $active_alert);
                redirect('publics/artist/' . $id_user);
            }
        }


        #$this->load->view('check', $fetch);
    }

    public function about()
    {
        $fetch['header'] = "BeatAudio";
        $this->load->view('layout/ds-header-home', $fetch);
        $this->load->view('about', $fetch);
        $this->load->view('layout/ds-footer-home');
    }


    public function uploads()
    {
        // $fetch['artist'] = $this->artist->get_artist();
        // $this->load->view('artist/profiles', $fetch);
        $this->load->view('form_upload');
    }

    public function run()
    {
        echo "create";
    }
    public function insert_audio()
    {

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'mp3|wav';
        $config['max_size']             = 50024;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('mime')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('form_upload', $error);
        } else {
            $image_data = $this->upload->data();
            $imgdata = file_get_contents($image_data['full_path']);
            $file_encode = $imgdata;
            $data['mime'] = $file_encode;
            $data['file_desc'] = $this->input->post('file_desc');
            $data['file_types'] = $this->upload->data('file_type');
            $data['file_sizes'] = $this->upload->data('file_size');
            $data['file_names'] =  $this->upload->data('file_name');
            $this->db->insert('beat', $data);
            unlink($image_data['full_path']);
            redirect('main');

            // $this->db->insert('beat', $data);
            // unlink($msc_data['full_path']);
            // redirect('main/show');
        }
    }

    public function insert_multi()
    {
        if ($this->input->post('Submit')) {

            $config['upload_path'] = './files/full/';   // Directory
            $config['allowed_types'] = 'mp3|wav';  //type of images allowed
            $config['max_size'] = '500000';   //Max Size
            $config['encrypt_name'] = TRUE;   // For unique image name at a time

            $this->load->library('upload', $config);  //File Uploading library
            $this->upload->do_upload('full_version');  // input name which have to upload
            $video_upload = $this->upload->data();   //variable which store the path

            //--------------End of Image File  Section------------------------//



            //---------Thumbnail Image Upload Section Start Here -----------//

            $config2['upload_path'] = './files/demo/';   // Directory
            $config2['allowed_types'] = 'mp3|wav'; //type of images allowed
            $config2['max_size'] = '500000';   //Max Size
            $config2['encrypt_name'] = TRUE;   // For unique image name at a time


            $this->upload->initialize($config2); //we can not use upload library again and again it will not initialize again and again so thats why i have used initialize
            $this->upload->do_upload('demo_version');  // File Name
            $thumbnail_upload = $this->upload->data(); // store the name of the file

            //--------End of Thumbnail Upload Section-----------//



            $date = date("d-m-Y");  // Store current date in variable

            // Here the database query to insert

            $data = array(

                'full_version' => $thumbnail_upload['file_name'],
                'demo_version' => $video_upload['file_name'],


            );

            $this->db->insert('beat', $data);
        }
    }

    public function download($id_beat)
    {
        if (!empty($id_beat)) {
            //load download helper
            $this->load->helper('download');

            //get file info from database
            $fileInfo = $this->file->getRows(array('id_beat' => $id_beat));

            //file path
            $file = 'uploads/files/' . $fileInfo['file_name'];

            //download file from directory
            force_download($file, NULL);
        }
    }
}
