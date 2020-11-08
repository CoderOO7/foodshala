<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

		if (! $this->session->has_userdata('cart_items_count'))
		{
            $this->session->set_userdata('cart_items_count',0);
        }
        
        $this->load->model('Cart_model', 'cart_model');
    }

    function view()
    {
        $data['title'] = 'My Cart';
       
        $this->load->view('templates/header');
        $this->load->view('cart/view', $data);
        $this->load->view('templates/footer');
    }

    function add_to_cart()
    {
        $user_id = $this->session->userdata('user_id');
        if($this->cart_model->insert_data($user_id)){
            $count = $this->session->userdata('cart_items_count');
            $this->session->set_userdata('cart_items_count',++$count);
        }else{
            echo 'Error while saving data in db';
        }
    }

    function show_cart()
    {
        $user_id = $this->session->userdata('user_id');
        $items = $this->cart_model->get_data($user_id);
        $cart_total = $this->_total($items);
        $output = '';
        $no = 0;

        foreach ($items as $item) {
            $no++;
            $output .= '
                    <tr>
                        <td>' . $item['name'] . '</td>
                        <td>' . number_format($item['price']) . '</td>
                        <td><button type="button" id=' . $item['row_id'] . ' class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
                    </tr>
                ';
        }
        $output .= '
                <tr>
                    <th colspan="1">Total</th>
                    <th colspan="2">' . 'Rs ' . number_format($cart_total) . '</th>
                </tr>
            ';
        if ($no === 0) {
            $output = '<p>Cart is empty</p>';
        }

        return $output;
    }

    function load_cart()
    {
        echo $this->show_cart();
    }

    function delete_cart_item()
    {
        if($this->cart_model->delete()){
            $count = $this->session->userdata('cart_items_count');
            $this->session->set_userdata('cart_items_count',--$count);
            return $this->load_cart();
        }else{
            echo "Error while deleting the cart item from db";
        };
    }


    function _total($items = array()){

        if(! is_array($items) OR count($items) == 0){
            log_message('error', 'The insert method must be passed an array containing data.');
            return FALSE;
        }

        $total = 0;
        foreach($items as $item){
            $total += number_format($item['price']) * number_format($item['qty']);
        }
        
        return $total;
    }
}