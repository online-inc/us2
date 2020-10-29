<?php
if(!defined('BASEPATH')) exit('NO Direct script access allowed');

class MY_Controller extends CI_Controller
{
        // getDomainAPI($domainName): this function will get domain details of particular domain
    public function getDomainAPI($domainName){

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
            return($array);
            // echo "</pre>";
        curl_close($ch);

    }

        // updateNameserverAPI($domainName,$nameservers): this function will update or add domain details of particular domain
    public function updateNameserverAPI($domainName,$nameservers)
    {

    //     echo "<pre>";
    //  print_r($domainName);
    //  print_r($nameservers);

    //  exit;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.name.com/v4/domains/'.$domainName.':setNameservers');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);

        //check condition for default nameservers
        if(array_key_exists("nameserver1",$nameservers)){

            if($nameservers['nameserver1'] == "ns1.online.inc" || $nameservers['nameserver2'] == "ns2.online.inc"  || $nameservers['nameserver3'] == "ns3.online.inc" || $nameservers['nameserver2'] == "ns4.online.inc" || $nameservers['nameserver5'] == "ns5.online.inc"){

                if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] == '' && $nameservers['nameserver3'] == ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == ''){
                    // echo "Ns0";
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\"]}");
                }
                else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] == ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == ''){
                    // echo "Ns1";
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\"]}");
                }
                else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == '')
                {
                    echo "Ns2";
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\"]}");
                }
                else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != '' && $nameservers['nameserver4'] != '' && $nameservers['nameserver5'] == '')
                {
                    // echo "Ns3";
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");
                }
                else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != '' && $nameservers['nameserver4'] != '' && $nameservers['nameserver5'] != '')
                {
                    // echo "Ns4";
                    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");
                }else{
                    
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");
                }

            } else
            
        if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] == '' && $nameservers['nameserver3'] == ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == ''){
            // echo "Ns0";
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"".$nameservers['nameserver1']."\"]}");
        }
        else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] == ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == ''){
            // echo "Ns1";
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"".$nameservers['nameserver1']."\",\"".$nameservers['nameserver2']."\"]}");
        }
        else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != ''  && $nameservers['nameserver4'] == '' && $nameservers['nameserver5'] == '')
        {
            // echo "Ns2";
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"".$nameservers['nameserver1']."\",\"".$nameservers['nameserver2']."\",\"".$nameservers['nameserver3']."\"]}");
        }
        else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != '' && $nameservers['nameserver4'] != '' && $nameservers['nameserver5'] == '')
        {
            // echo "Ns3";
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"".$nameservers['nameserver1']."\",\"".$nameservers['nameserver2']."\",\"".$nameservers['nameserver3']."\",\"".$nameservers['nameserver4']."\"]}");
        }
        else if($nameservers['nameserver1'] != '' && $nameservers['nameserver2'] != '' && $nameservers['nameserver3'] != '' && $nameservers['nameserver4'] != '' && $nameservers['nameserver5'] != '')
        {
            // echo "Ns4";
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"".$nameservers['nameserver1']."\",\"".$nameservers['nameserver2']."\",\"".$nameservers['nameserver3']."\",\"".$nameservers['nameserver4']."\",\"".$nameservers['nameserver5']."\"]}");
        }else{
            
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");
        }
    }else{
        //update default nameservers
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");
    }


            // curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"nameservers\":[\"ns1.name.com\",\"ns2.name.com\",\"ns3.name.com\",\"ns4.name.com\"]}");

        curl_setopt($ch, CURLOPT_USERPWD, 'lcburgess' . ':' . '0cb93e671516d9f527500f9680b35ed155aa786e');

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }

        $array = json_decode($result,true);
        //    echo '<pre>';
        //         print_r($array);
        //    echo "</pre>";
        //    exit;
           return($array);
        curl_close($ch);
    }
        //
    public function listDnsRecordAPI(){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.dev.name.com/v4/domains/example.org/recor');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

        curl_setopt($ch, CURLOPT_USERPWD, 'username' . ':' . 'token');

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}

?>