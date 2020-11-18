<?php


namespace sdk;


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