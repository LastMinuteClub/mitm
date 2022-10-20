<?php
require '../../vendor/autoload.php';
// need to change the ip and port
$ip = "localhost";
$port = "";
$url = "MITM/notelist.php";
$query = "";

try {

    $client = new GuzzleHttp\Client(['verify' => false]);
    $response = $client->request('GET', 'http://' . $ip . ":" . $port . "/" . $url . "?" . $query);
    //If all right then display the form
    if ($response->getStatusCode() == 200) {
        //$xml = simplexml_load_string($response->getBody());
        //$test = $response->getHeader("headers");
        //var_dump($test);
        var_dump($response);
    } else {
        echo "Error : " . $response->getStatusCode();
    }
} catch (Exception $e) {
    echo "Error [RES]: \n";
    echo "<pre>";
    print_r($e);
    echo "</pre>";
}
