# IEPay PHP SDK
This SDK is used to create, refund orders .

## Introduction
IEPay PHP SDK version 1.0

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

$request->buildBody([...]);

$response = $client->execute($request);
```

### Create Wechat Mini Program Order
```sdk usage
use IEPaySDK\IEPayClient;
use IEPaySDK\Requests\WechatMiniAppPaymentRequest;

$client = new IEPayClient('iepay_api_key');

$request = new WechatMiniAppPaymentRequest();

$request->buildBody([...]);

$response = $client->execute($request);
```

### Refund Order
```sdk usage
use IEPaySDK\IEPayClient;
use IEPaySDK\Requests\RefundOrderRequest;

$client = new IEPayClient('iepay_api_key');

$request = new RefundOrderRequest();

$request->buildBody([...]);

$response = $client->execute($request);
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://rem.mit-license.org)
