<?php

namespace metaEncrypt;

class Notice
{


   public function user_encryption_notice__created_key() {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e( 'Since the keys were not configured, they have been auto-generated, please save the page.!', 'sample-text-domain' ); ?></p>
        </div>
        <?php
    }
}