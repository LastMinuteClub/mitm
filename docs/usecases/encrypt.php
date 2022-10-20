<?php
//WIP
function encrypt_with_256($data, $server_key)
{
    $key = openssl_random_pseudo_bytes(128);
    $length_iv = openssl_cipher_iv_length("aes-256-ctr");
    $iv = openssl_random_pseudo_bytes($length_iv);
    $encrypted = openssl_encrypt($data, "aes-256-ctr", $key, 0, $iv);
    //echo "<script> alert('$encrypted'); </script>";
    //$decrypt = openssl_decrypt($encrypted, "aes-256-ctr", $server_key, 0, $iv);
    //echo "<script> alert('$decrypt'); </script>";
    return $encrypted;
}

function public_key_encrypt($data, $public_key)
{
    openssl_public_encrypt($data, $encrypted_data, $public_key);
    return $encrypted_data;
}

function private_key_encrypt($data, $key)
{
    openssl_private_encrypt($data, $encrypted_data, $key);
    return $encrypted_data;
}

function public_key_decrypt($data, $key)
{
    openssl_public_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

$config = array(
    "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
    'private_key_bits'=> 2048,
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

$test = public_key_encrypt("test", $publickey);

openssl_private_decrypt($test, $decrypted_data, $privatekey);
echo $decrypted_data;
