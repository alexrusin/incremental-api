<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as Faker;

abstract class ApiTester extends TestCase
{
    protected $fake;

    protected $times = 1;

    public function __construct()
    {
    	$this->fake = Faker::create();
    }

    protected function times($count)
    {
        $this->count = $count;

        return $this;
    }

    protected function makeApiCall($uri, $method = 'GET', $params = []) 
    {
    	$response = $this->call($method, $uri, $params);
    	$content = json_decode($response->getContent());
    	$statusCode = $response->getStatusCode();

    	$responseObj = new \stdClass;
    	$responseObj->content = $content;
    	$responseObj->statusCode = $statusCode;
        
        return $responseObj;
    }

    

    protected function assertObjectHasAttributes()
    {
    	$args = func_get_args();
    	$object = array_shift($args);
    	
    	foreach ($args as $attribute) {
    		$this->assertObjectHasAttribute($attribute, $object);
    	}
    }

    protected function make($type, array $fields = [])
    {
    	$stub = array_merge($this->getStub(), $fields);

    	while($this->times--) {

            $type::create($stub);
        }
    }

    protected function getStub()
    {
    	throw new \BadMethodCallException('Create your own getStub to declare your fields.');
    }
}
