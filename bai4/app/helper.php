<?php

use eftec\bladeone\BladeOne;

/**
 * Hàm render giao diện
 * $view: file view blade
 * $data: dữ liệu cần cho view
 **/
function view($view, $data = [])
{
    $views = APP_DIR . '/resources/views';
    $cache = APP_DIR . '/resources/cache';
    $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG); // MODE_DEBUG allows to pinpoint troubles.
    echo $blade->run($view, $data); // it calls /views/$view.blade.php
}

/**
 * Hàm dd: dùng để debug
 * @param $data: dữ liệu cần bug
 */
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
