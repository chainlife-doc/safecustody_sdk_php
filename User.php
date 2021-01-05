<?php


namespace safecustody;

/**
 * 用户类
 * 配置参数请向官方人员获取
 * Class User
 * @package sdk
 */
class User
{

    /**
     * @var
     */
    public $time;


    /**
     * @var string 用户id
     */
    private $userId;


    /**
     * @var string appid
     */
    private $appid;


    /**
     * @var string secret_key
     */
    private $secretKey;


    /**
     * @var string token
     */
    private $token;


    /**
     * @var string api_key
     */
    private $apiKey;

    /**
     * @param string $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param string $appid
     */
    public function setAppid($appid)
    {
        $this->appid = $appid;
    }


    /**
     * @return string
     */
    public function getAppid()
    {
        return $this->appid;
    }


    /**
     * @param $time
     * @return string
     */
    public function getToken()
    {
        return $this->token = md5($this->getApiKey() . "_" . $this->getSecretKey() . "_" . $this->getUserId() . "_" . $this->getUserTime());
    }


    /**
     * @param $addr
     * @param $memo
     * @param $usertags
     * @return string
     */
    public function getSign($addr, $memo, $usertags, $userOrderId = "")
    {
        $str = "";
        if ($userOrderId == "") {
            $str = "_" . $userOrderId;
        }

        return md5($this->getApiKey() . "_" . $this->getSecretKey() . "_" . $this->getUserId() . "_" . $this->getUserTime() .
            "_" . $addr . "_" . $memo . "_" . $usertags . $str);
    }


    /**
     * 获取用户时间
     * @return int
     */
    public function getUserTime()
    {
        if ($this->time == null) {
            $this->time = time();
        }
        return $this->time;
    }


    public function unsetTime()
    {
        $this->time = null;
    }

    /**
     * @return string
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param string $secretKey
     */
    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param mixed $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
}