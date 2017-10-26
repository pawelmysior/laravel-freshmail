<?php

namespace PawelMysior\FreshMail;

use Zttp\Zttp;

class FreshMail
{
    protected $apiKey;
    
    protected $apiSecret;
    
    protected $apiList;
    
    public function __construct($apiKey, $apiSecret, $apiList)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->apiList = $apiList;
    }

    /**
     * @param  string $email
     * @param  int $state
     * @return mixed
     */
    public function addSubscriber($email, $state = 1)
    {
        return $this->request('/rest/subscriber/add', [
            'email' => $email,
            'list' => $this->apiList,
            'state' => $state,
        ]);
    }

    /**
     * @param  string $url
     * @param  array $data
     * @return mixed
     */
    protected function request($url, $data)
    {
        return Zttp::withHeaders($this->getHeaders($url, $data))
            ->post('https://api.freshmail.com' . $url, $data);
    }

    /**
     * @param  string $url
     * @param  array $data
     * @return array
     */
    protected function getHeaders($url, $data)
    {
        return [
            'Content-Type' => 'application/json',
            'X-Rest-ApiKey' => $this->apiKey,
            'X-Rest-ApiSign' => $this->getApiSign($url, $data),
        ];
    }

    /**
     * @param  string $url
     * @param  array $data
     * @return string
     */
    protected function getApiSign($url, $data)
    {
        return sha1(implode('', [
            $this->apiKey,
            $url,
            json_encode($data),
            $this->apiSecret
        ]));
    }
}
