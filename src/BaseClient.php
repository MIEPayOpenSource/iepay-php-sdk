<?php declare(strict_types=1);

namespace IEPaySDK;

use IEPaySDK\Observer\ObserverInterface;

class BaseClient
{
    private $origin;

    private $observers;

    public function __construct(string $origin)
    {
        $this->origin = $origin;
    }

    public function addObserver(ObserverInterface $observer)
    {
        $this->observers[] = $observer;
    }

    public function execute(BaseRequest $httpRequest)
    {
        $request = clone $httpRequest;

        $ch = curl_init();

        foreach ($this->observers as $observer) {
            $observer->handle($request);
        }

        $url = $this->origin . $request->path;

        curl_setopt($ch,CURLOPT_CUSTOMREQUEST, strtoupper($request->method));

        $headers = [];
        foreach ($request->headers as $k => $v) {
            $headers[] = $k.': '.$v;
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($request->body) {
            \curl_setopt($ch, CURLOPT_POSTFIELDS, \http_build_query($request->body));
        }

        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if (0 === strpos($this->origin, "https://")) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        curl_close($ch);

        return \json_decode($response, true);
    }
}
