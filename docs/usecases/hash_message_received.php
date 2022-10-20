<?php
//Encrypts data using public key
function public_key_decrypt($data, $key)
{
    openssl_public_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

//Hashes message using SHA256 algo
function hash_message($data)
{
    return hash("sha256", $data);
}

//Compares the hashes of a piece of data and a hash
//True == Same, False == !Same
function compare_hash($hash, $data)
{
    if(hash_message($data) == $hash)
    {
        return true;
    }else{
        return false;
    }
}
?>