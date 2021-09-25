<?php
/*
Plugin Name: WP Tiny Cache
Plugin URI: https://github.com/yama/wp-tinycache
Description: cache
Author: Yamamoto Masanori
Author URI: https://github.com/yama/
Text Domain: wp-tiny-cache
Domain Path: /languages/
Version: 0.0.1
*/

// https://developer.wordpress.org/reference/hooks/enable_loading_advanced_cache_dropin/

include_once __DIR__ . '/functions.inc.php';

if(has_loggedin_cookie()) {
    if(is_file(WP_CONTENT_DIR . '/advanced-cache.php')) {
        put_cache_processor();
    }
    return;
}
