<?php

use Way\Tests\Factory;
use App\Port;

class PortTest extends TestCase {

	protected $user = null;

	public function setUp()
	{
		parent::setUp();
		
		$this->user = App\User::where("email", "rthakur.dev@gmail.com")->first();
	}

    public function testPortIndex() {
        $response = $this->actingAs($this->user)
			->visit("admin/port")
			->see("Current Ports");
    }

    public function testAddNewPort() {
        $response = $this->action('POST', 'PortController@store', [
			'name' 			=> 'Shanghai',
			'code' 			=> 'CNSHA',
			'latitude' 		=> '1',
			'longitude' 	=> '1',
			'country' 		=> '1',
			"_token" => "".csrf_token()
		]);
		
		
		$this->assertEquals(302, $response->status());
    }

    public function testEditPort() {
		
		$this->testAddNewPort();
		
        $port = DB::table("ports")->where("name","Shanghai")->first();
       
        $response = $this->call('PUT', 'admin/port/' . $port->id, [
			'name' => 'Shanghai',
			'_token' => "".csrf_token()
		]);
		
		$this->assertEquals(302, $response->status());
   }

    public function testDeletePort() {
		$this->testAddNewPort();
		
        $port = DB::table("ports")->where("name","Shanghai")->first();
        $response = $this->call('DELETE', 'admin/port/' . $port->id, [
			"_token" => "".csrf_token()
        ]);
        
        $this->assertEquals(302, $response->status());
    }

}
