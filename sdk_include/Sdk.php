<?php

require_once __DIR__ . "/RouteController.php";

class Sdk extends RouteController
{

    /**
     * @param $host
     */
    public function setHost($host)
    {
        $this->host = trim($host, "/") . "/";
    }

}