<?php

namespace Recca0120\Every8d\Tests;

use Mockery as m;
use Recca0120\Every8d\Client;
use PHPUnit\Framework\TestCase;

class ClientRealTest extends TestCase
{
    protected $userId = '';

    protected $password = '';

    protected $options = [
        'to' => '',
        'text' => '中文測試',
    ];

    protected function setUp()
    {
        if (empty($this->userId) === true || empty($this->password) === true) {
            $this->markTestSkipped('Please set uid and password');
        }
    }

    protected function tearDown()
    {
        m::close();
    }

    public function testCredit()
    {
        $client = new Client($this->userId, $this->password);

        $this->assertInternalType('float', $client->credit());
    }

    public function testSend()
    {
        $client = new Client($this->userId, $this->password);

        $this->assertInternalType('array', $client->send([
            'to' => $this->options['to'],
            'text' => $this->options['text'],
        ]));
    }
}
