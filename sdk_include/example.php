<?php
require_once __DIR__ . "Sdk.php";
require_once __DIR__ . "User.php";

$user = new User();
$user->setAppid("");
$user->setUserId("");
$user->setSalt("");

$sdk = new Sdk($user);
$sdk->setHost("");

try {
    //单币种查询
    var_dump($sdk->QueryCoinConf("usdt"));

    //查询币种信息
    var_dump($sdk->QueryCoins());

//    查询余额
    var_dump($sdk->QueryBalance(["chain" => "eth", "coin" => "usdt"]));

//    获取充值地址
    var_dump($sdk->GetDepositAddr(["chain" => "trx", "coin" => "trx", "subuserid"=>"1" ]));

    //获取充值记录
    var_dump($sdk->GetDepositHistory("1", "trx", "trx"));

    //内部地址查询
    var_dump($sdk->QueryIsInternalAddr("btc", "btc", "0xb2ffaf1d8e10e20c4f4e0cf9c3297f672db8afa3"));

//    //提交提币工单
    var_dump($sdk->SubmitWithdraw("26", "trx", "trx", "TAsdoZTpaybY5V6PEE5jxZoMAMLYYz3E8A", "10", "test", "my", "xxxxx"));

    //提币预校验接口
    var_dump($sdk->ValidateWithdraw("26", "trx", "trx", "TAsdoZTpaybY5V6PEE5jxZoMAMLYYz3E8A", "10", "test", "my", "xxxxx"));

    //查询提币工单状态
    var_dump($sdk->QueryWithdrawStatus("btc", "btc", "1"));

    //查询提币记录
    var_dump($sdk->GetDepositHistory("1", "btc", "btc"));
} catch (\ErrorException $exception) {
    echo $exception->getMessage();
}
