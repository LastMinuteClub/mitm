<?php

function generate_keys()
{
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
    $publickey = $publickey["key"];

    echo $publickey;
    echo "/////////////////////////////";
    echo $privatekey;
    echo "/////////////////////////////";

    return array($privatekey, $publickey);
}
