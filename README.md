# IEPay PHP SDK
This SDK is used to create, refund orders .

## Installation
```bash
composer require iepay/iepay-php-sdk
```

## Usage
### Create IEPayClient
```code
use IEPaySDK\BaseClient;

use IEPaySDK\Observer\SignatureObserver;

class IEPayClient extends BaseClient {

 public function __construct(string $apiKey)
 {
     $this->addObserver(new SignatureObserver($apiKey));

     $origin = 'https://a.mypaynz.com';

     parent::__construct($origin);
 }
}
```

### Create General Order
```sdk usage
use IEPaySDK\IEPayClient;
use IEPaySDK\Requests\GeneralOrderRequest;

$client = new IEPayClient('iepay_api_key');

$request = new GeneralOrderRequest();

$body = [
    'mid' => '10000',                        // mid
    'total_fee' => 1000,                     // price in cents, here is 1000 cents
    'goods' => 'Iphone',                     // any string
    'goods_detail' => 'An Iphone 12',        // any string
    'out_trade_no' => '2020102204514282',    // out_trade_no
    'pay_type'    => 'IE0011',               // see https://iepay-api.netlify.app/online/order/create/#parameter-info
    'return_url' => $return_url,
    'notify_url' => $notify_url,
    'expired' => 3600,
    'version' => 'v1'
];

$request->buildBody($body);

$response = $client->execute($request);
```

### Create Wechat Mini Program Order
```sdk usage
use IEPaySDK\IEPayClient;
use IEPaySDK\Requests\WechatMiniAppOrderRequest;

$client = new IEPayClient('iepay_api_key');

$request = new WechatMiniAppOrderRequest();

$body = [
    'mid' => '10000',                        // mid
    'appid' => 'wxxxxxxxxxx',                // wechat mini program appid
    'openid' => 'ZhdowQs12Ed',               // user openid in your wechat mini program
    'total_fee' => 1000,                     // price in cents, here is 1000 cents
    'goods' => 'Iphone',                     // any string
    'goods_detail' => 'An Iphone 12',        // any string
    'out_trade_no' => '2020102204514282',    // out_trade_no
    'pay_type' => 'IE0026',                  // just set pay_type to IE0026 here
    'notify_url' => $notify_url,
    'expired' => 3600,
    'version' => 'v1'
];

$request->buildBody($body);

$response = $client->execute($request);
```

### Refund Order
```sdk usage
use IEPaySDK\IEPayClient;
use IEPaySDK\Requests\RefundOrderRequest;

$client = new IEPayClient('iepay_api_key');

$request = new RefundOrderRequest();

$body = [
    'mid' => '10000',                        // mid
    'out_trade_no' => '2020102204514282',    // out_trade_no
    'pay_type' => 'IE0011',                  // order pay_type
    'refund_amount' => 1000,                 // amount in cents, here is 1000 cents
    'refund_charge_fee' => 'TRUE',           // optional, if you want to refund all the fees to customer, set it to 'TRUE'
    'version' => 'v1'
];

$request->buildBody($body);

$response = $client->execute($request);
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://rem.mit-license.org)
