<?php

namespace Api;

use Api\DBAL\DBAL;
use Api\DBAL\Driver\MysqlDriver;
use \Api\Request\Request;
use Api\Response\EmptyResponse;
use Api\Response\HttpStatusCodesEnum;
use Api\Router\Router;
use Api\Controller\ControllerInterface;

/**
 * Kernel class
 * Class App
 * @package Api
 */
class App
{
    private function __construct() {}

    /**
     * @return void
     */
    public static function run()
    {
        self::setDBConnection();

        $namespace =  __NAMESPACE__;

        $request = new Request();

        $router = new Router();
        $router->setRoutes(include('config/router.php'));
        $route = $router->getRoute($request);

        if(is_null($route)) {
            http_response_code(HttpStatusCodesEnum::HTTP_STATUS_NOT_FOUND);
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

        try{
            $response = call_user_func_array(array($addressController, $action), $route->data);
        } catch(\Exception $e) {
            (new EmptyResponse())
                ->setStatus(HttpStatusCodesEnum::HTTP_STATUS_INTERNAL_SERVER_ERROR)
                ->render();
            die;
        }

        $response->render();
    }

    /**
     * @return void
     */
    private static function setDBConnection()
    {
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
    }

    private function __clone() {}
}