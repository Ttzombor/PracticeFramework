<?php

interface Factory
{
    public function create($params);
}

class Client
{
    public function __construct(private $name = '', private $email = '', private $phone = '')
    {
    }

    public function getName()
    {
        return $this->name;
    }

    private function getEmail()
    {
        return $this->email;
    }
}
class ClientFactory implements Factory
{
    public function create($params)
    {
        return new Client(...array_values($params));
    }
}
$clientFactory = new ClientFactory();
$args = ['name' => 'John', 'email' => 'mail@mail.com', 'phone' => '123456789'];

$client = $clientFactory->create($args);

echo $client->getName() . PHP_EOL;

$reflection = new ReflectionClass($client);
echo $reflection->getConstructor()->getNumberOfRequiredParameters() . PHP_EOL;
echo $reflection->getMethods()[0] . PHP_EOL;
$method =  $reflection->getMethod('getEmail');
//var_dump($method->setAccessible(true));
var_dump($method->invoke($client));
