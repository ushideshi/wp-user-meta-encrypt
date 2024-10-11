<?php

/**
 * Plugin Name: User Meta Encrypt
 * Plugin URI: https://github.com/ushideshi/wp-user-meta-encrypt
 * Description: Encrypt user meta in database.
 * Version: 1.0.0
 * Author: ushideshi
 * Author URI: https://github.com/ushideshi/
 * License: GPLv3
 */
require 'bootstrap.php';
function user_encryption_register_settings() {
    register_setting( 'user_encryption_options_group', 'user_encryption_first_key' );
    register_setting( 'user_encryption_options_group', 'user_encryption_second_key' );
}
add_action( 'admin_init', 'user_encryption_register_settings' );

function user_encryption_register_options_page() {
    add_options_page('Meta Encrypt', 'Meta Encrypt', 'manage_options', 'meta_encrypt', 'user_encryption_options_page');
}
add_action('admin_menu', 'user_encryption_register_options_page');


function sample_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done!', 'meta_encrypt' ); ?></p>
    </div>
    <?php
}

function user_encryption_options_page() {
    $first = get_option('user_encryption_first_key');
    $second = get_option('user_encryption_second_key');

    if (empty($first) || empty($second)) {

        wp_admin_notice( 'Since the keys were not configured, they have been auto-generated, please save the page!', [ 'type' => 'warning' ] );
    }

    if(empty($first)){
        $first = base64_encode(openssl_random_pseudo_bytes(32));
    }

    if(empty($second)){
        $second = base64_encode(openssl_random_pseudo_bytes(64));
    }

    ?>
    <div>
        <?php screen_icon(); ?>
        <h2><?php _e( 'User Meta Encryption config', 'meta_encrypt' ); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'user_encryption_options_group' ); ?>
            <h3><?php _e( 'User meta encryption is important, here are the options', 'meta_encrypt' ); ?></h3>
            <p><?php _e( 'We need a first and second key for better security and salting. Please, define them below.', 'meta_encrypt' ); ?></p>
            <table>
                <tr valign="top">
                    <th scope="row"><label for="user_encryption_first_key"><?php _e( 'First encryption key', 'meta_encrypt' ); ?></label></th>
                    <td><input type="password" id="user_encryption_first_key" name="user_encryption_first_key" value="<?php echo $first; ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="user_encryption_second_key"><?php _e( 'Second encryption key', 'meta_encrypt' ); ?></label></th>
                    <td><input type="password" id="user_encryption_second_key" name="user_encryption_second_key" value="<?php echo $second; ?>" /></td>
                </tr>
            </table>
            <?php  submit_button(); ?>
        </form>
    </div>
    <?php

}