<?php declare(strict_types=1);

namespace IEPaySDK\Requests;

use IEPaySDK\BaseRequest;

class RefundOrderRequest extends BaseRequest {
    public function __construct() {
        parent::__construct('POST', '/api/refund');
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $this->headers['charset'] = 'utf-8';
    }

    public function buildBody(array $params) {
        $this->body = $params;
    }
}
