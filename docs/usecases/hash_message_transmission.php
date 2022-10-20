<?php
function hash_message($data)
{
    return hash("sha256", $data);
}

function private_key_encrypt($data, $key)
{
    openssl_private_encrypt($data, $encrypted_data, $key);
    return $encrypted_data;
}
?>