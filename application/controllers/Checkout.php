<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller {

    public function __construct(){

        parent:: __construct();


    }
    
    // Checkout cart
    public function index(){
      
        //  echo"<pre>";
        //  print_r($_SESSION["cart_items"]);
        //  session_destroy();
        //  exit;


        $this->load->view('checkout');
    }
    // cart Add Items
    public function add_cart(){


        $data = array(
            'domain_id'=> $this->input->post('domain_id'),
            'domainName'=> $this->input->post('domainName'),
            'category_id'=> $this->input->post('category_id'),
            'year'=> $this->input->post('year'),
            'price'=> $this->input->post('price'),
            'purpose'=> $this->input->post('purpose'),
            'renew_price'=> 0,
        );

        $data['price'] = str_replace(",","",$data['price']);
        $data['renew_price'] = str_replace(",","",$data['renew_price']);

        // echo"<pre>";
        //  print_r($data);

        if($this->session->userdata('id') && $this->session->userdata('username')){
            
            				// cart functionality insert in database
                $cart_user_id = $this->session->userdata('id');
                // echo $cart_user_id;
                
                $this->load->model('Domain');
                
                $cart_item_result = $this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result();

                    if($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->num_rows()){

                        $item_array_id = array_column($cart_item_result,"domainName");

                        if(!in_array($data['domainName'],$item_array_id)){

                            $count = count($cart_item_result);
                            // $cart_item_result[$count] = $data;

                                if($this->Domain->add_domain_cart($cart_user_id, $data)){
                                    // echo "SUcess";
                                    
                                    $count = count($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result());
                                    $_SESSION["cart_items"][$count] = $data;
                                    echo $count;
                                    echo '<script> alert("Product Added into Cart!"); </script>';
                                }else{
                                    
                                    $count = count($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result());
                                    echo $count;
                                    echo '<script> alert("Product Added into Cart failed!"); </script>';
                                }

                            // exit;

                            // echo 'Product Added into Cart!';
                        }else{
                            if($this->session->userdata('cart_items')){
                                // echo "<pre>";
                                // print_r($_POST);
                
                                $item_array_id = array_column($_SESSION["cart_items"],"domainName");
                                if(!in_array($data['domainName'],$item_array_id)){
                
                                    $count = count($_SESSION["cart_items"]);
                                    $_SESSION["cart_items"][$count] = $data;
                                    // echo 'Product Added into Cart!';
                                    // echo '<script> alert("Product Added into Cart!"); </script>';
                                    // // echo count($this->session->userdata("cart_items"));
                                    // $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
                                }else{
                                    // echo '<script> alert("Already Exist in Cart!"); </script>';
                                    // // echo count($this->session->userdata("cart_items"));
                                    // $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
                                }
                
                            }else{
                                $_SESSION["cart_items"][0] = $data;
                                    // echo 'Product Added into Cart!';
                                // echo '<script> alert("Product Added into Cart!"); </script>';
                                //     // echo count($this->session->userdata("cart_items"));
                                //     $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
                            }
                                $count = count($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result());
                                echo $count;
                                echo '<script> alert("Already Exist in Cart!"); </script>';
                        }
                        // print_r( $item_array_id);
                        // echo "hello";
                        
                    }else{
                        if($this->Domain->add_domain_cart($cart_user_id, $data)){
                            // echo "SUcess";
                            
                            $count = count($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result());
                            $_SESSION["cart_items"][0] = $data;
                            echo $count;
                            echo '<script> alert("Product Added into Cart!"); </script>';
                        }else{
                            
                            $count = count($this->db->where(['user_id'=>$cart_user_id])->get('cart_items')->result());
                            echo $count;
                            echo '<script> alert("Product Added into Cart failed!"); </script>';
                        }
                    }            
                    
        }else{

            if($this->session->userdata('cart_items')){
                // echo "<pre>";
                // print_r($_POST);

                $item_array_id = array_column($_SESSION["cart_items"],"domainName");
                if(!in_array($data['domainName'],$item_array_id)){

                    $count = count($_SESSION["cart_items"]);
                    $_SESSION["cart_items"][$count] = $data;
                    // echo 'Product Added into Cart!';
                    echo '<script> alert("Product Added into Cart!"); </script>';
                    // echo count($this->session->userdata("cart_items"));
                    $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
                }else{
                    echo '<script> alert("Already Exist in Cart!"); </script>';
                    // echo count($this->session->userdata("cart_items"));
                    $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
                }

            }else{
                $_SESSION["cart_items"][0] = $data;
                    // echo 'Product Added into Cart!';
                echo '<script> alert("Product Added into Cart!"); </script>';
                    // echo count($this->session->userdata("cart_items"));
                    $cartCount=0; if($this->session->userdata('cart_items')){echo ($cartCount) + (count($this->session->userdata('cart_items')));}else{ echo $cartCount; }
            }
        }

    }


    // Delete Cart Items Function cart_delete($domainName) take domainName parameter

    public function cart_delete(){
        // print_r($this->input->post());
        // exit;
        $domainName = $this->input->post('domainName');
        
        if($this->session->userdata('id') && $this->session->userdata('username')){

                 $cart_user_id = $this->session->userdata('id');
            $this->db->delete('cart_items',['user_id'=>$cart_user_id,'domainName'=>$domainName]);
            if($this->session->userdata('cart_items')){
              foreach($_SESSION["cart_items"] as $keys => $values){

                if($values["domainName"] == $domainName){
                    unset($_SESSION["cart_items"][$keys]);
                    redirect('checkout');
                }
            }
                
            }
        }
        else {

            foreach($_SESSION["cart_items"] as $keys => $values){

                if($values["domainName"] == $domainName){
                    unset($_SESSION["cart_items"][$keys]);
                   
                    redirect('checkout');
                }
            }
        }

        redirect('checkout');
    }


    //update Cart Items function  update_cart()
    public function update_cart(){ 
        
        $domain_id = $this->input->post('domain_id');
        $domainName = $this->input->post('domainname');
        $year = $this->input->post('year');
        $price = $this->input->post('price');
        $purpose = $this->input->post('purpose');
        $this->load->model('Domain');

        // echo $domainName;
        $data = $this->Domain->fetchPrice($domainName);
       
        $renew_price =0;
        // echo"<pre>";
        //  print_r($_POST);
        //  exit;

             if($data){
            $price = ($data[0]->buy_price);
             if($year >= 1){

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$domainName);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                
                $result = json_decode($result,true);

                curl_close($ch);
                $renew_price = $result['renewalPrice'] *($year-1);
             }
            }
            else{
                
                
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains:checkAvailability');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"domainNames\":[\"".$domainName."\"]}");
                curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                $headers = array();
                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                    if (curl_errno($ch)) {
                        echo 'Error:' . curl_error($ch);
                    }
                    $result = json_decode($result,true);
                    // print_r($result);
                    if(isset($result['results'])){

                        // echo "match ";
                        foreach($result as $key => $values){
                            // print_r($values[0]);
                            // echo $values[0]['domainName'];
                            if(isset($values[0]['purchasable'])){
                                // echo "purchasable";
                                if($year >= 1){
                                $renew_price = $values[0]['renewalPrice'] *($year-1);
                                }
                            }

                        }
                        //foreach close
                        }

            }
        //  elseif($purpose == "Lease"){
        //     $price = ($data[0]->lease_price);
        //  }
            // echo $renew_price.'<br>';
        // echo $price = ($data[0]->buy_price);
        // exit;
            // print_r($_SESSION["cart_items"]);
 if($this->session->userdata('id') && $this->session->userdata('username')){
    $cart_user_id = $this->session->userdata('id');
    $this->db->where(['domainName'=>$domainName,'user_id'=>$cart_user_id])
    ->update('cart_items', ['price'=>$price,'renew_price'=>$renew_price,'year'=>$year]);
        // echo "success";
 }  
 
    if($_SESSION["cart_items"]){
        foreach($_SESSION["cart_items"] as $keys => $values){
           
            if($values["domainName"] == $domainName){
                $_SESSION["cart_items"][$keys]['domainName'] = $domainName;
                $_SESSION["cart_items"][$keys]['price'] = $price;
                $_SESSION["cart_items"][$keys]['renew_price'] = $renew_price;
                $_SESSION["cart_items"][$keys]['purpose'] = $purpose;
                $_SESSION["cart_items"][$keys]['year'] = $year;
                
            // echo "success";
                }
            }
        }  

    }


    // Payment Function created payment()

    // Payment Function created payment()
    public function payment(){
            
        
        if(!$this->session->userdata('id') && !$this->session->userdata('username'))
		return redirect('login');
        if($this->session->userdata('id') && $this->session->userdata('username')){
            if(!$this->db->where(['user_id'=>$this->session->userdata('id')])->get('cart_items')->result()){
            return redirect('checkout');
            }else{
                $this->load->view('payment');
            }
        }elseif(!$this->session->userdata('cart_items')){
            return redirect('checkout');
        }

    // cart functionality insert in database
    	    $this->load->model('Domain');
                $cart_user_id = $this->session->userdata('id');
                // echo "<pre>";
                // print_r($_SESSION["cart_items"]);
                if($this->session->userdata('cart_items')){
                    foreach($_SESSION["cart_items"] as $keys => $values){
                        if($this->db->where(['domainName'=>$values['domainName'],'user_id'=>$cart_user_id])->get('cart_items')->num_rows() == 0){
                        $this->Loginmodel->add_domain_cart($cart_user_id, $_SESSION["cart_items"][$keys]);
                        }else{
                            
                            $this->db->where(['domainName'=>$values['domainName'],'user_id'=>$cart_user_id])
                                        ->update('cart_items', $_SESSION["cart_items"][$keys]);
                            // echo "Username already exists";
                            // $this->Loginmodel->add_domain_cart($user_id, $_SESSION["cart_items"][$keys]);
                        }
                    }
                }
                // exit;
        // $this->load->view('payment');
            
    }

    public function paymentProcess(){
        // timezone
        date_default_timezone_set('America/New_York');
        // check whether stripe token is not empty
        if(!empty($_POST['stripeToken'])){

            // echo "<pre>";
            // print_r($_REQUEST);
            // get token, card and user info from the form
            $token = $_POST['stripeToken'];
            $card_num = $_POST['card_num'];
            $card_cvc = $_POST['cvc'];
            $card_exp_month = $_POST['exp_month'];
            $card_exp_year = $_POST['exp_year'];
            $expiry_data = $card_exp_month.'/'.$card_exp_year;
            $total_items = $_POST['total_items'];
            $total_payment = $_POST['payment'];
            $order_items = $this->session->userdata('cart_items');

            $user_data = $this->db->where(['id'=>$this->session->userdata('id'),'username'=>$this->session->userdata('username')])->get('users')->result();
            // echo "<pre>";
            // print_r($user_data);
    
            foreach($user_data as $data){
                $email = $data->email;
            }
            // print_r($this->session->userdata('cart_items'));
            // exit;

            require_once APPPATH."third_party/stripe/init.php";

            //set api key
            $stripe = [
                "secret_key"        => "sk_test_w6hqUS50xrLzvdbt9vHmzPfN00ZpQArPSf",
                "publishable_key"   => "pk_test_XF6R7Eh2pMTyJYyQFgSX8WWU00F5Ca5Ll6
                "
            ];

            \Stripe\Stripe::setApiKey($stripe["secret_key"]);

            // add customer to stripe
            $customer = \Stripe\Customer::create(array(
                'email'     => $email,
                'source'    => $token
            ));

            //item information
            $itemName = "ONLINE.INC ORDER";
            $orderNumber = "ONLINE".rand();
            $itemPrice  = $total_payment * 100;
            $currency   = "usd";
            // $orderID    = "SKA1456615858";

            //charge a credit or debit card

            $charge = \Stripe\Charge::create([
                'customer'  => $customer->id,
                'amount'    => $itemPrice,
                'currency'  => $currency,
                'description'=> $orderNumber,
                'metadata'  => array(
                    'item_id'   => $orderNumber
                )
            ]);

            //retrive charge details
            $chargeJson = $charge->jsonSerialize();

            //check whether the charge is successful 
            if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured']==1 ){

                //order details
                $amount =   $chargeJson['amount'] / 100;
                $balance_transaction =   $chargeJson['balance_transaction'];
                $currency =   $chargeJson['currency'];
                $status =   $chargeJson['status'];
                $date =   date("Y-m-d H:i:s");
                
                //insert transaction  data into the database
                $datadbnew = [
                    'user_id'=> $this->session->userdata('id'),//$this->session->userdata('id') ,
                    'order_number'  =>$orderNumber,
                    'item_price'  =>$total_payment,
                    'item_price_currency'  =>$currency,
                    'paid_amount'  =>$amount,
                    'paid_amount_currency'  =>$currency,
                    'txn_id'  =>$balance_transaction,
                    'payment_status'  =>$status,
                    'created'  =>$date,
                    'modified'  =>date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + 365 day")),
                ];
                 
                // print_r($datadbnew);
                // echo $status;
                // $this->db->insert('orders',$datadbnew);
                // // $last_transaction['insertID'] = $this->db->insert_id();
                // print_r($this->db->insert_id());
                // exit;
                    if($this->db->insert('orders',$datadbnew)){
                            if($this->db->insert_id() && $status == 'succeeded'){
                                
                                $last_transaction['insertID'] = $this->db->insert_id();

                                $transaction_id = $last_transaction['insertID'];
                                // echo  $transaction_id;
                                // exit;
                                $cart_items_new = $this->db->where(['user_id'=>$this->session->userdata('id')])->get('cart_items')->result();
                                // print_r ($last_transaction);

                                // print_r($cart_items_new);

                                foreach($cart_items_new as $rows){

                                    $insert_order_items = $this->db->insert('order_items',['order_id'=>$transaction_id,'domain_id'=>$rows->domain_id,'domainName'=>$rows->domainName,'price'=>$rows->price,'renew_price'=>$rows->renew_price,'year'=>$rows->year,'created'=>$date,'renew_date'=>date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + ".$rows->year." year"))]);

                                    // Insert Users Purchased Domain
                                    if($this->db->where(['domainName'=>$rows->domainName,'user_id'=>$this->session->userdata('id')])->get('users_domain')->num_rows() == 0){

                                        $this->db->insert('users_domain',['user_id'=>$this->session->userdata('id'),'domainName'=>$rows->domainName,'created_date'=>$date,'renewal_date'=>date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + ".$rows->year." year"))]);
                                    }else{
                                        $this->db->where(['domainName'=>$rows->domainName,'user_id'=>$this->session->userdata('id')])
										->update('users_domain',['created_date'=>$date,'renewal_date'=>date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + ".$rows->year." year"))]);
                                    }
                                    
                                    // domain status change in domainlist
                                    $this->db->where(['domainName'=>$rows->domainName])
                                    ->update('domain_list',['status'=>0]);

                                    // Delete Cart Items
                                    $this->db->delete('cart_items',['user_id'=>$this->session->userdata('id')]);

                                    unset($_SESSION["cart_items"]);
                                    
                                    // echo $transaction_id ;
                                    // exit;
                                    if($insert_order_items ){

                                        $ch = curl_init();

                                        curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$rows->domainName);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
                                        
                                        curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');
                                        
                                        $result = curl_exec($ch);
                                        if (curl_errno($ch)) {
                                            echo 'Error:' . curl_error($ch);
                                        }
                                        curl_close($ch);
                                        // echo "<pre>";
                        
                                        $array = json_decode($result,true);

                                                // check domain on our api is available or not
                                            // if(isset($array['domainName'])){

                                            //         // echo "domain found";
                                            //         // echo $array['renewalPrice'];

                                            //         $ch = curl_init();

                                            //         curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$rows->domainName.':renew');
                                            //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            //         curl_setopt($ch, CURLOPT_POST, 1);
                                            //         curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"purchasePrice\":".$array['renewalPrice'].",\"years\":".$rows->year."}");
                                            //         curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                                            //         $headers = array();
                                            //         $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                                            //         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                                            //         $result = curl_exec($ch);
                                            //         if (curl_errno($ch)) {
                                            //             echo 'Error:' . curl_error($ch);
                                            //         }
                                            //         curl_close($ch);

                                            // }
                                            // elseif(isset($array['message'])){
                                            // //   print_r($rows);
                                            //     $ch = curl_init();

                                            //     curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains');
                                            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            //     curl_setopt($ch, CURLOPT_POST, 1);
                                            //     curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"domain\":{\"domainName\":\"".$rows->domainName."\"},\"purchasePrice\":".$rows->price.",\"years\":".$rows->year."}");
                                            //     curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');
                                                
                                            //     $headers = array();
                                            //     $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                                            //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                                
                                            //     $result = curl_exec($ch);
                                            //     if (curl_errno($ch)) {
                                            //         echo 'Error:' . curl_error($ch);
                                            //     }
                                            //     curl_close($ch);
                                                
                                            // }
                                    }



                                }

                                // $this->load->view('payment_success',$data);
                                // echo "Transaction success";
                                // print_r($data);
                                $invoice_information = $this->db->select()->from('orders')->where('id',$transaction_id)->get()->result();
                                // $this->session->set_flashdata('payment_success_last_insert',$invoice_information);
                                // exit;
                                // print_r($invoice_information);
                                $this->load->view('paymentStatus',['invoice_information'=>$invoice_information]);
                                //insert data into card details table after successfull payment
                                if($status == 'succeeded'){
                                    $datacardetails = [
                                        'user_id'      => $this->session->userdata('id'),
                                        'card_number'  => $_POST['card_num'],
                                        'amounts'      => $total_payment,
                                        'expiry_date'  => $expiry_data,
                                        'pay_status'   => '1',
                                        'cvv'          => $card_cvc,
                                        'created_date' => $date
                                    ];
                                    //print_r($datacardetails);  
                                    //echo $datacardetails['card_number'];
                                    $this->db->insert('card_details', $datacardetails);
                                    //exit;
                                }
                            }else{
                                echo "Transaction has beed failed";
                            }
                        }else{

                            echo "not inserted. Transaction has been failed";
                        }

                    }
                    
                    else{

                        $this->load->view('paymentStatus');

                    }

        }
        else{
            echo "payment failed";
        }
    }

}

?>
