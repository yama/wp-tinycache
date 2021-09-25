<?php
define(
    'TINY_CACHED_CONTENT_PATH',
    str_replace('\\','/',WP_CONTENT_DIR) . '/wp-tiny-cache/'
);

include __DIR__ . '/functions.inc.php';

if(is_purge_action()) {
    array_map(
        'unlink',
        glob(TINY_CACHED_CONTENT_PATH . '*.cache')
    );
    return;
}

if(has_loggedin_cookie()) {
    return;
}

if(!is_file(cache_path())) {
    ob_start('store_cache');
    return;
}

readfile(cache_path());
// define( 'SHORTINIT', true );
exit;