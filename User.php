<?php


namespace sdk;

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
     * @var string salt
     */
    private $salt;


    /**
     * @var string token
     */
    private $token;


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
     * @param $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }


    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
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
        return $this->token = md5($this->getAppid() . "_" . $this->getSalt() . "_" . $this->getUserId() . "_" . $this->getUserTime());
    }


    /**
     * @param $time
     * @param $addr
     * @param $memo
     * @param $usertags
     * @return string
     */
    public function getSign($addr, $memo, $usertags)
    {
        return md5($this->getAppid() . "_" . $this->getSalt() . "_" . $this->getUserId() . "_" . $this->getUserTime() . "_" . $addr . "_" . $memo . "_" . $usertags);
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
}