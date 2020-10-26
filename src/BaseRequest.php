<?php declare(strict_types=1);

namespace IEPaySDK;

class BaseRequest {

    public $method = '';

    public $path = '';

    public $body = null;

    public $headers = [];

    public function __construct(string $method, string $path)
    {
        $this->path = $path;
        $this->method = $method;
    }
}
