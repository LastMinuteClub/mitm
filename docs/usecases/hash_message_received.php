<?php
function public_key_decrypt($data, $key)
{
    openssl_public_decrypt($data, $decrypted_data, $key);
    return $decrypted_data;
}

function hash_message($data)
{
    return hash("sha256", $data);
}

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