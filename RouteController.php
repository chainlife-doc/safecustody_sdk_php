<?php

namespace safecustody;

/**
 * 路由控制器
 * Class RouteController
 * @package sdk
 */
class RouteController extends Request implements Api
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @var string host
     */
    protected $host;


    /**
     * 单个币种查询
     * @param string $coin
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/%E5%8D%95%E5%B8%81%E7%A7%8D%E4%BF%A1%E6%81%AF%E6%9F%A5%E8%AF%A2.md
     */
    public function QueryCoinConf($coin)
    {
        $method = __METHOD__;

        $param = ["coin" => $coin];

        return $this->request($method, $param, $this->user);
    }


    /**
     * 查询币种信息
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/%E5%8D%95%E5%B8%81%E7%A7%8D%E4%BF%A1%E6%81%AF%E6%9F%A5%E8%AF%A2.md
     */
    public function QueryCoins()
    {
        $method = __METHOD__;

        return $this->request($method, [], $this->user);
    }


    /**
     * 查询余额
     * @param array $param
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/%E6%9F%A5%E8%AF%A2%E4%BD%99%E9%A2%9D.md
     */
    public function QueryBalance($param)
    {
        $method = __METHOD__;
        $param = ["coins" => [$param]];
        return $this->request($method, $param, $this->user);
    }


    /**
     * 获取充值地址
     * @param array $param
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/deposit/%E8%8E%B7%E5%8F%96%E5%85%85%E5%80%BC%E5%9C%B0%E5%9D%80.md
     */
    public function GetDepositAddr($param)
    {
        $method = __METHOD__;
        $param = ["coins" => [$param]];
        return $this->request($method, $param, $this->user);
    }


    /**
     * 获取充值记录
     * @param string $subuserId
     * @param string $chain
     * @param string $coin
     * @param int $fromId
     * @param int $limit
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/deposit/%E8%8E%B7%E5%8F%96%E5%85%85%E5%80%BC%E8%AE%B0%E5%BD%95.md
     */
    public function GetDepositHistory($subuserId, $chain, $coin, $fromId = 0, $limit = 100)
    {
        $method = __METHOD__;
        $param = [
            "subuserid" => $subuserId,
            "chain" => $chain,
            "coin" => $coin,
            "fromid" => $fromId,
            "limit" => $limit,
        ];
        return $this->request($method, $param, $this->user);
    }


    /**
     * 内部地址查询
     * @param string $coin
     * @param string $chain
     * @param string $addr
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/internal-addr/%E5%86%85%E9%83%A8%E5%9C%B0%E5%9D%80%E6%9F%A5%E8%AF%A2.md
     */
    public function QueryIsInternalAddr($coin, $chain, $addr)
    {
        $method = __METHOD__;
        $param = [
            "chain" => $chain,
            "coin" => $coin,
            "addr" => $addr
        ];
        return $this->request($method, $param, $this->user);
    }


    /**
     * 提交提币工单
     * @param string $subuserid
     * @param string $chain
     * @param string $coin
     * @param string $addr
     * @param string $amount
     * @param string $memo
     * @param string $usertags
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%8F%90%E4%BA%A4%E6%8F%90%E5%B8%81%E5%B7%A5%E5%8D%95.md
     */
    public function SubmitWithdraw($subuserid, $chain, $coin, $addr, $amount, $memo, $usertags)
    {
        $method = __METHOD__;
        $param = [
            "subuserid" => $subuserid,
            "chain" => $chain,
            "coin" => $coin,
            "addr" => $addr,
            "amount" => $amount,
            "memo" => $memo,
            "usertags" => $usertags,
            "sign" => $this->user->getSign($addr, $memo, $usertags),
        ];

        $result = $this->request($method, $param, $this->user);
        $result = $this->_deletFee($result);
        return $result;
    }


    /**
     * 提币预校验接口
     * @param string $subuserid
     * @param string $chain
     * @param string $coin
     * @param string $addr
     * @param string $amount
     * @param string $memo
     * @param string $usertags
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%8F%90%E5%B8%81%E9%A2%84%E6%A0%A1%E9%AA%8C%E6%8E%A5%E5%8F%A3.md
     */
    public function ValidateWithdraw($subuserid, $chain, $coin, $addr, $amount, $memo, $usertags)
    {
        $method = __METHOD__;
        $param = [
            "subuserid" => $subuserid,
            "chain" => $chain,
            "coin" => $coin,
            "addr" => $addr,
            "amount" => $amount,
            "memo" => $memo,
            "usertags" => $usertags,
            "sign" => $this->user->getSign($addr, $memo, $usertags),
        ];
        return $this->request($method, $param, $this->user);
    }


    /**
     * 查询提币工单状态
     * @param $coin
     * @param $chain
     * @param $withdrawid
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%9F%A5%E8%AF%A2%E6%8F%90%E5%B8%81%E5%B7%A5%E5%8D%95%E7%8A%B6%E6%80%81.md
     */
    public function QueryWithdrawStatus($coin, $chain, $withdrawid)
    {
        $method = __METHOD__;
        $param = [
            "chain" => $chain,
            "coin" => $coin,
            "withdrawid" => $withdrawid,
        ];
        $result = $this->request($method, $param, $this->user);
        $result = $this->_deletFee($result);
        return $result;
    }


    /**
     * 查询提币记录
     * @param $subuserId
     * @param $chain
     * @param $coin
     * @param int $fromId
     * @param int $limit
     * @return array
     * https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%9F%A5%E8%AF%A2%E6%8F%90%E5%B8%81%E8%AE%B0%E5%BD%95.md
     */
    public function QueryWithdrawHistory($subuserId, $chain, $coin, $fromId = 0, $limit = 100)
    {
        $method = __METHOD__;
        $param = [
            "subuserid" => $subuserId,
            "chain" => $chain,
            "coin" => $coin,
            "fromid" => $fromId,
            "limit" => $limit,
        ];
        return $this->request($method, $param, $this->user);
    }

    /**
     * @param $method
     * @return mixed|void
     */
    protected function getUrl($method)
    {
        list(, $method) = explode("::", $method);
        $url = $method;
        if (array_key_exists($method, self::route)) {
            $url = self::route[$method];
        }

        $url = $this->host . $url;

        return $url;
    }

    private function _deletFee($result)
    {
        unset($result["data"]["data"]["fee_coin"]);
        unset($result["data"]["data"]["fee_amount"]);
        unset($result["data"]["data"]["fee_coin_chain"]);
        return $result;
    }
}