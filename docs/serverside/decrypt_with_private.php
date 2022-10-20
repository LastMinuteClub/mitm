<?php
function private_key_decrypt($data, $privatekey)
{
    //Decrypt using a private key
    openssl_private_decrypt($data, $decrypted_data, $privatekey);
    return $decrypted_data; //Returns decrypted data
}
?>