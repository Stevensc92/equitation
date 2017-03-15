<?php

class Cookie
{
    public static function set($key, $value, $secret)
    {
        $time = time() + 60 * 60 * 24 * 30 * 12;
        setcookie($key, self::encryptCookie($value, $secret), $time, '/');
    }

    public static function get($key, $secret)
    { return self::decryptCookie($_COOKIE[$key], $secret); }

    private function static encryptCookie($value, $key)
    {
       if(!$value) return false;
       $iv_size   = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv        = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $crypt     = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $value, MCRYPT_MODE_ECB, $iv);
       return trim(base64_encode($crypt));
    }

    private function static decryptCookie($value, $key)
    {
       if(!$value) return false;
       $crypt       = base64_decode($value);
       $iv_size     = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
       $iv          = mcrypt_create_iv($iv_size, MCRYPT_RAND);
       $decrypt     = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypt, MCRYPT_MODE_ECB, $iv);
       return trim($decrypt);
    }
}