<?php declare(strict_types=1);

namespace IEPaySDK\Requests;

use IEPaySDK\BaseRequest;

/**
 * Class GeneralOrderRequest
 * @package IEPaySDK\Requests
 */
class GeneralOrderRequest extends BaseRequest {

    public function __construct() {
        parent::__construct('POST', '/api/online');

        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        $this->headers['charset'] = 'utf-8';
    }

    public function buildBody(array $params) {
        $this->body = $params;
    }
}
