<?php

namespace Api;

use Api\DBAL\DBAL;
use Api\DBAL\Driver\MysqlDriver;
use \Api\Request\Request;
use Api\Router\Router;
use Api\Controller\ControllerInterface;

class App
{
    public static function run()
    {
       // var_dump($_SERVER);die;
        $dbConfig = include('config/db.php');

        $dbal = DBAL::getInstance();

        // TODO: try/catch
        $mysqlConnection = (new MysqlDriver())
            ->setDatabase($dbConfig['database'])
            ->setHost($dbConfig['host'])
            ->setPassword($dbConfig['password'])
            ->setUser($dbConfig['user'])
            ->connect();
        $dbal->addConnection($mysqlConnection);

        $namespace =  __NAMESPACE__;

        $request = new Request();

        $router = new Router();
        $router->setRoutes(include('config/router.php'));
        $route = $router->getRoute($request);

        if(is_null($route)) {
            http_response_code(404);
            die;
        }

        $controller = '\\' . $namespace
            . '\\' . ControllerInterface::CONTROLLER_FOLDER
            . '\\' . $route->controller;
        $action = $route->action;

        /**
         * TODO: Add try/catch
         */
        $addressController = new $controller();
        $addressController->setRequest($request);

        $response = call_user_func_array(array($addressController, $action), $route->data);

        $response->render();
    }
}