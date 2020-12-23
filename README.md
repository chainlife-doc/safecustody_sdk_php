# 赛福托管钱包API PHP-SDK

### 安装SDK

#### composer安装
- 我们推荐[composer](https://www.phpcomposer.com/)安装 ,首先你要确保是否安装了composer  
    `` composer -V``

- 进入项目的根目录引入  
    ``` composer require chainlife/safecustody_sdk_php```
    > 如果下载太慢,建议把composer切换到国内镜像.[如何切换](https://pkg.phpcomposer.com/)  
                                                                
- 创建main.php,在代码里面导入下面代码:
    ```php
    require_once "./vendor/autoload.php";
    ```   
   
- 具体操作  
  ```
  +---------------------------------------------------------------------------------------------+
  |~:cmd> mkdir project                                                                         |
  |~:cmd> cd project                                                                            |
  |./project:cmd> composer require chainlife/safecustody_sdk_php                                |
  |./project:cmd> touch main.php                                                                |
  |./project:cmd> echo '<?php' > main.php                                                       |
  |./project:cmd> echo 'require_once "./vendor/autoload.php";' >> main.php                      |
  |./project:cmd>                                                                               |
  +──-------------------------------------------------------------------------------------------+ 
    ```        
  
# 例子
> 可以参考example.php  

#### 创建sdkApi
 ```php
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
   
``` 

#### [单个币种查询](https://github.com/chainlife-doc/wallet-api/blob/master/%E5%8D%95%E5%B8%81%E7%A7%8D%E4%BF%A1%E6%81%AF%E6%9F%A5%E8%AF%A2.md)

```php
//传入查询的币名
var_dump($sdk->QueryCoinConf("btc"));
```

#### [查询公共币种信息](https://github.com/chainlife-doc/wallet-api/blob/master/%E6%9F%A5%E8%AF%A2%E5%B8%81%E7%A7%8D%E4%BF%A1%E6%81%AF.md)
```php
var_dump($sdk->QueryCoins());
```

#### [查询余额](https://github.com/chainlife-doc/wallet-api/blob/master/%E6%9F%A5%E8%AF%A2%E4%BD%99%E9%A2%9D.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 */
var_dump($sdk->QueryBalance(["chain" => "eth", "coin" => "usdt"]));
```

#### [获取充值地址](https://github.com/chainlife-doc/wallet-api/blob/master/deposit/%E8%8E%B7%E5%8F%96%E5%85%85%E5%80%BC%E5%9C%B0%E5%9D%80.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string subuserid 你的用户id
 */
var_dump($sdk->GetDepositAddr(["chain" => "eth", "coin" => "usdt", "subuserid"=>"1"]));
```

#### [获取充值记录](https://github.com/chainlife-doc/wallet-api/blob/master/deposit/%E8%8E%B7%E5%8F%96%E5%85%85%E5%80%BC%E8%AE%B0%E5%BD%95.md)
```php
/**
 * @param string coin 主链 (空字符串默认不做筛选)
 * @param string chain 币名 (空字符串默认不做筛选) 
 * @param string subuserid 子账号，平台不管其含义（空字符串默认不做筛选）
 * @param int fromid 从哪个充值序号开始，值大于等于1,查询结果包含fromId对应的充值记录
 * @param int limit 最多查询多少条记录，包含fromid这条记录
 */
var_dump($sdk->GetDepositHistory($subuserId = "1", $chain = "trx", $coin = "trx", $fromid = 1, $limit = 100));
```

#### [内部地址查询](https://github.com/chainlife-doc/wallet-api/blob/master/internal-addr/%E5%86%85%E9%83%A8%E5%9C%B0%E5%9D%80%E6%9F%A5%E8%AF%A2.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string addr 要查询的内部地址
 */
var_dump($sdk->QueryIsInternalAddr($coin = "btc", $chain = "btc", $addr = ""));
```

#### [提交提币工单](https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%8F%90%E4%BA%A4%E6%8F%90%E5%B8%81%E5%B7%A5%E5%8D%95.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string subuserid 你的用户id
 * @param string addr 提币地址
 * @param string amount 提币数量
 * @param string memo 该字段主要提供给链上支持备注的币种,内容会更新到链上
 * @param string usertags 用户标签,自定义内容,一般作为订单备注使用,辅助说明
 * @param string user_orderid 用户自定义订单ID，该字段主要是填写用户系统的订单流水号，字段具有唯一性（可选字段)  
 */
var_dump($sdk->SubmitWithdraw($subuserId = "26", $chain = "trx", $coin = "trx", $addr = "", $amount = "10", $memo = "test", $usertags = "my",$userOrderid=""));
```

#### [提币预校验](https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%8F%90%E5%B8%81%E9%A2%84%E6%A0%A1%E9%AA%8C%E6%8E%A5%E5%8F%A3.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string subuserid 子账号，平台不管其含义（空字符串默认不做筛选）
 * @param string addr 提币地址
 * @param string amount 提币数量
 * @param string memo 该字段主要提供给链上支持备注的币种，内容会更新到链上   
 * @param string usertags 用户标签, 自定义内容，一般作为订单备注使用,辅助说明
 * @param string user_orderid 用户自定义订单ID，该字段主要是填写用户系统的订单流水号，字段具有唯一性（可选字段)
 */
var_dump($sdk->ValidateWithdraw($subuserId = "26", $chain = "trx", $coin = "trx", $addr = "", $amount = 0, $memo = "test", $usertags = "my",$userOrderid=""));
```

#### [查询工单状态](https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%9F%A5%E8%AF%A2%E6%8F%90%E5%B8%81%E5%B7%A5%E5%8D%95%E7%8A%B6%E6%80%81.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string withdrawid 提币订单ID
 */
var_dump($sdk->QueryWithdrawStatus($coin = "btc", $chain = "btc", $withdrawid = "1"));
```

#### [查询历史提币记录](https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E6%9F%A5%E8%AF%A2%E6%8F%90%E5%B8%81%E8%AE%B0%E5%BD%95.md)
```php
/**
 * @param string coin 币名
 * @param string chain 链名
 * @param string subuserid 子账号，平台不管其含义（空字符串默认不做筛选）
 * @param int fromid 从哪个充值序号开始，值大于等于1,查询结果包含fromId对应的充值记录
 * @param int limit 最多查询多少条记录，包含fromid这条记录
 */
var_dump($sdk->QueryWithdrawHistory($subuserId = "1", $chain = "btc", $coin = "btc", $fromid = 1, $limit = 100));
```

#### [取消提币接口](https://github.com/chainlife-doc/wallet-api/blob/master/withdraw/%E5%8F%96%E6%B6%88%E6%8F%90%E5%B8%81%E6%8E%A5%E5%8F%A3.md)
```php
    /**
     * 取消提币接口
     * @param string $subuserId 子账号，平台不管其含义（空字符串默认不做筛选）
     * @param string $chain链名
     * @param string $coin 币名
     * @param string $withdrawid 提币订单ID
     * @return mixed
     */
var_dump($sdk->WithdrawCancel($subuserId = "1", $chain = "btc", $coin = "btc", $withdrawid = "1"));
```