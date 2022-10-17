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
    $encrypted = openssl_public_encrypt($data, $encrypted_data, $public_key);
    //echo($encrypted_data);
    return $encrypted;
}

$config = array(
    "config" => "C:/xampp/php/extras/openssl/openssl.cnf",
    'private_key_bits'=> 2048,
    'default_md' => "sha256",
  );

$new = openssl_pkey_new($config);

openssl_pkey_export($new, $privatekey);

$publickey = openssl_pkey_get_details($new);
$publickey = $publickey["key"];

echo $publickey;
echo "/////////////////////////////";
echo $privatekey;

$test = public_key_encrypt("test", $publickey);

// $test2 = openssl_private_decrypt($test, $decrypted_data, $privatekey);
// echo $test2;
?>