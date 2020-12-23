<?php

namespace main;

require_once "./vendor/autoload.php";

use safecustody\Sdk;
use safecustody\User;

$user = new User();
//对应商户后台的APPID
$user->setAppid("");
//对应商户后台的商户ID
$user->setUserId("");
//对应商户后台的SECRETKEY
$user->setSecretKey("");
//对应商户后台的APIKEY
$user->setApiKey("");

$sdk = new Sdk($user);
//TODO 请向微信群里面的官方人员获取
$sdk->setHost("");

try {
    //单币种查询
    var_dump($sdk->QueryCoinConf("usdt"));

    //查询全部币种信息
    var_dump($sdk->QueryCoins());

//    查询余额
    var_dump($sdk->QueryBalance(["chain" => "eth", "coin" => "usdt"]));

//    获取充值地址
    var_dump($sdk->GetDepositAddr(["chain" => "trx", "coin" => "trx", "subuserid" => "1"]));

    //获取充值记录
    var_dump($sdk->GetDepositHistory($subuserId = "1", $chain = "trx", $coin = "trx", $fromid = 1, $limit = 100));

    //内部地址查询
    var_dump($sdk->QueryIsInternalAddr($coin = "btc", $chain = "btc", $addr = ""));

    //提交提币工单
    var_dump($sdk->SubmitWithdraw($subuserId = "26", $chain = "trx", $coin = "trx", $addr = "", $amount = "10", $memo = "test", $usertags = "my"));

    //提币预校验接口
    var_dump($sdk->ValidateWithdraw($subuserId = "26", $chain = "trx", $coin = "trx", $addr = "", $amount = 0, $memo = "test", $usertags = "my"));

    //查询提币工单状态
    var_dump($sdk->QueryWithdrawStatus($coin = "btc", $chain = "btc", $withdrawid = "1"));

    //查询提币记录
    var_dump($sdk->QueryWithdrawHistory($subuserId = "1", $chain = "btc", $coin = "btc", $fromid = 1, $limit = 100));

    //取消提币接口
    var_dump($sdk->WithdrawCancel($subuserId = "1", $chain = "btc", $coin = "btc", $withdrawid = "1"));
} catch (\ErrorException $exception) {
    echo $exception->getMessage();
}
