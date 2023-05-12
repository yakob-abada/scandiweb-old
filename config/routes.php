<?php

return [
    [
        'url' => '/product/get',
        'controller' => 'Product',
        'action' => 'get',
        'method' => 'get',
    ],
    [
        'url' => '/product/all',
        'controller' => 'Product',
        'action' => 'getAll',
        'method' => 'get',
    ],
    [
        'url' => '/product/saveApi',
        'controller' => 'Product',
        'action' => 'save',
        'method' => 'post'
    ]
];

