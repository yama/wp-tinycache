<?php
function is_purge_action() {
    if (strpos($_SERVER['REQUEST_URI'], '/wp-admin/')===false) {
        return false;
    }
    if(empty($_POST)) {
        return false;
    }
    return true;
}

function cache_path() {
    return TINY_CACHED_CONTENT_PATH . md5($_SERVER['REQUEST_URI']) . '.cache';
}

function store_cache($content) {
    if(!is_dir(TINY_CACHED_CONTENT_PATH)) {
        mkdir(TINY_CACHED_CONTENT_PATH);
    }
    file_put_contents(cache_path(), $content);
    return $content;
}

function has_loggedin_cookie() {
    if(empty($_COOKIE)) {
        return false;
    }
    foreach ($_COOKIE as $k=>$v) {
        if(strpos($k, 'wordpress_logged_in_')===0 && $v) {
            return true;
        }
    }
    return false;
}

function put_cache_processor(){
    file_put_contents(
        ABSPATH . 'wp-config.php',
        preg_replace(
            "/^<\?php\n/",
            sprintf(
                "<?php\ninclude '%s/cache-processor.php';\n",
                str_replace('\\', '/', __DIR__)
            ),
            file_get_contents(ABSPATH . 'wp-config.php')
        )
    );
    // file_put_contents(
    //     WP_CONTENT_DIR . '/advanced-cache.php',
    //     sprintf(
    //         "<?php\ninclude '%s/cache-processor.php';\n",
    //         str_replace('\\', '/', __DIR__)
    //     )
    // );
}
