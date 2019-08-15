<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends CI_Controller {
    


    function __construct(){
        // Construct the parent class
        parent::__construct();

        $this->load->model('maps_model','map');

        $this->load->helper(array('form', 'url'));

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        // $this->data['navigation'] = 'marketing/navigation';
        // $this->data['customjs'] = 'marketing/customjs';
        // $this->data['customcss'] = 'marketing/customcss';
        $this->data['customcss'] = 'default/custom';
    }


	public function index(){
        $this->data['page_title'] = 'Maps | The Terraces';
		$this->data['content'] = 'vmap_terraces';
		$this->data['customjs'] = 'map_terracesjs';
		$this->load->view('header', $this->data);
	}

    public function terraces(){
        $this->data['page_title'] = 'Maps | The Terraces';
        $this->data['content'] = 'vmap_terraces';
        $this->data['customjs'] = 'map_terracesjs';
        $this->load->view('header', $this->data);
    }

    public function ventura2(){
        $this->data['page_title'] = 'Maps | Ventura II';
        $this->data['content'] = 'vmap_ventura2';
        $this->data['customjs'] = 'map_ventura2js';
        $this->load->view('header', $this->data);
    }

    public function ignatius(){
        $this->data['page_title'] = 'Maps | Ignatius Enclave';
        $this->data['content'] = 'vmap_ignatius';
        $this->data['customjs'] = 'map_ignatiusjs';
        $this->load->view('header', $this->data);
    }

    public function valencia(){
        $this->data['page_title'] = 'Maps | Valencia Estate';
        $this->data['content'] = 'vmap_valencia';
        $this->data['customjs'] = 'map_valenciajs';
        $this->load->view('header', $this->data);
    }

    public function teakwood(){
        $this->data['page_title'] = 'Maps | teakwood Hills';
        $this->data['content'] = 'vmap_teakwood';
        $this->data['customjs'] = 'map_teakwoodjs';
        
        $this->load->view('header', $this->data);
    }

    public function lots_info(){
        $this->data['page_title'] = 'Map Information';
        $this->data['content'] = 'lotdetails_form';
        $this->data['customjs'] = 'mapinfo';
        $this->data['lots'] = $this->map->all_lots_model();
        $this->load->view('header', $this->data);
    }
  
    public function get_all_lots(){
        echo json_encode($this->map->all_lots_model());
    }
    
     public function get_lot(){
        $lot_id = $this->input->post('lot_id');
        echo json_encode($this->map->get_lot_model($lot_id));
    }
	

    public function save_lot_info() {
        $arrfile =  $this->fileupload($this->input->post('userfile'));
        $filename = "";
        if(array_key_exists('data',$arrfile)){
            $filename = $arrfile['data'];
        }
        $id = $this->input->post('lot_id');

        $data = array(
            'picture_url' => $filename,
            'lot_width' => $this->input->post('lot_width'),
            'lot_length' => $this->input->post('lot_length'),
            'floor_area' => $this->input->post('floor_area'),
        );
        echo json_encode($this->map->save_lot_info($id, $data));
    }   

    //separate upload function
    public function fileupload($userfile){

        $config['upload_path']          = "./public/images/houses/";
        $config['allowed_types']        = 'gif|jpg|png';   
        $config['max_size']             = 50000;
        $config['max_width']            = 52024;
        $config['max_height']           = 51768;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        // echo($userfile);
        if ( !$this->upload->do_upload($userfile)){         
            $error =  array('error' => $this->upload->display_errors());
            return $error;
        }else{
            $datafile = array('data' => $this->upload->data('file_name'));
            return $datafile;
        }
    }

    public function do_upload(){
        $config['upload_path']="./public/images/houses/";
        $config['allowed_types']='gif|jpg|png';
        $config['max_size']             = 50000;
        $config['max_width']            = 52024;
        $config['max_height']           = 51768;
        $this->load->library('upload',$config);
        $id = $this->input->post('lot_id');

        if($this->upload->do_upload("file")){
            $data = array('upload_data' => $this->upload->data());
            $data1 = array(
                'lot_width' => $this->input->post('lot_width'),
                'lot_length' => $this->input->post('lot_length'),
                'floor_area' => $this->input->post('floor_area'),
                'picture_url' => $data['upload_data']['file_name'],
            );
            echo json_encode($this->map->save_lot_info($id, $data1));
            // echo $result;
            // if ($result == TRUE) {
            //     echo "true";
            // }else{
            //     echo "false";
            // }
        }

    }
}
