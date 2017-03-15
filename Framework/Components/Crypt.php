<?php

class Crypt
{
    public static function encrypt($key, $input)
    { return base64_encode(@mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $input, MCRYPT_MODE_ECB)); }

    public static function decrypt($key, $input)
    { return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($input), MCRYPT_MODE_ECB)); }
}