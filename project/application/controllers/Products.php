<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller 
{
 
    public function __construct() 
    {
        parent::__construct();
		
		error_reporting(0);
        
    }
    public function products_list()
    {
        $this->load->view('products_list');
    }

    public function submit_form() {
        $product_name = $this->input->post('product_name');
        $price = $this->input->post('price');

        // Handle image upload
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        // $config['max_size'] = 100;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error['error'];
        } else {
            // $data = array('upload_data' => $this->upload->data());
            $data = $this->upload->data();
            $file_name = $data['file_name'];

            $data = array('product_name'=>$product_name, 'price'=>$price,'image'=>$file_name);
            $res = $this->db->insert('products', $data);
            if($res==1){
                echo json_encode('Data Added Successfully');
            }else{
                echo json_encode('Something went wrong');
            }
        }
    }

    public function get_products()
    {
        $products = $this->db->get('products')->result();
        echo json_encode($products);
    }

    public function add_cart()
    {
        $product_id = $this->input->post('id');
        $data = array('product_id'=>$product_id);
        $res = $this->db->insert('cart', $data);
        if($res==1){
            echo json_encode('Added Successfully');
        }else{
            echo json_encode('Something went wrong');
        }
    }


    public function get_cart_data()
    {
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->join('cart', 'cart.product_id=products.product_id');
        $products=$this->db->get()->result();
        echo json_encode($products);
    }

}

?>