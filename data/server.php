<?php
error_reporting(0);
$fetch_url ="https://covid19.mathdro.id/api";
$country_name = "Globally";

$not_found_error ="";
if(isset($_GET['submit'])){
    echo "";
    if(isset($_GET['country']) && strlen($_GET['country']) !==0){
        $fetch_url = $fetch_url.'/countries/'.str_replace(" ", "%20", $_GET['country']);
        $country_name =$_GET['country'];
    }else{
        $fetch_url = $fetch_url;
        $country_name = "Globally";
    }
}
try {
    try{
        $json_data = file_get_contents($fetch_url);
        if($json_data === FALSE){
            throw new Exception("404 not found");
        }
    }catch (Exception $e) {
        $not_found_error = "404";
    }
    
    
if($json_data){
    $response_data = json_decode($json_data);
    $confirmed = $response_data->confirmed->value;
    $recovered = $response_data->recovered->value;
    $deaths = $response_data->deaths->value;
}else{
    throw new Exception();
}
} catch (Exception $e) {
    $server_found_error ="501";
}





$fetch_url_all_countriesC = "https://covid19.mathdro.id/api/confirmed";
$json_data_all_countriesC = file_get_contents($fetch_url_all_countriesC);
$response_data_all_countriesC = json_decode($json_data_all_countriesC);
$death_array = array();
foreach ($response_data_all_countriesC as $key => $value) {
    # code...
    $array_obj = array(
        "name"=> $value->countryRegion,
        "deaths" => $value->deaths,
        "confirmed" => $value->confirmed,
        "recovered"=>$value->recovered
    );
    array_push($death_array, $array_obj);
 }

// print_r(var_dump($death_array));
