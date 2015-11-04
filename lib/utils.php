<?php

function get_post_value($key, $default = '') {
    if (isset($_POST[$key])) {
        return $_POST[$key];
    } else {
        return $default;
    }
}
