<?php
    class Cart extends CI_Controller{
        public function __construct() {
            parent::__construct();
            $this->load->model('Cart_model', 'cart_model');
        }

        function view(){
            $data['title'] = 'My Cart';
            $data['items'] = $this->cart->contents();

            $this->load->view('templates/header');
            $this->load->view('cart/view',$data);
            $this->load->view('templates/footer');
        }

        function add_to_cart(){
            $user_id = $this->session->userdata('user_id');
            $data = array(
                'id'=> $this->input->post('id'),
                'name' => $this->input->post('name'), 
                'price' => $this->input->post('price'), 
                'qty' => $this->input->post('quantity'), 
            );
            
            return $this->cart_model->insert_cart_data($user_id,$data);
            // echo $this->show_cart();
        }
    
        function show_cart(){
            $user_id = $this->session->userdata('user_id');
            $cart_data = $this->cart_model->get_cart_data($user_id);
            $output = '';
            $no = 0;
             
            foreach ($cart_data as $items){
                $no++;
                $output .='
                    <tr>
                        <td>'.$items['name'].'</td>
                        <td>'.number_format($items['price']).'</td>
                        <td>'.$items['qty'].'</td>
                        <td>'.number_format($items['subtotal']).'</td>
                        <td><button type="button" id="'.$items['rowid'].'" class="romove_cart btn btn-danger btn-sm">Cancel</button></td>
                    </tr>
                ';
                   
            }
            $output .= '
                <tr>
                    <th colspan="3">Total</th>
                    <th colspan="2">'.'Rs '.number_format($this->cart->total()).'</th>
                </tr>
            ';
            /* if($no === 0){
                $output = '<h3 align="center">Cart is empty</h3>';
            } */
            return $output; 
        }
    
        function load_cart(){ 
            echo $this->show_cart();
        }
     
        function delete_cart(){ 
            $data = array(
                'rowid' => $this->input->post('row_id'), 
                'qty' => 0, 
            );
            $this->cart->update($data);
            echo $this->show_cart();
        }
    }