<?php

interface Api
{
    /**
     * 路由映射表
     */
    const route = [
        "QueryCoinConf" => "coinconf.php",
        "QueryCoins" => "info.php",
        "QueryIsInternalAddr" => "internal-addr/query.php",
        "ValidateWithdraw" => "withdraw/validator.php",
        "QueryBalance" => "balance.php",
        "GetDepositHistory" => "deposit/history.php",
        "SubmitWithdraw" => "withdraw/submit.php",
        "QueryWithdrawStatus" => "withdraw/status.php",
        "GetDepositAddr" => "deposit/addr.php",
    ];

    /**
     * 单个币种查询
     * @param $param
     * @return mixed
     */
    public function QueryCoinConf($param);


    //查询币种信息
    public function QueryCoins();


    //查询余额
    public function QueryBalance($param);


    //获取充值地址
    public function GetDepositAddr($param);


    //获取充值记录
    public function GetDepositHistory($subuserId, $chain, $coin, $fromId, $limit);


    //内部地址查询
    public function QueryIsInternalAddr($coin, $chain, $addr);


    //提交提币工单
    public function SubmitWithdraw($subuserid, $chain, $coin, $addr, $amount, $memo, $usertags, $auth);


    //提币预校验接口
    public function ValidateWithdraw($subuserid, $chain, $coin, $addr, $amount, $memo, $usertags, $auth);


    //查询提币工单状态
    public function QueryWithdrawStatus($coin, $chain, $withdrawid);


    //查询提币记录
    public function QueryWithdrawHistory($subuserId, $chain, $coin, $fromId = 0, $limit = 100);
}