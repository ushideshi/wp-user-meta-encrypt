<?php


namespace metaEncrypt;
class Decrypt
{


    public static function decrypt_data($string) {
        $first_key = base64_decode(get_option('user_encryption_first_key'));
        $second_key = base64_decode(get_option('user_encryption_second_key'));


        $mix = base64_decode($string);

        $method = "aes-256-cbc";
        $iv_length = openssl_cipher_iv_length($method);

        $iv = substr($mix,0,$iv_length);
        $second_encrypted = substr($mix,$iv_length,64);
        $first_encrypted = substr($mix,$iv_length+64);

        $data = openssl_decrypt($first_encrypted,$method,$first_key,OPENSSL_RAW_DATA,$iv);
        $second_encrypted_new = hash_hmac('sha3-512', $first_encrypted, $second_key, TRUE);

        if (hash_equals($second_encrypted,$second_encrypted_new)) {
            return $data;
        }

        return false;
    }


}