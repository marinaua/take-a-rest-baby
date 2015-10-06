<?php

namespace Api\Router;

interface RouteInterface
{
    /**
     * @param string $requestMethod
     *
     * @return $this
     */
    public function setRequestMethod($requestMethod);

    /**
     * @return mixed
     */
    public function getRequestMethod();

    /**
     * @param string $pattern
     *
     * @return $this
     */
    public function setPattern($pattern);

    /**
     * @return string
     */
    public function getPattern();

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction($action);

    /**
     * @return string
     */
    public function getAction();

    /**
     * @param string $controller
     *
     * @return $this
     */
    public function setController($controller);

    /**
     * @return string
     */
    public function getController();
}