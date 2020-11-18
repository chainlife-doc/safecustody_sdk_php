<?php
require_once __DIR__ . "User.php";

/**
 * Class SdkApi
 * @package sdk
 */
abstract class Request
{
    protected function post($url, $str)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $str);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type:application/json;charset=utf-8',
                'Content-Length: ' . strlen($str)
            )
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }


    /**
     * @param $method
     * @param array $param
     * @param \sdk\User $user
     * @return mixed
     */
    protected function request($method, $param = [], User $user)
    {
        $str = "";
        $param = $this->requestParam($param, $user);
        if (!empty($param) && $param != "" && count($param) > 0) {
            $str = json_encode($param);
        }
        $url = $this->getUrl($method);
        $res = $this->post($url, $str);

        return json_decode($res, true);
    }

    abstract protected function getUrl($method);


    /**
     * @param $param
     * @param \sdk\User $user
     * @return array
     */
    protected function requestParam($param, User $user)
    {
        $arr = [
            "appid" => $user->getAppid(),
            "cryptype" => 0,
        ];

        $arr["data"] = [
                "auth" => [
                    "token" => $user->getToken(),
                    "timestamp" => $user->getUserTime(),
                ],
            ] + $param;
//          $arr = $arr + $arr["data"] + $param;

        $user->unsetTime();

        return $arr;
    }
}