<?php
session_start();

function generate_keys()
{
    //Config options for key generation
    //Creates key with SHA256 @ 2048 bits
    $config = array(
        "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
        'private_key_bits' => 2048,
        'default_md' => "sha256",
    );
    //GENERATE NEW KEYPAIR
    $new_key_pair = openssl_pkey_new($config);

    //PRIVATE KEY
    openssl_pkey_export($new_key_pair, $privatekey, NULL, $config);

    //PUBLIC KEY
    $publickey = openssl_pkey_get_details($new_key_pair);
    $publickey = $publickey["key"]; //Get public key from keypair

    //Echo keys
    // echo $publickey;
    // echo "/////////////////////////////";
    // echo $privatekey;
    // echo "/////////////////////////////";

    //Return Array
    return array($privatekey, $publickey);
}

$keys = generate_keys();
$_SESSION['server_priv_key'] = $keys[0];
$_SESSION['server_pub_key'] = $keys[1];
?>