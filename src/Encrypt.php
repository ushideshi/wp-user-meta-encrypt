<?php

namespace metaEncrypt;

class Encrypt
{


    public static function encrypt_data( $string ) {

        $first_key = base64_decode(get_option('user_encryption_first_key'));
        $second_key = base64_decode(get_option('user_encryption_second_key'));

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $first_encrypted = openssl_encrypt($string,$method,$first_key, OPENSSL_RAW_DATA ,$iv);
        $second_encrypted = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        $output = base64_encode($iv.$second_encrypted.$first_encrypted);
        return $output;

    }

}