<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    private $_cart_contents = array();

    public function __construct()
    {
        parent::__construct();

        $this->_cart_contents = $this->session->userdata('cart_contents');
		if ($this->_cart_contents === NULL)
		{
			// No cart exists so we set some base values
			$this->_cart_contents = array('cart_total' => 0, 'total_items' => 0);
		}

        $this->load->model('Cart_model', 'cart_model');
        $this->load->model('Order_model', 'order_model');
        $this->load->model('Order_item_model', 'order_item_model');
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
            $count = $_SESSION['cart_contents']['total_items'];
            $_SESSION['cart_contents']['total_items'] = ++$count;
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

        $_SESSION['cart_contents']['cart_total'] = $cart_total;
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
                    <th colspan="1">' . 'Rs ' . number_format($cart_total) . '</th>
                    <td><a class="btn btn-success btn-sm" href='. site_url('cart/checkout') .'>Proceed to checkout</a></td>
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
            $count = $_SESSION['cart_contents']['total_items'];
            $_SESSION['cart_contents']['total_items'] = --$count; 
            return $this->load_cart();
        }else{
            print_r("Error while deleting the cart item from db");
        };
    }

    function checkout(){

        $this->form_validation->set_rules('firstname', 'First Name', 'min_length[3]|max_length[20]|trim|required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'min_length[3]|max_length[20]|trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('address_e', 'Alternate Address', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required');
        $this->form_validation->set_rules('paymentmethod', 'Payment Method', 'trim|required');
        

        if($this->form_validation->run() === FALSE){
            $data['title'] = 'Checkout';
            $data['states'] = json_decode(file_get_contents('./assets/json/state.json'),true);
            
            $this->load->view('templates/header');
            $this->load->view('cart/checkout',$data);
            $this->load->view('templates/footer');
        }else{
            
            if(isset($_SESSION['user_id'])){
                
                $user_id = $_SESSION['user_id'];
                
                $param['user_id'] = $user_id;
                $param['total_amount'] = $_SESSION['cart_contents']['cart_total'];
                $param['payment_code'] = rand(); //unique code send to payment provider
                
                $order_id = $this->order_model->place_order($param);
                $items = $this->cart_model->get_data($user_id);
                
                if(isset($order_id)){
                    
                    $item_inserted = false;
                    foreach($items as $item){
                        $item_inserted = $this->order_item_model->insert($order_id,$item);
                        if(!$item_inserted){
                            break;
                        }
                    }
                    
                    if($item_inserted){
                        print_r('Your order created successfully');
                        $this->cart_model->destroy();
                    }else{
                        print_r(':( Due to technical error unable to create order');
                    }

                }else{
                    print_r(':( Due to technical error unable to create order');
                }
            }
        }
    }


    function _total($items = array()){

        if(! is_array($items) || count($items) == 0){
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