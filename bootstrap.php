<?php

require __DIR__ . '/vendor/autoload.php';


function callHook() {
    $url = $_GET['url'] ?? '';

    //Matching url param from route list
    $routes = registerRouters();
    $controllerMatch = '';
    $actionMatch = '';
    foreach ($routes as $route) {
        $routeUrl = $route['url'];
        if (preg_match("/^$routeUrl$/", $url, $match)) {
            $controllerMatch = $route['controller'];
            $actionMatch = $route['action'];
            if (isset($match[1])) {
                setGetParams($match, $route['params']);
            }
            break;
        }
    }

    //Create actual action and dispatcher names to be called
    $controller = $controllerMatch;
    $action     = $actionMatch;
    $action    .= 'Action';

    $controller = 'Controller\\' . ucwords($controller) . 'Controller';

    $dispatch = new $controller();


    if (method_exists($dispatch, $action)) {
        echo call_user_func_array(array($dispatch, $action), array());
    } else {
        //404
        echo '404';
    }

}

function registerConstants() {
    require_once('config/default.php');
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