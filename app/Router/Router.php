<?php

namespace Api\Router;

use Api\Request\Request;

class Router
{
    const METHOD_POSTFIX = 'Action';
    const CONTROLLER_POSTFIX = 'Controller';

    /** @var  Route[] */
    private $routes;

    /**
     * @param RouteInterface $route
     */
    public function addRoute(RouteInterface $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param Request $request
     *
     * @return null|\stdClass
     */
    public function getRoute(Request $request)
    {
        $result = null;

        foreach ($this->routes as $route) {
            $matches = [];

            if (preg_match($this->preparePattern($route->getPattern()), $request->getRequestUri(), $matches)
                && $request->getRequestMethod() == $route->getRequestMethod()
            ) {
                $result = new \stdClass();
                $result->controller = $route->getController() . self::CONTROLLER_POSTFIX;
                $result->action = $route->getAction() . self::METHOD_POSTFIX;
                $result->data = [];

                if (count($matches) > 1) {
                    $result->data = array_slice($matches, 1);
                }

                break;
            }
        }

        return $result;
    }

    /**
     * @param Route[] $routes
     */
    public function setRoutes(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @param string $pattern
     *
     * @return string
     */
    private function preparePattern($pattern)
    {
        return '/' . $pattern . '/';
    }
}