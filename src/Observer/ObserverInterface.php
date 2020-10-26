<?php declare(strict_types=1);

namespace IEPaySDK\Observer;

use IEPaySDK\BaseRequest;

Interface ObserverInterface {
    public function handle(BaseRequest $request);
}
