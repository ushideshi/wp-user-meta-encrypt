# Meta Encrypt

### What it is
Meta encrypt is a small WordPress plugins that encrypt and decrypt any data in the database using `aes-256-cbc` encryption. 

### Usage
You first need to set up your secret encryption keys in the backend here ` /wp-admin/options-general.php?page=meta_encrypt ` or in ` Settings -> Meta Encrypt `;


Whenever you want to **encrypt** data before saving it to the database, you can use the Encrypt function 
~~~
 $data = \metaEncrypt\Encrypt::encrypt_data('the data that needs to be encrypted');
 update_user_meta(  $userID, 'address', $data );
~~~

Whenever you want to **decrypt** data from the database, you can use the Decrypt function

~~~
 $address = get_user_meta( $userID, 'address', true );
 $address = \metaEncrypt\Decrypt::decrypt_data($address);
~~~


