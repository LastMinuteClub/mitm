<?php


//Encrypts data with 256 bit AES encrption
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

//Encrypts data with public key
function public_key_encrypt($data, $public_key)
{
    openssl_public_encrypt($data, $encrypted_data, $public_key);
    return $encrypted_data;
}

//Encrypts data with private key
function private_key_encrypt($data, $key)
{
    openssl_private_encrypt($data, $encrypted_data, $key);
    return $encrypted_data;
}

//Decrypts data with public key
function public_key_decrypt($data, $key)
{
    openssl_public_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

//Decrypts data with private key
function private_key_decrypt($data, $key)
{
    openssl_private_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

//Sets config options for key generation
//Creates key with SHA256 algorithm @ 2048 bits
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

//Echo's keys
echo $publickey;
echo "/////////////////////////////<br><br>";
echo $privatekey;
echo "///////////////////////////// <br><br>";

$test = public_key_encrypt("abdfgasfs", $publickey);
echo $test . "<br>";
var_dump($test);
echo("<br><br>" . strlen($test));

echo "<br><br>";

//Encodes the message in base 64
$test = base64_encode($test);
echo "ENCODE" . $test . "<br>";
var_dump($test);
echo("<br><br>" . strlen($test));

//For debug
echo "<br><br>";

$test2 = base64_decode($test);
echo "DECODE" . $test2 . "<br>";
var_dump($test2);
echo("<br><br>" . strlen($test2));

echo "<br><br>";

$test3 = private_key_decrypt($test2, $privatekey);
echo $test3;
var_dump($test3);