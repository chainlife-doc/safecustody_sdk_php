<?php


namespace safecustody;


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