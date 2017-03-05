<?php

namespace Recca0120\Every8d;

use Carbon\Carbon;
use DomainException;
use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class Client
{
    /**
     * $apiEndpoint.
     *
     * @var string
     */
    public $apiEndpoint = 'http://api.every8d.com/API21/HTTP';

    /**
     * $credit.
     *
     * @var float
     */
    public $credit = null;

    /**
     * __construct.
     *
     * @param string $userId
     * @param string $password
     * @param \Http\Client\HttpClient $httpClient
     * @param \Http\Message\MessageFactory $messageFactory
     */
    public function __construct($userId, $password, HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        $this->userId = $userId;
        $this->password = $password;
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->messageFactory = $messageFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * setCredit.
     *
     * @param string $credit
     */
    protected function setCredit($credit)
    {
        $this->credit = (float) $credit;

        return $this;
    }

    /**
     * credit.
     *
     * @return float
     */
    public function credit()
    {
        if (is_null($this->credit) === false) {
            return $this->credit;
        }

        $response = $this->doRequest('getCredit.ashx', [
            'UID' => $this->userId,
            'PWD' => $this->password,
        ]);

        if ($this->isValidResponse($response) === false) {
            throw new DomainException($response);
        }

        return $this->setCredit($response)
            ->credit;
    }

    /**
     * send.
     *
     * @param array $params
     *
     * @return string
     */
    public function send($params)
    {
        $response = $this->doRequest('sendSMS.ashx', array_filter([
            'UID' => $this->userId,
            'PWD' => $this->password,
            'SB' => isset($params['subject']) ? $params['subject'] : null,
            'MSG' => $params['text'],
            'DEST' => $params['to'],
            'ST' => isset($params['ST']) ? Carbon::parse($params['ST'])->format('YmdHis') : null,
        ]));

        if ($this->isValidResponse($response) === false) {
            throw new DomainException($response, 500);
        }

        list($credit, $sended, $cost, $unsend, $batchId) = explode(',', $response);

        return [
            'credit' => $this->setCredit($credit)->credit,
            'sended' => (int) $sended,
            'cost' => (float) $cost,
            'unsend' => (int) $unsend,
            'batchId' => $batchId,
        ];
    }

    /**
     * isValidResponse.
     *
     * @param string $response
     *
     * @return bool
     */
    protected function isValidResponse($response)
    {
        return substr($response, 0, 1) !== '-';
    }

    /**
     * doRequest.
     *
     * @param string $uri
     * @param array $params
     *
     * @return string
     */
    protected function doRequest($uri, $params)
    {
        $request = $this->messageFactory->createRequest(
            'POST',
            rtrim($this->apiEndpoint, '/').'/'.$uri,
            ['Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'],
            http_build_query($params)
        );
        $response = $this->httpClient->sendRequest($request);

        return $response->getBody()->getContents();
    }
}
