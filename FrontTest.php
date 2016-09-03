<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FrontTest extends TestCase {

	protected $user = null;

	
	public function setUp()
	{
		parent::setUp();
		$this->user = App\User::where("email","rthakur.dev@gmail.com")->first();
	}

	public function testSearch()
	{
		$this->actingAs($this->user)
			->visit("search")
			->see("Dashboard");
	}
	
	public function testFranchise()
	{
		$this->actingAs($this->user)
			->visit("partner")
			->see("Dashboard");
	}
	
	public function testSearchPost()
	{
		$response = $this->call( "POST", 'search', [
			"destination" => "Del Carmen, Surigao del Norte, Caraga, (PH)",
			"origin" => "Seda, East Nusa Tenggara, (ID)",
			"_token" => "".csrf_token()
		]);
		
		$this->assertEquals(200, $response->status());
	}
	
	public function testNames()
	{
		$response = $this->call("GET", "names");
		
		$this->assertEquals(200, $response->status());
	}
	
	public function testSearchConfirmPost()
	{
		$code = "US";
		
		$response = $this->call("POST", "search/confirm", [
			"sliderratio" => 38,
			"_token" => "".csrf_token()
		]);
		
		$this->assertEquals(200, $response->status());
	}
}

