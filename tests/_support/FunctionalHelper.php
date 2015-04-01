<?php
namespace Codeception\Module;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
 	
 	function doSomethingWithMyService()
    {
        $service = $this->getModule('Laravel4') // lookup for Symfony 2 module
            ->container // get current DI container
            ->get('http://localhost:8000'); // access a service

        $service->doSomething();
    }
    
}
