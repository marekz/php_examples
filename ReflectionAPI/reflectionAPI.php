<?php

/**
 * ReflectionAPI - example from PHPArch 2019/12 - Chris Tankersley
 */

use ReflectionClass as refClass;

class Container
{
    protected $parameters;
    
    public function __construct(array $parameters) {
        $this->parameters = $parameters;
    }
    
    public function get(string $class) {
        $arguments = [];
        $refClass = new refClass($class);
        $constructor = $refClass->getConstructor();
        
        if ($constructor) {
            $parameters = $constructor->getParameters();
            
            if (count($parameters)) {
                foreach ($parameters as $param) {
                    if ($param->getClass()) {
                        $arguments[] = $this->get($param->getClass()->name);
                    } else {
                        $arguments[] = $this->parameters[$param->name];
                    }
                }
                return new $class(...$arguments);
            }
            return new $class;
        }
        return new $class;
    }
}


class Bar
{
    protected $message;
    
    public function __construct($message) {
        $this->message = $message;
    }
    
    public function getMessage() {
        return $this->message;
    }
}


class Foo
{
    protected $bar;
    
    public function __construct(Bar $bar) {
        $this->bar = $bar;
    }
    
    public function getMessage() {
        return $this->bar->getMessage();
    }
}


$container = new Container(['message' => 'Hello World']);
$service = $container->get(Foo::class);
echo sprintf('%s', $service->getMessage());