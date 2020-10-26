<?php declare(strict_types=1);

namespace IEPaySDK\Observer;

use IEPaySDK\BaseRequest;

class SignatureObserver implements ObserverInterface {

    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    private function sign(array $params) {
        $assoc = [];
        foreach ($params as $k => $v) {
            $assoc[] = ['key' => $k, 'value' => $v];
        }
        usort($assoc, function($a, $b) {
            return strcmp($a['key'], $b['key']);
        });

        $rawString = implode('&',
            array_map(function($item) {
                return $item['key'] . '=' . $item['value'];
            }, $assoc)
        );
        return md5($rawString . $this->apiKey);
    }

    public function handle(BaseRequest $request) {
        $request->body['version'] = 'v1';
        $request->body['sign'] = $this->sign($request->body);
    }
}
