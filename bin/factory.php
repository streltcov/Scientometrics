<?php

namespace Scientometrics\Bin;

use Scientometrics\Models as Models;

/**
 * loading dependencies
 */

$container = $application->getContainer();

// Twig container
$container['views'] = function ($c) {
    $view = new \Slim\Views\Twig('public/views', [
        'cache' => false
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};

// pdo object container
$container['pdo'] = function() {
    $dsn = 'mysql:host=localhost;dbname=scientometrics';
    return new \PDO($dsn, 'root', 'root', array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
};

$container['fluent'] = function() use($container) {
    return new \FluentPDO($container['pdo']);
};

// model for page data
$container['pagedata'] = function() {
    return new Models\Page();
};

$container['boothandler'] = function() use($container) {
    return new Service\Boothandler($container);
};