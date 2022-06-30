<?php

use Codeception\Test\Unit;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Insly\AmqpSenderClient\Config;
use Insly\AmqpSenderClient\Exceptions\ConfigException;
use Insly\AmqpSenderClient\Tests\Unit\Traits\MocksClient;

class ExchangeTest extends Unit
{
    use MocksClient;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * @return void
     * @throws ConfigException
     */
    public function testEventsEndpoint(): void
    {
        $container = [];
        $history = Middleware::history($container);

        $mock = new MockHandler([
            new Response(200, [], '{"status":"Sent"}')
        ]);

        $handlerStack = HandlerStack::create($mock);
        $handlerStack->push($history);

        $cfg = new Config([
            Config::PARAM_HOST => 'https://local.host'
        ]);

        $client = $this->createMockClient($cfg, $handlerStack);

        $resp = $client->events()->trigger('qmt:some:event', ['data' => 'foo']);

        $this->assertEquals(200, $resp->getStatusCode());
        $this->assertEquals(['status' => 'Sent'], $resp->getBodyJson());

        /** @var Request $sentRequest */
        $sentRequest = $container[0]['request'];
        $this->assertEquals('POST', $sentRequest->getMethod());
        $this->assertEquals('/api/v1/amqpsender/e/events/key/qmt:some:event', $sentRequest->getUri()->getPath());
    }
}
