<?php
function private_key_decrypt($data, $privatekey)
{
    openssl_private_decrypt($data, $decrypted_data, $privatekey);
    return $decrypted_data;
}
?>