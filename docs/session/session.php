<?php
// This is just an example php file. Not currently used in this application
session_start();
//starting session

//if the session for username has not been set, initialise it
if(!isset($_SESSION['session_user']))
{
		$_SESSION['session_user']="";
		$_SESSION['access_lvl'] = 0;
}

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

// if(!isset($_SESSION['server_priv_key']) && !isset($_SESSION['server_pub_key']))
// {
// 	$keys = generate_keys();
// 	$_SESSION['server_priv_key'] = $keys[0];
// 	$_SESSION['server_pub_key'] = $keys[1];
// }
$keys = generate_keys();
$server_priv_key = "-----BEGIN PRIVATE KEY-----
MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDFWOU5CP6E8V9q
0GInZUWByui6D5XQoaKP0QxEuhK6H+81l23r+/uE0X8YytT6fRQmfrqaykdwylPv
Fo7aLFxagWEgUxc6NjqDhepr9UIDLWDRHLp3R3bEB3XZTrcRd89vyFfK0sGjnSbW
Q4ofXHb4660Oy7EpWiLLj20xh2MZYUL2/GMqYxSMXjzKhJ1dADNyPuuTHPf3K5rN
UfXRnlXV+jqf0kkPpDMVsL4X7dWSDdbgq3bxBfN9Bv6PaaZ5UTpQACBiOWDWau/W
AaSvTGYBJ2XYTLE63WmFuLfblEN2KQf/HJU1wnQmniY2zy7fKJ9a4RQKv1WOEAqw
j0RBDvzfAgMBAAECggEBAKW+jXYjibAaEOti7KztrzzdMCzkXg0FU8S57DXkmUnc
/EjkT5u83Hemg7pM0Cc42a2jDhJnBS1DoM7TAVNXopEYzHwbjQyE8wv3cvUM3U5R
1FiMakc3rBXjtiS2qaZwG7Zkauebrqo9mJqnyt+gBwP03Dnq9XYnj8WrRigs7xwm
TEMACeu343PPGIE7AX7PExVmkvcBtJL52plxxiygyznKfXw+KazK2ZrdZGHZJQm1
7VMaw0931/XXan00fu0J2RCr0qKTj0UbKkC/wDpeDIzRTCWaFBfsph2WfPu9FTQQ
gEsfJ3qvfkT7DhkBmUzfgMGnHwYXBBPPlzehs4I63hECgYEA48y0PaywVcrv4mqc
jWD4gRM33sAVftnCdxxsZJXOa8M5sTq79hmi6He1D7zQCNUNysnM0yNL1IcDa5X0
VqKabn7kMxAn/rOWDqnbGYlAtFLulDHGwK7b5oq45dlKv6nipNf64m8X8Rf7p2eY
azNACqx4TepKjKUIbyGFM7wU3LMCgYEA3cccp8aZShnMIltGwNgTQndRDhUBTGzK
uCBG6hWYWE7yUwV242z5my7WnbyfPfoJC/avNQQQWl/O8SK1PmsTwBzN9gQdyJqJ
bMIsSaJYy0HKFWbn5nkLhTic5BwLR7hqpRGI9PhAHIKFpRY6CYb51BGnGni4+hYG
ZMOszCjSDSUCgYB8XvYFOjRoEs1Xu8dPdSMYLaryRcM2p6OBrpYLcLLrqQHlnmCi
46pK65iCSB74w4GtNvJKUFoFZdVbNtrZNhvEuijTLD351IjX5qrFzWbzTNgPNwIB
jzZmL1T1wOYLsLAaOgUy/V5/9g0if+/6j1emvDVOrN0Y3r21FwMHlOd6+wKBgA0U
Rgta+gVVuiU4jtamp5Qe50fWU0pHjDkJpkT92wsyNLZSty04awwM2hlZW2bTTR9I
gBK3V6OMzO6Jpni05ehJipf8rCj9fCdO2D/LdEMgcSOL+xcrglNsAEyvnravGJL9
kr8nuNg1ll4jDm8rZ6ZrGBjGj9on3F6q75Dmw2SFAoGBAKznY2yL9ft1kgPWB32z
PmN5trY26GOzTiW4rmChWUHlzNOsf9NOp4TGkMe5mcSheDA5R1soQ9cJ8iT6CFqo
j8MibjIrwTH6wl4PawymucgriQ4vk/WOljoidTD5bX09fz4RiMFLCmwgBOsLCGqK
Ztdd/FTA5yb+z99nlvc9Xj5l
-----END PRIVATE KEY-----";
$server_pub_key = "-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAxVjlOQj+hPFfatBiJ2VF
gcroug+V0KGij9EMRLoSuh/vNZdt6/v7hNF/GMrU+n0UJn66mspHcMpT7xaO2ixc
WoFhIFMXOjY6g4Xqa/VCAy1g0Ry6d0d2xAd12U63EXfPb8hXytLBo50m1kOKH1x2
+OutDsuxKVoiy49tMYdjGWFC9vxjKmMUjF48yoSdXQAzcj7rkxz39yuazVH10Z5V
1fo6n9JJD6QzFbC+F+3Vkg3W4Kt28QXzfQb+j2mmeVE6UAAgYjlg1mrv1gGkr0xm
ASdl2EyxOt1phbi325RDdikH/xyVNcJ0Jp4mNs8u3yifWuEUCr9VjhAKsI9EQQ78
3wIDAQAB
-----END PUBLIC KEY-----";
//save username in the session 
$session_user=$_SESSION['session_user'];
?>
