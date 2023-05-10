<?php

require __DIR__ . '/vendor/autoload.php';


function callHook() {
    $url = $_SERVER['REQUEST_URI'] ?? '';

    //Matching url param from route list
    $routes = registerRouters();
    $controllerMatch = '';
    $actionMatch = '';
    foreach ($routes as $route) {
        $routeUrl = $route['url'];
        $pattern = preg_quote($routeUrl, '/') . '\??[a-zA-Z_=0-9&@$%#]*'; // /product/get?sku=productSku1

        if (preg_match("/^$pattern$/", $url)) {
            $controllerMatch = $route['controller'];
            $actionMatch = $route['action'];
            break;
        }
    }

    //Create actual action and dispatcher names to be called
    $controller = $controllerMatch;
    $action     = $actionMatch;
    $action    .= 'Action';

    $bootstrapController = 'Bootstrap\\New' . ucwords($controller) . 'Controller';

    if (!class_exists($bootstrapController)) {
        echo '404';
        die;
    }

    $dispatch = (new $bootstrapController())->create();

    if (!method_exists($dispatch, $action)) {
        echo '404';
        die;
    }

    call_user_func_array(array($dispatch, $action), array());
}

function registerConstants() {
    require_once('config/default.php');
    require_once('config/database.php');
}

function setGetParams($match, $params) {
    $parmNo = 1;

    foreach ($params as $param) {
        if (isset($match[$parmNo])) {
            $_GET[$param] = $match[$parmNo];
            $parmNo++;
        } else {
            break;
        }
    }
}

function registerRouters() {
    return require_once('config/routes.php');
}

registerConstants();
callHook();