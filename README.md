# amqpsender-php-client
A PHP client library for interacting with Amqpsender API

## Installation

composer.json
```
"repositories": {
        ...
        "insly/amqpsender-php-client": {
            "type": "git",
            "url": "git@github.com:Insly/amqpsender-php-client.git"
        },
        ...
    }
```

`composer require insly/amqpsender-php-client`

## Running tests

#### Run unit tests

`vendor/bin/codecept run unit`
or
`composer test`


#### Run code style checks (Linux)

`./run_ecs_check.sh`


## Sample usage

```php
use \Insly\AmqpSenderClient\Config;
use \Insly\AmqpSenderClient\Api\Client;

...

$cfg = new Config([
    Config::PARAM_HOST => 'http://api.host.domain'
]);

$client = new Client($cfg)
$response = $client->events()->trigger(
    't:tenant:myevent',
    [
        'foo': 'i am some data'
    ]
);

...
```
