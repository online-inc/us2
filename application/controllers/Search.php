<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends MY_Controller {

	public function __construct(){

		parent:: __construct();

    }

    public function index(){
            // check search value from another pages 
            if($this->input->get('search')){

                $this->load->view('search',['searchValue'=>$this->input->get('searchDomain')]);
            }else{
                $this->load->view('search');
            }
    }

    public function searchDomainAPI(){

        $domainName = $this->input->post('domainName');// get domain search value
        $domainName = strtolower($domainName);  // convert string in lower case
        $domainName = str_replace(' ', '', $domainName); // replace all the spaces with null in the string
            if($domainName != ''){
                
                //check domain contain " . " in string
                if (strpos($domainName, '.') !== false) {
                
                    $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$domainName);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

                curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo 'Error:' . curl_error($ch);
                }
                // echo "<pre>";

                $array = json_decode($result,true);
                    // echo $name.'<br>';
                    
                    // print_r($array);
             
                if(isset($array['domainName'])){

                    $this->load->model('domain');
                    $data = $this->domain->exactMatch($array['domainName']);
                    
                    if($data == true){

                            // echo  $domainName;
                            // print_r($data);
                            // $this->load->view('search',['list'=>$array,'searchValue'=>$domainName,'exactMatch'=>$data]);

                            echo'
                                
                        <div class="row">
                        <div class="col-lg-5">
                        <h4 class="card-title"><b>'.$array['domainName'].'</b></h4>
                        </div>';
                        
                            foreach($data as $row) { 
                            
                            echo '
                            <div class="col-lg-3">
                                <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.$row->buy_price.'/ <br></var><medium class="text-danger">Renewal Price $'.$array['renewalPrice'].'</medium>
                                </div>
                            </div>
                            <div class="col-lg-4 text-right">
                        
                                <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$row->domainName.'" data-domainid="'.$row->id.'" data-category="'.$row->category_id.'" data-year="1" data-price="'.$row->buy_price.'" data-purpose="Buy">Add to Cart</a>

                                <a href="javascript:void(0);" type="button" class="card-link btn btn-info"  data-domainname="'.$row->domainName.'" data-domainid="'.$row->id.'" data-category="'.$row->category_id.'" data-year="1" data-price="'.$row->lease_price.'" data-purpose="Lease">Lease Now</a>
                            </div>
                            </div>
                                ';
                                }

                        } else{

                            // if Domain Not found in the database or sold out

                            echo'
                                
                            <div class="row">
                            <div class="col-lg-12">
                            <h4 class="card-title text-center text-success"><b>'.$array['domainName'].'</b> already taken!</h4>
                            </div>';

                         
                        }
                    }
                        // if domain not found in API with username account of name.com 
                    elseif(isset($array['message'])){
                      
                        if (strpos($domainName, '.') !== false) {

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
                                // echo "no record";

                                    
                                    // print_r($result['results']);
                                    if(isset($result['results'])){

                                        // echo "match ";
                                        foreach($result as $key => $values){

                                            // print_r($values[0]);
                                            // echo $values[0]['domainName'];
                                            if(isset($values[0]['purchasable'])){
                                                // echo "purchasable";

                                                echo'
                                
                                                <div class="row">
                                                <div class="col-lg-5">
                                                <h4 class="card-title"><b>'.$values[0]['domainName'].'</b></h4>
                                                </div>';

                                                echo '
                                                <div class="col-lg-3">
                                                    <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.number_format($values[0]['purchasePrice'], 2).' / </var><medium class="text-danger "><br>Renewal Price $'.number_format($values[0]['renewalPrice'], 2).'</medium>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-right">
                                            
                                                    <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$values[0]['domainName'].'" data-domainid="name.com" data-category="name.com" data-year="1" data-price="'.number_format($values[0]['purchasePrice'], 2).'" data-purpose="Buy">Add to Cart</a>
                    
                                                    <!-- <a href="javascript:void(0);" type="button" class="card-link btn btn-info"  data-domainname="" data-domainid="" data-category="" data-year="1" data-price="" data-purpose="Lease">Lease Now</a> -->
                                                </div>
                                                </div>
                                                    ';
                                            }else{
                                                echo'
                                                <div class="row">
                                                <div class="col-lg-12">
                                                <h4 class="card-title text-center text-success"><b>'.$values[0]['domainName'].'</b> already taken!</h4>
                                                </div>';
                                            }

                                        }
                                        //foreach close
                                    }else{
                                        
                                        // user search wrong extension with name domain
                                        $explode_domainName = explode(".",$domainName);
                                        // print_r ($explode_domainName);
                                        $domainFirstname = $explode_domainName[0];
                                        $domainFirstname = $domainFirstname.'.com';
                                        // echo $domainFirstname ;
                                        
                                        
                                            $ch = curl_init();

                                            curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains:checkAvailability');
                                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                            curl_setopt($ch, CURLOPT_POST, 1);
                                            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"domainNames\":[\"".$domainFirstname."\"]}");
                                            curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                                            $headers = array();
                                            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                                            $result = curl_exec($ch);
                                                if (curl_errno($ch)) {
                                                    echo 'Error:' . curl_error($ch);
                                                }
                                                $result = json_decode($result,true);
                                                // echo "no record";
                                                  // print_r($result['results']);
                                    if(isset($result['results'])){

                                        // echo "match ";
                                        foreach($result as $key => $values){

                                            // print_r($values[0]);
                                            // echo $values[0]['domainName'];
                                            if(isset($values[0]['purchasable'])){
                                                // echo "purchasable";

                                                echo'
                                
                                                <div class="row">
                                                <div class="col-lg-5">
                                                <h4 class="card-title"><b>'.$values[0]['domainName'].'</b></h4>
                                                </div>';

                                                echo '
                                                <div class="col-lg-3">
                                                    <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.number_format($values[0]['purchasePrice'], 2).' / </var><medium class="text-danger "><br>Renewal Price $'.number_format($values[0]['renewalPrice'], 2).'</medium>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 text-right">
                                            
                                                    <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$values[0]['domainName'].'" data-domainid="name.com" data-category="name.com" data-year="1" data-price="'.number_format($values[0]['purchasePrice'], 2).'" data-purpose="Buy">Add to Cart</a>
                    
                                                    <!-- <a href="javascript:void(0);" type="button" class="card-link btn btn-info"  data-domainname="" data-domainid="" data-category="" data-year="1" data-price="" data-purpose="Lease">Lease Now</a> -->
                                                </div>
                                                </div>
                                                    ';
                                            }else{
                                                echo'
                                                <div class="row">
                                                <div class="col-lg-12">
                                                <h4 class="card-title text-center text-success"><b>'.$values[0]['domainName'].'</b> already taken!</h4>
                                                </div>';
                                            }

                                        }
                                        //foreach close
                                        }
                                    }
                                
                            // print_r($result);
                            // exit;
                            curl_close($ch);
                            
                            }

                    }else{
                        echo 'hello';

                                $explode_domainName = explode(".",$domainName);
                                // print_r ($explode_domainName);
                                $domainFirstname = $explode_domainName[1];
                                $domainFirstname = $domainFirstname.$domainName;
                                // echo $domainFirstname;

                                $ch = curl_init();

                                curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains:checkAvailability');
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($ch, CURLOPT_POST, 1);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"domainNames\":[\"".$domainFirstname."\"]}");
                                curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

                                $headers = array();
                                $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                                $result = curl_exec($ch);
                                    if (curl_errno($ch)) {
                                        echo 'Error:' . curl_error($ch);
                                    }
                                    $result = json_decode($result,true);
                                    // echo "no record";
                                        // print_r($result['results']);
                                if(isset($result['results'])){

                                    // echo "match ";
                                foreach($result as $key => $values){

                                        // print_r($values[0]);
                                        // echo $values[0]['domainName'];
                                        if(isset($values[0]['purchasable'])){
                                            // echo "purchasable";

                                            echo'
                    
                                    <div class="row">
                                    <div class="col-lg-5">
                                    <h4 class="card-title"><b>'.$values[0]['domainName'].'</b></h4>
                                    </div>';

                                    echo '
                                    <div class="col-lg-3">
                                        <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.number_format($values[0]['purchasePrice'], 2).' / </var><medium class="text-danger "><br>Renewal Price $'.number_format($values[0]['renewalPrice'], 2).'</medium>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-right">
                                
                                        <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$values[0]['domainName'].'" data-domainid="name.com" data-category="name.com" data-year="1" data-price="'.number_format($values[0]['purchasePrice'], 2).'" data-purpose="Buy">Add to Cart</a>

                                        <!-- <a href="javascript:void(0);" type="button" class="card-link btn btn-info"  data-domainname="" data-domainid="" data-category="" data-year="1" data-price="" data-purpose="Lease">Lease Now</a> -->
                                    </div>
                                    </div>
                                        ';
                                }else{
                                    echo'
                                    <div class="row">
                                    <div class="col-lg-12">
                                    <h4 class="card-title text-center text-success"><b>'.$values[0]['domainName'].'</b> already taken!</h4>
                                    </div>';
                                }
                                }
                                //foreach close
                            }else{
                                

                            echo'
                            <div class="row">
                            <div class="col-lg-12">
                            <h4 class="card-title text-center text-success"><b>Use Correct Key Word</b></h4>
                            </div>';
                            }
                    } 

                }else{
                    $domainName = $domainName.'.com';
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
                        // echo "no record";

                            
                            // print_r($result['results']);
                            if(isset($result['results'])){

                                // echo "match ";
                                foreach($result as $key => $values){

                                    // print_r($values[0]);
                                    // echo $values[0]['domainName'];
                                    if(isset($values[0]['purchasable'])){
                                        // echo "purchasable";

                                        echo'
                        
                                        <div class="row">
                                        <div class="col-lg-5">
                                        <h4 class="card-title"><b>'.$values[0]['domainName'].'</b></h4>
                                        </div>';

                                        echo '
                                        <div class="col-lg-3">
                                            <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.number_format($values[0]['purchasePrice'], 2).' / </var><medium class="text-danger "><br>Renewal Price $'.number_format($values[0]['renewalPrice'], 2).'</medium>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                    
                                            <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$values[0]['domainName'].'" data-domainid="name.com" data-category="name.com" data-year="1" data-price="'.number_format($values[0]['purchasePrice'], 2).'" data-purpose="Buy">Add to Cart</a>
            
                                            <!-- <a href="javascript:void(0);" type="button" class="card-link btn btn-info"  data-domainname="" data-domainid="" data-category="" data-year="1" data-price="" data-purpose="Lease">Lease Now</a> -->
                                        </div>
                                        </div>
                                            ';
                                    }else{
                                        echo'
                                        <div class="row">
                                        <div class="col-lg-12">
                                        <h4 class="card-title text-center text-success"><b>'.$values[0]['domainName'].'</b> already taken!</h4>
                                        </div>';
                                    }

                                }
                                //foreach close
                            }
                    // echo 'false';

                }
            
            }
            else{
                echo "failed";
            }
    }

    public function fetch(){

        $output = '';
        $query = '';
        $this->load->model('domain');

        
        if($this->input->post('query')){

            $query = $this->input->post('query');
        }

                $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains:search');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"keyword\":\"".$query."\"}");
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

                                                
                            // print_r($result['results']);
                            if(isset($result['results'])){

                                // echo "match ";
                                foreach($result as $key => $values){

                                    // print_r($values);
                                    // echo $values[0]['domainName'];
                                    foreach($values as $keys => $value){
                                        // print_r($value);

                                        if(isset($value['purchasable'])){
                                            // echo "purchasable";
    
                                            echo'
                                                
                                                <div class="card bg-light">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-5">
                                                            <h4 class="card-title"><b>'.$value['domainName'].'</b></h4>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <div class="card-subtitle mb-2 text-muted"><var class="btn btn-success btn-sm disabled">on sale</var><var class="price"> $'.number_format($value['purchasePrice'], 2).' / </var><medium class="text-danger"><br>Renewal Price $'.number_format($value['renewalPrice'], 2).'</medium>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 text-right">
                                                    
                                                        <a href="javascript:void(0);" type="button" class="card-link btn btn-info btn-orange add_cart"  data-domainname="'.$value['domainName'].'" data-domainid="name.com" data-category="name.com" data-year="1" data-price="'.number_format($value['purchasePrice'], 2).'" data-purpose="Buy">Add to Cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            ';
    
                                        }
                                    }
                                    // else{
                                    //     echo'
                                    //     <div class="row">
                                    //     <div class="col-lg-12">
                                    //     <h4 class="card-title text-center text-success"><b>'.$values[0]['domainName'].'</b> already taken!</h4>
                                    //     </div>';
                                    // }

                                }
                                //foreach close
                            }
                    // echo 'false';

                curl_close($ch);


    }
}

?>
