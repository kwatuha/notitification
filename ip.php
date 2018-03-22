<?php

test();
function sendData(){
     libxml_use_internal_errors(true);
     $URL = "http://localhost:88/smp/index.php?user=ImpactRDO";

            $ch = curl_init($URL);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
            curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            $creditBalance='';
            if($output){
                $oXML = new SimpleXMLElement($output);
                $creditBalance= $oXML->credit;
                libxml_clear_errors();
            }
            curl_close($ch);
return trim($creditBalance);

}

function test(){

    $url = 'http://intellibizafrica.co.ke/impact/index.php?user=ImpactRDO';
    $data = array("first_name" => "First name","last_name" => "last name","email"=>"email@gmail.com","addresses" => array ("address1" => "some address" ,"city" => "city","country" => "CA", "first_name" =>  "Mother","last_name" =>  "Lastnameson","phone" => "555-1212", "province" => "ON", "zip" => "123 ABC" ) );
    $ch=curl_init($url);
    $data_string = urlencode(json_encode($data));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("customer"=>$data_string));


    $result = curl_exec($ch);
    curl_close($ch);

    echo $result;
}

?>