<?php

return [
    'rsa_private_key' => base_path() . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'rsa_private_key.pem',
    'rsa_public_key'  => base_path() . DIRECTORY_SEPARATOR . 'certs' . DIRECTORY_SEPARATOR . 'rsa_public_key.pem',
    'rsa_module'      => 'BE2CB86C82830CE237B1E52FCDADED35883002F020D905FE821CAA6F6495C984619D656DA7B3BCB34AC863D58046587C670477187D3AEBF804B8D48A2D50A5A7EF74B7C2BD57426F1400DCAD4CE487EE8A54B185D413CF2C86E989780193E8D87F4F37212EFA591C0B54980D55ED9AFF71B064A7F446E2F79D68B70B3B5AA481',
    //'e' => '65537 - 0x10001',
    'e'               => '0x10001',
];