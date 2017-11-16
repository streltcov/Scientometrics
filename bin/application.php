<?php

namespace Scientometrics\Bin;

use Slim\App;

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$application = new \Slim\App($configuration);

require_once CUSTOM_MIDDLEWARE; 

require_once CONTAINERS;

/**
 * Routes
 */

// index page
$application->get('/', function($request, $response) {
    var_dump($this->databaseconnection);
    $response->getBody()->write('index page');
});

$application->get('/test', function($request, $response) {
    $response->getBody()->write('test');
});

// total userlist or userinfo on single user
$application->get('/users/{:id}', function($request, $response, $id) {
    if (!isset($id)) {
        echo "exact user information";
    } else {
        echo "users list";
    }
});

$application->get('/edituser/{id}', function($request, $response, $id) {
    //var_dump($id);
    $response->getBody()->write("edit user - id:".$id['id']);
});

$application->get('/adduser', function($request, $response) {
    $response->getBody()->write('adding user');
});

$application->get('/controlpanel', function($request, $response) {
    echo "controlpanel mockup";
});

// run
$application->run();
